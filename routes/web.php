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
Route::resource('/user', UserController::class)->middleware('isLogin');
Route::get('/search', [UserController::class, 'search'])->middleware('isLogin');
Route::post('/importuser', [UserController::class, 'importexcel'])->middleware('isLogin');
Route::post('/reset-password/{id}', [UserController::class, 'resetPassword'])->middleware('isLogin');

//hrd
Route::resource('/hrd', HRDController::class)->middleware('isLogin');
Route::post('/importhrd', [HRDController::class, 'importexcel'])->middleware('isLogin');

//pengawas
Route::resource('/pengawas', PengawasController::class)->middleware('isLogin');
Route::post('/importpengawas', [PengawasController::class, 'importexcel'])->middleware('isLogin');

//karyawan
Route::resource('/karyawan', KaryawanController::class)->middleware('isLogin');
Route::post('/importkaryawan', [KaryawanController::class, 'importexcel'])->middleware('isLogin');

//sift
Route::resource('/sift', SiftController::class)->middleware('isLogin');

//absen
Route::resource('/absensi', AbsensiController::class)->middleware('isLogin');

//detail absen
Route::resource('/detail-absensi', DetailAbsensiController::class)->middleware('isLogin');

//profile
Route::resource('/myprofile', ProfileController::class)->middleware('isLogin');
Route::resource('/ubah-pass', PassController::class)->middleware('isLogin');
Route::resource('/ubah-profile', EditProfileFoto::class)->middleware('isLogin');

//mekanisme absen
Route::resource('/absensi-masuk', P_AbsenController::class)->middleware('isLogin');
Route::get('/detail-absen/{id}', [K_AbsenController::class,'detail'])->middleware('isLogin');
Route::resource('/mulai-absen', K_AbsenController::class)->middleware('isLogin');

