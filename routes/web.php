<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', [App\Http\Controllers\UserController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [App\Http\Controllers\UserController::class, 'authenticate']);
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout']);

Route::get('/', function () {
    return redirect()->to('/login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return redirect()->to('/welcome');
});

Route::resource('produk', App\Http\Controllers\ProdukController::class);
Route::resource('sopir', App\Http\Controllers\SopirController::class);
Route::resource('peminjaman', App\Http\Controllers\PeminjamanController::class);
Route::resource('pembayaran', App\Http\Controllers\PembayaranController::class);
