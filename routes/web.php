<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\KonfigurasiController;
use App\Http\Controllers\KotamaController;
use App\Http\Controllers\PrajuritController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RollController;
use App\Http\Controllers\tni_alController;
use App\Models\tni_al;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

Route::middleware(['guest:tni_al'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/panel', function () {
        return view('auth.loginAdmin');
    })->name('loginAdmin');
    
    Route::post('/prosesloginadmin', [AuthController::class, 'prosesloginadmin']);
});


Route::middleware(['auth:tni_al'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);

    //presensi
    Route::get('/presensi/create', [PresensiController::class, 'create']);
    Route::post('/presensi/store', [PresensiController::class, 'store']);

    //edit profile

    Route::get('/editProfile', [PresensiController::class, 'editProfile']);
    Route::post('/presensi/{nrp}/updateProfile', [PresensiController::class, 'updateProfile']);

    // histori
    Route::get('presensi/histori', [PresensiController::class, 'histori']);
    Route::post('/getHistori', [PresensiController::class, 'getHistori']);

    //izin
    Route::get('presensi/izin', [PresensiController::class, 'izin']);
    Route::get('presensi/buatIzin', [PresensiController::class, 'buatIzin']);
    Route::post('presensi/storeIzin', [PresensiController::class, 'storeIzin']);
    Route::post('/presensi/cekpengajuanizin', [PresensiController::class, 'cekpengajuanizin']);
});

Route::middleware(['auth:user'])->group(function(){
    Route::get('/proseslogoutadmin', [AuthController::class, 'proseslogoutadmin']);
    Route::get('/panel/dashboardAdmin', [DashboardController::class, 'dashboardAdmin']);

    // prajurit
    Route::get('/tni_al', [tni_alController::class, 'index']); 
    Route::post('/tni_al/store', [tni_alController::class, 'store']); 
    Route::post('/tni_al/edit', [tni_alController::class, 'edit']); 
    Route::post('/tni_al/{nrp}/update', [tni_alController::class, 'update']); 
    Route::post('/tni_al/{nrp}/delete', [tni_alController::class, 'delete']); 

    //Kotama
    Route::get('/kotama', [KotamaController::class, 'index']);
    Route::post('/kotama/store', [KotamaController::class, 'store']);
    Route::post('/kotama/edit', [KotamaController::class, 'edit']);
    Route::post('/kotama/update', [KotamaController::class, 'update']);
    Route::post('/kotama/{kode_kot}/delete', [KotamaController::class, 'delete']);

    //Roll
    Route::get('/roll', [RollController::class, 'index']);
    Route::post('/roll/store', [RollController::class, 'store']);
    Route::post('/roll/edit', [RollController::class, 'edit']);
    Route::post('/roll/{kode_roll}/update', [RollController::class, 'update']);
    Route::post('/roll/{kode_roll}/delete', [RollController::class, 'delete']);

    //Departemen
    Route::get('/departemen', [DepartemenController::class, 'index']);
    Route::post('/departemen/store', [DepartemenController::class, 'store']);
    Route::post('/departemen/edit', [DepartemenController::class, 'edit']);
    Route::post('/departemen/{kode_roll}/update', [DepartemenController::class, 'update']);
    Route::post('/departemen/{kode_roll}/delete', [DepartemenController::class, 'delete']);
    

    //presensi monitoring
    Route::get('/presensi/monitoring', [PresensiController::class, 'monitoring']);
    Route::post('/getpresensi', [PresensiController::class, 'getpresensi']);
    Route::post('/tampilkanpeta', [PresensiController::class, 'tampilkanpeta']);
    Route::get('/presensi/laporan', [PresensiController::class, 'laporan']);
    Route::post('/presensi/cetaklaporan', [PresensiController::class, 'cetaklaporan']);
    Route::get('/presensi/rekap', [PresensiController::class, 'rekap']);
    Route::post('/presensi/cetakrekap', [PresensiController::class, 'cetakrekap']);
    Route::get('/presensi/pengajuanizin', [PresensiController::class, 'pengajuanizin']);
    Route::post('/presensi/approveizin', [PresensiController::class, 'approveizin']);
    Route::get('/presensi/{id}/batalkanizin', [PresensiController::class, 'batalkanizin']);
    
    
    //konfigurasi
    Route::get('/konfigurasi/lokasikantor', [KonfigurasiController::class, 'lokasikantor']);
    Route::post('/konfigurasi/updatelokasikantor', [KonfigurasiController::class, 'updatelokasikantor']);
    Route::get('/konfigurasi/jamkerja', [KonfigurasiController::class, 'jamkerja']);
    Route::post('/konfigurasi/storejamkerja', [KonfigurasiController::class, 'storejamkerja']);
    Route::post('/konfigurasi/edit', [KonfigurasiController::class, 'edit']);
    Route::post('/konfigurasi/updateJK', [KonfigurasiController::class, 'updateJK']);
    Route::post('/konfigurasi/{kode_jam_kerja}/delete', [KonfigurasiController::class, 'deleteJK']);
    Route::get('/konfigurasi/{nrp}/setjamkerja', [KonfigurasiController::class, 'setjamkerja']);

    Route::post('/konfigurasi/storeSetJamKerja', [KonfigurasiController::class, 'storeSetJamKerja']);
});
