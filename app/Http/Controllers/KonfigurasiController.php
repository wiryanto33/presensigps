<?php

namespace App\Http\Controllers;

use App\Models\Setjamkerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();

        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }

    public function updatelokasikantor(Request $request)
    {

        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;

        $update = DB::table('konfigurasi_lokasi')->where('id', 1)->update([
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ]);
        if ($update) {
            return Redirect::back()->with(['success' => 'Lokasi Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['warning' => 'Lokasi Gagal Di Update']);
        }
    }

    public function jamkerja()
    {

        $jam_kerja = DB::table('jam_kerja')->orderBy('kode_jam_kerja')->get();

        return view('konfigurasi.jamkerja', compact('jam_kerja'));
    }

    public function storejamkerja(Request $request)
    {
        $kode_jam_kerja = $request->kode_jam_kerja;
        $nama_jam_kerja = $request->nama_jam_kerja;
        $awal_jam_masuk = $request->awal_jam_masuk;
        $jam_masuk = $request->jam_masuk;
        $akhir_jam_masuk = $request->akhir_jam_masuk;
        $jam_pulang = $request->jam_pulang;
        $data = [
            'kode_jam_kerja' => $kode_jam_kerja,
            'nama_jam_kerja' => $nama_jam_kerja,
            'awal_jam_masuk' => $awal_jam_masuk,
            'jam_masuk' => $jam_masuk,
            'akhir_jam_masuk' => $akhir_jam_masuk,
            'jam_pulang' => $jam_pulang
        ];

        try {
            DB::table('jam_kerja')->insert($data);
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    public function edit(Request $request)
    {

        $kode_jam_kerja = $request->kode_jam_kerja;
        $jam_kerja = DB::table('jam_kerja')->where('kode_jam_kerja', $kode_jam_kerja)->first();
        return view('konfigurasi.edit', compact('jam_kerja'));
    }

    public function updateJK(Request $request)
    {
        $kode_jam_kerja = $request->kode_jam_kerja;
        $nama_jam_kerja = $request->nama_jam_kerja;
        $awal_jam_masuk = $request->awal_jam_masuk;
        $jam_masuk = $request->jam_masuk;
        $akhir_jam_masuk = $request->akhir_jam_masuk;
        $jam_pulang = $request->jam_pulang;
        $data = [
            'nama_jam_kerja' => $nama_jam_kerja,
            'awal_jam_masuk' => $awal_jam_masuk,
            'jam_masuk' => $jam_masuk,
            'akhir_jam_masuk' => $akhir_jam_masuk,
            'jam_pulang' => $jam_pulang
        ];

        try {
            DB::table('jam_kerja')->where('kode_jam_kerja', $kode_jam_kerja)->update($data);
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function deleteJK($kode_jam_kerja)
    {
        $hapus = DB::table('jam_kerja')->where('kode_jam_kerja', $kode_jam_kerja)->delete();
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Hapus']);
        }
    }

    public function setjamkerja($nrp)
    {
        $tni_al = DB::table('tni_al')->where('nrp', $nrp)->first();
        $jam_kerja = DB::table('jam_kerja')->orderBy('nama_jam_kerja')->get();
        return view('konfigurasi.setjamkerja', compact('tni_al', 'jam_kerja'));
    }

//    public function storeSetJamkerja(Request $request){
//     $nrp = $request->nrp;
//     $hari = $request->hari;
//     $kode_jam_kerja = $request->kode_jam_kerja;

//     for($i = 0; $i< count($hari); $i++){
//         $data[] =[
//             'nrp' => $nrp,
//             'hari' => $hari[$i],
//             'kode_jam_kerja' => $kode_jam_kerja[$i]

//         ];
//     }

//     try {
//         Setjamkerja::insert($data);
//         echo "Success";
//     } catch (\Exception $e) {
//         dd($e);
//     }
//    }
}
