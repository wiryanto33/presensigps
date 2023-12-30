<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create()
    {
        $hariIni = date("Y-m-d");
        $nrp = Auth::guard('tni_al')->user()->nrp;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariIni)->where('nrp', $nrp)->count();
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();

        return view('presensi.create', compact('cek', 'lok_kantor'));
    }

    public function store(Request $request)
    {

        $nrp = Auth::guard('tni_al')->user()->nrp;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        $lok = explode(',', $lok_kantor->lokasi_kantor);
        $lat_kantor = $lok[0];
        $long_kantor = $lok[1];
        $latKantor = $lat_kantor;
        $longKantor = $long_kantor;
        $lokasi = $request->lokasi;
        $lokasiUser = explode(",", $lokasi);
        $latUser = $lokasiUser[0];
        $longUser = $lokasiUser[1];

        $jarak = $this->distance($latKantor, $longKantor, $latUser, $longUser);
        $radius = round($jarak["meters"]);

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nrp', $nrp)->count();

        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nrp . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;


        if ($radius > $lok_kantor->radius) {
            echo "error|Maaf Anda Berada Di luar Radius,  jarak anda " . $radius . " meter dari kantor|radius";
        } else {
            if ($cek > 0) {
                $data_pulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nrp', $nrp)->update($data_pulang);
                if ($update) {
                    echo "success|Terimakasih, Hati-Hati Di Jalan|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal absen, Hubungi TEAM IT|out";
                }
            } else {
                $data = [
                    'nrp' => $nrp,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensi')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Selamat Bekerja|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal absen, Hubungi TEAM IT|in";
                }
            }
        }
    }
    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editProfile()
    {
        $nrp = Auth::guard('tni_al')->user()->nrp;
        $tni_al = DB::table('tni_al')->where('nrp', $nrp)->first();
        return view('presensi.editProfile', compact('tni_al'));
    }

    public function updateProfile(Request $request)
    {
        $nrp = Auth::guard('tni_al')->user()->nrp;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $password = Hash::make($request->password);
        $tni_al = DB::table('tni_al')->where('nrp', $nrp)->first();
        if ($request->hasFile('foto')) {
            $foto = $nrp . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $tni_al->foto;
        }

        if (empty($password)) {

            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];
        } else {

            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
        }

        $update = DB::table('tni_al')->where('nrp', $nrp)->update($data);
        if (!empty($update)) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/tni_al";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update']);
        }
    }

    public function histori()
    {

        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('presensi.histori', compact('namaBulan'));
    }

    public function getHistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nrp = Auth::guard('tni_al')->user()->nrp;

        $histori = DB::table('presensi')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->where('nrp', $nrp)
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.getHistori', compact('histori'));
    }

    public function izin()
    {
        $nrp = Auth::guard('tni_al')->user()->nrp;
        $dataIzin = DB::table('pengajuan_izin')->where('nrp', $nrp)->get();

        return view('presensi.izin', compact('dataIzin'));
    }

    public function buatIzin()
    {

        return view('presensi.buatIzin');
    }

    public function storeIzin(Request $request)
    {

        $nrp = Auth::guard('tni_al')->user()->nrp;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data = [
            'nrp' => $nrp,
            'tgl_izin' => $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan) {
            return redirect('/presensi/izin')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error' => 'Data Gagal Disimpan']);
        }
    }

    public function monitoring()
    {

        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
            ->select('presensi.*', 'nama_lengkap', 'nama_roll')
            ->join('tni_al', 'presensi.nrp', '=', 'tni_al.nrp')
            ->join('roll', 'tni_al.kode_roll', '=', 'roll.kode_roll')
            ->where('tgl_presensi', $tanggal)
            ->get();


        return view('presensi.getpresensi', compact('presensi'));
    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request->id;
        $presensi = DB::table('presensi')->where('id', $id)
            ->join('tni_al', 'presensi.nrp', '=', 'tni_al.nrp')
            ->first();
        return view('presensi.showmap', compact('presensi'));
    }

    public function laporan()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"];
        $tni_al = DB::table('tni_al')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('namaBulan', 'tni_al'));
    }

    public function cetaklaporan(Request $request)
    {
        $nrp = $request->nrp;
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"];
        $tni_al = DB::table('tni_al')->where('nrp', $nrp)
            ->join('departemen', 'tni_al.kode_dept', '=', 'departemen.kode_dept')
            ->first();

        $presensi = DB::table('presensi')
            ->where('nrp', $nrp)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->orderBy('tgl_presensi')
            ->get();

        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namaBulan', 'tni_al', 'presensi'));
    }

    public function rekap()
    {
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('presensi.rekap', compact('namaBulan'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "July", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
            ->selectRaw(' presensi.nrp, nama_lengkap, pangkat,
MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_1,
MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_2,
MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_3,
MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_4,
MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_5,
MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_6,
MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_7,
MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_8,
MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_9,
MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_10,
MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_11,
MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_12,
MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_13,
MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_14,
MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_15,
MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_16,
MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_17,
MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_18,
MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_19,
MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_20,
MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_21,
MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_22,
MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_23,
MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_24,
MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_25,
MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_26,
MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_27,
MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_28,
MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_29,
MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_30,
MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_in,"-", IFNULL(jam_out, "00:00:00")),"")) as tgl_31
        ')
            ->join('tni_al', 'presensi.nrp', '=', 'tni_al.nrp')
            ->whereRaw('MONTH(tgl_presensi)="' . $bulan . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahun . '"')
            ->groupByRaw('presensi.nrp, nama_lengkap, pangkat')
            ->get();

        return view('presensi.cetakrekap', compact('bulan', 'tahun', 'namaBulan', 'rekap'));
    }

    public function pengajuanizin(Request $request)
    {
        $query = Pengajuanizin::query();
        $query->select('id', 'tgl_izin', 'pengajuan_izin.nrp', 'nama_lengkap', 'status',
        'status_approved', 'status', 'keterangan');
        $query->join('tni_al', 'pengajuan_izin.nrp', '=', 'tni_al.nrp');
        if (!empty($request->dari)&&!empty($request->sampai)) {
            $query->whereBetween('tgl_izin', [$request->dari, $request->sampai]);
        }

        if(!empty($request->nrp)){
            $query->where('pengajuan_izin.nrp', $request->nrp);
        }

        if(!empty($request->nama_lengkap)){
            $query->where('nama_lengkap', 'like', '%' .$request->nama_lengkap. '%');
        }

        if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2'){
            $query ->where('status_approved', $request->status_approved);
        }
        $query->orderBy('tgl_izin', 'desc');
        $pengajuanizin = $query->paginate(4);
        $pengajuanizin->appends($request->all());

        return view('presensi.pengajuanizin', compact('pengajuanizin'));
    }

    public function approveizin(Request $request){

        $status_approved = $request->status_approved;
        $id_approve = $request->id_approve;
        $update = DB::table('pengajuan_izin')->where('id', $id_approve)->update([
            'status_approved'=>$status_approved
        ]);
        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning'=>'Data gagal Di Update']);

        }
    }

    public function batalkanizin($id){

        $update = DB::table('pengajuan_izin')->where('id', $id)->update([
            'status_approved'=> 0
        ]);
        if ($update) {
            return Redirect::back()->with(['success'=>'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning'=>'Data gagal Di Update']);

        }
    }

    public function cekpengajuanizin(Request $request){
        $tgl_izin = $request->tgl_izin;
        $nrp = Auth::guard('tni_al')->user()->nrp;

        $cek = DB::table('pengajuan_izin')->where('nrp', $nrp)->where('tgl_izin', $tgl_izin)-> count();
        return $cek;
    }
}
