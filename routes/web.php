<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
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

