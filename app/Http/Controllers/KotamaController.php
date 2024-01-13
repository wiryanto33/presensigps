<?php

namespace App\Http\Controllers;

use App\Models\Kotama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\Catch_;

class KotamaController extends Controller
{
    public function index(Request $request)
    {
        //    $kotama = DB::table('kotama')->orderBy('kode_kot')->get();
        $nama_kot = $request->nama_kot;
        $query = Kotama::query();
        $query->select('*');
        if (!empty($nama_kot)) {
            $query->where('nama_kot', 'like', '%' . $nama_kot . '%');
        }
        $kotama = $query->get();

        return view('kotama.index', compact('kotama'));
    }

    public function store(Request $request)
    {
        $kode_kot = $request->kode_kot;
        $nama_kot = $request->nama_kot;
        $lokasi_kot = $request->lokasi_kot;
        $radius = $request->radius;

        $data = [
            'kode_kot' => $kode_kot,
            'nama_kot' => $nama_kot,
            'lokasi_kot' => $lokasi_kot,
            'radius' => $radius
        ];

        $cek = DB::table('kotama')->where('kode_kot', $kode_kot)->count();
        if ($cek > 0) { {
                return Redirect::back()->with(['warning' => 'ERROR DATA DENGAN KODE KOTAMA ' . $kode_kot . ' SUDAH TERISI ']);
            }
        }

        $simpan = DB::table('kotama')->insert($data);

        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $kode_kot = $request->kode_kot;
        $kotama = DB::table('kotama')->where('kode_kot', $kode_kot)->first();
        return view('kotama.edit', compact('kotama'));
    }

    public function update(Request $request)
    {
        $kode_kot = $request->kode_kot;
        $nama_kot = $request->nama_kot;
        $lokasi_kot = $request->lokasi_kot;
        $radius = $request->radius;

        try{
            $data = [
                'nama_kot' => $nama_kot,
                'lokasi_kot' => $lokasi_kot,
                'radius' => $radius
            ];
            DB::table('kotama')
            ->where('kode_kot', $kode_kot)
            ->update($data);
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        }catch (\Exception $e){
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update']);
        }
    }

    public function delete($kode_kot)
    {
        $hapus = DB::table('kotama')->where('kode_kot', $kode_kot)->delete();
        if ($hapus) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Hapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Hapus']);
        }
    }
}
