<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HRDController;
use App\Http\Controllers\PengawasController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SiftController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DetailAbsensiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PassController;
use App\Http\Controllers\EditProfileFoto;
use App\Http\Controllers\P_AbsenController;
use App\Http\Controllers\K_AbsenController;
use App\Http\Controllers\LaporanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [LoginController::class, 'index'])->middleware('isTamu');

//login
Route::post('/login', [LoginController::class, 'login'])->middleware('isTamu');;
Route::get('/logout', [LoginController::class, 'logout']);

//dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('isLogin');

//user
Route::resource('/user', UserController::class)->middleware(['isLogin','isAdmin']);
Route::get('/search', [UserController::class, 'search'])->middleware(['isLogin','isAdmin']);
Route::post('/importuser', [UserController::class, 'importexcel'])->middleware(['isLogin','isAdmin']);
Route::post('/reset-password/{id}', [UserController::class, 'resetPassword'])->middleware(['isLogin','isAdmin']);

//hrd
Route::resource('/hrd', HRDController::class)->middleware(['isLogin','isAdmin']);
Route::post('/importhrd', [HRDController::class, 'importexcel'])->middleware(['isLogin','isAdmin']);

//pengawas
Route::resource('/pengawas', PengawasController::class)->middleware(['isLogin','isAdmin']);
Route::post('/importpengawas', [PengawasController::class, 'importexcel'])->middleware(['isLogin','isAdmin']);

//karyawan
Route::resource('/karyawan', KaryawanController::class)->middleware(['isLogin','isAdmin']);
Route::post('/importkaryawan', [KaryawanController::class, 'importexcel'])->middleware(['isLogin','isAdmin']);
Route::get('/cek-absen-karyawan', [K_AbsenController::class, 'cekabsensi_k'])->middleware(['isLogin','isKaryawan']);

//sift
Route::resource('/sift', SiftController::class)->middleware(['isLogin','isAdmin']);

//absen
Route::resource('/absensi', AbsensiController::class)->middleware(['isLogin','isAdmin']);

//detail absen
Route::resource('/detail-absensi', DetailAbsensiController::class)->middleware(['isLogin','isAdmin']);

//profile
Route::resource('/myprofile', ProfileController::class)->middleware('isLogin');
Route::resource('/ubah-pass', PassController::class)->middleware('isLogin');
Route::resource('/ubah-profile', EditProfileFoto::class)->middleware('isLogin');

//mekanisme absen
Route::resource('/absensi-masuk', P_AbsenController::class)->middleware(['isLogin','isPengawas']);
Route::get('/detail-absen/{id}', [K_AbsenController::class,'detail'])->middleware(['isLogin','isPengawas']);
Route::resource('/mulai-absen', K_AbsenController::class)->middleware(['isLogin','isPengawas']);

//Laporan
Route::get('/laporan-kapal',[LaporanController::class,'index'])->middleware(['isLogin','isAdmin']);
Route::post('/laporan-cari-kapal',[LaporanController::class,'cari'])->middleware(['isLogin','isAdmin']);
Route::post('/cetak-laporan',[LaporanController::class,'cetak'])->middleware(['isLogin','isAdmin']);
Route::post('/cetak-laporan-excel',[LaporanController::class,'exportLaporan'])->middleware(['isLogin','isAdmin']);

