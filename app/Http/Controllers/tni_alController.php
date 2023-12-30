<?php

namespace App\Http\Controllers;

use App\Models\tni_al;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class tni_alController extends Controller
{
    public function index(Request $request)
    {
        $query = tni_al::query();
        $query->select('tni_al.*', 'nama_dept', 'nama_roll', 'nama_kot');
        $query->join('departemen', 'tni_al.kode_dept', '=', 'departemen.kode_dept');
        $query->join('roll', 'tni_al.kode_roll', '=', 'roll.kode_roll');
        $query->join('kotama', 'tni_al.kode_kot', '=', 'kotama.kode_kot');
        $query->orderBy('nama_lengkap');

        if (!empty($request->nrp)) {
            $query->where('nrp', $request->nrp);
        }

        if (!empty($request->nama_prajurit)) {
            $query->where('nama_lengkap', 'like', '%' .$request->nama_prajurit. '%');
        }

        if (!empty($request->nama_kot)) {
            $query->where('tni_al.kode_kot', $request->nama_kot);
        }

        $kotama = DB::table('kotama')->get();

        $departemen = DB::table('departemen')->get();

        $roll = DB::table('roll')->get();

        $tni_al = $query->paginate(5);
        return view('tni_al.index', compact('tni_al', 'kotama', 'departemen', 'roll'));
    }

    public function store(Request $request)
    {
        $nrp = $request->nrp;
        $nama_lengkap = $request->nama_lengkap;
        $pangkat = $request->pangkat;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $kode_sat = " ";
        $kode_roll = $request->kode_roll;
        $kode_kot = $request->kode_kot;
        $password = Hash::make('123');

        if ($request->hasFile('foto')) {
            $foto = $nrp . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nrp' => $nrp,
                'nama_lengkap' => $nama_lengkap,
                'pangkat' => $pangkat,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'kode_kot' => $kode_kot,
                'kode_roll' => $kode_roll,
                'kode_sat' => $kode_sat,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('tni_al')->insert($data);

            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/tni_al/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                
                return Redirect::back()->with(['success' => 'DATA BERHASIL DISIMPAN']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'DATA gagal DISIMPAN']);
        }
    }

    public function edit(Request $request){
        $nrp = $request->nrp;

        $kotama = DB::table('kotama')->get();

        $roll = DB::table('roll')->get();
        $departemen = DB::table('departemen')->get();
        $tni_al = DB::table('tni_al')->where('nrp', $nrp)->first();
        return view('tni_al.edit', compact('departemen', 'kotama', 'roll', 'tni_al'));
    }

    public function update($nrp, Request $request){
        $nrp = $request->nrp;
        $nama_lengkap = $request->nama_lengkap;
        $pangkat = $request->pangkat;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_dept = $request->kode_dept;
        $kode_sat = " ";
        $kode_roll = $request->kode_roll;
        $kode_kot = $request->kode_kot;
        $password = Hash::make('123');
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $nrp . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'pangkat' => $pangkat,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_dept' => $kode_dept,
                'kode_kot' => $kode_kot,
                'kode_roll' => $kode_roll,
                'kode_sat' => $kode_sat,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('tni_al')->where('nrp', $nrp)->update($data);

            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/tni_al/";
                    $folderPathOld = "public/uploads/tni_al/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                
                return Redirect::back()->with(['success' => 'DATA BERHASIL DIUPDATE']);
            }
        } catch (\Exception $e) {
            return Redirect::back()->with(['warning' => 'DATA GAGAL DIUPDATE']);
        }

    }

    public function delete($nrp){
        $delete = DB::table('tni_al')->where('nrp', $nrp)->delete();
        if ($delete){
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);

        }
    }
}
