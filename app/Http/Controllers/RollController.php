<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RollController extends Controller
{
    public function index(Request $request){
        //    $kotama = DB::table('kotama')->orderBy('kode_kot')->get();
        $nama_roll = $request->nama_roll;
        $query = Roll::query();
        $query->select('*');
        if(!empty($nama_roll)){
            $query->where('nama_roll', 'like', '%' .$nama_roll. '%');
        }
        $roll = $query->get();
    
            return view('roll.index', compact('roll'));
        }
    
        public function store(Request $request){
            $kode_roll = $request->kode_roll;
            $nama_roll = $request->nama_roll;
    
            $data = [
                'kode_roll' => $kode_roll,
                'nama_roll' => $nama_roll
            ];
    
            $simpan = DB::table('roll')->insert($data);
    
            if($simpan){
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }else{
                return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
            }
        }
    
        public function edit(Request $request){
            $kode_roll = $request->kode_roll;
            $roll = DB::table('roll')->where('kode_roll',$kode_roll)->first();
            return view('roll.edit', compact('roll'));
        }
    
        public function update($kode_roll, Request $request){
            $nama_roll = $request->nama_roll;
            $data =[
                'nama_roll' => $nama_roll
            ];
    
            $update = DB::table('roll')->where('kode_roll',$kode_roll)->update($data);
            if($update){
                return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
    
            }
    
        }
    
        public function delete($kode_roll){
            $hapus = DB::table('roll')->where('kode_roll', $kode_roll)->delete();
            if($hapus){
                return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus']);
            }else{
                return Redirect::back()->with(['warning' => 'Data Gagal Di Hapus']);
    
            }
        }
}
