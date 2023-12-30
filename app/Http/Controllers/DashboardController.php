<?php

namespace App\Http\Controllers;

use App\Models\tni_al;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = date("m") * 1;
        $tahunIni = date("Y");
        $hariIni = date('Y-m-d');
        $nrp = Auth::guard('tni_al')->user()->nrp;
        $presensiHariIni = DB::table('presensi')->where('nrp', $nrp)->where('tgl_presensi', $hariIni)->first();
        $historiBulanIni = DB::table('presensi')->whereRaw('MONTH(tgl_presensi)="' . $bulanIni . '"')
            ->where('nrp', $nrp)
            ->whereRaw('MONTH(tgl_presensi)="' . $bulanIni . '"')
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunIni . '"')
            ->orderBy('tgl_presensi')
            ->get();

        $rekapPresensi = DB::table('presensi')
            ->selectRaw('COUNT(nrp) as jumlahhadir, SUM(IF(jam_in >"07:00", 1,0)) as jumlahTerlambat')
            ->where('nrp', $nrp)
            ->whereRaw('YEAR(tgl_presensi)="' . $tahunIni . '"')
            ->first();

        $leaderBoard = DB::table('presensi')
        ->join('tni_al', 'presensi.nrp', '=', 'tni_al.nrp')
        ->orderBy('jam_in')
        -> where('tgl_presensi', $hariIni)
        -> get();
        $namaBulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "August", "September", "Oktober", "November", "Desember"];

        $rekapIzin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status= "i", 1, 0)) as jmlIzin, SUM(IF(status= "s", 1, 0)) as jmlSakit, SUM(IF(status= "p", 1, 0)) as jmlPenugasan ')
        ->where('nrp', $nrp)
        ->whereRaw('MONTH(tgl_izin)="' . $bulanIni . '"')
        ->whereRaw('YEAR(tgl_izin)="' . $tahunIni . '"')
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboard', compact('presensiHariIni', 'historiBulanIni', 'namaBulan', 'bulanIni', 'tahunIni', 'rekapPresensi'
        ,'leaderBoard', 'rekapIzin'));
    }

    public function dashboardAdmin(){
        $hariIni = date("Y-m-d");
        $rekapPresensi = DB::table('presensi')
        ->selectRaw('COUNT(nrp) as jumlahhadir, SUM(IF(jam_in >"07:00", 1,0)) as jumlahTerlambat')
        ->where('tgl_presensi', $hariIni)
        ->first();

        $rekapIzin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status= "i", 1, 0)) as jmlIzin, SUM(IF(status= "s", 1, 0)) as jmlSakit, SUM(IF(status= "p", 1, 0)) as jmlPenugasan ')
        ->where('tgl_izin', $hariIni)
        ->where('status_approved', 1)
        ->first();

        return view('dashboard.dashboardAdmin', compact('rekapPresensi', 'rekapIzin'));
    }
}
