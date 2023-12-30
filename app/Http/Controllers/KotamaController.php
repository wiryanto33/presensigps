<?php

namespace App\Http\Controllers;

use App\Models\Kotama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KotamaController extends Controller
{
    public function index(Request $request){
    //    $kotama = DB::table('kotama')->orderBy('kode_kot')->get();
    $nama_kot = $request->nama_kot;
    $query = Kotama::query();
    $query->select('*');
    if(!empty($nama_kot)){
        $query->where('nama_kot', 'like', '%' .$nama_kot. '%');
    }
    $kotama = $query->get();

        return view('kotama.index', compact('kotama'));
    }

    public function store(Request $request){
        $kode_kot = $request->kode_kot;
        $nama_kot = $request->nama_kot;

        $data = [
            'kode_kot' => $kode_kot,
            'nama_kot' => $nama_kot
        ];

        $simpan = DB::table('kotama')->insert($data);

        if($simpan){
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        }else{
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function edit(Request $request){
        $kode_kot = $request->kode_kot;
        $kotama = DB::table('kotama')->where('kode_kot',$kode_kot)->first();
        return view('kotama.edit', compact('kotama'));
    }

    public function update($kode_kot, Request $request){
        $nama_kot = $request->nama_kot;
        $data =[
            'nama_kot' => $nama_kot
        ];

        $update = DB::table('kotama')->where('kode_kot',$kode_kot)->update($data);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);

        }

    }

    public function delete($kode_kot){
        $hapus = DB::table('kotama')->where('kode_kot', $kode_kot)->delete();
        if($hapus){
            return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus']);
        }else{
            return Redirect::back()->with(['warning' => 'Data Gagal Di Hapus']);

        }
    }
}
