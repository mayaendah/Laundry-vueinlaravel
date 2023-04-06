<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\outletController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\paketController;
use App\Http\Controllers\transaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('me', 'me');
});

Route::controller(outletController::class)->group(function () {
    Route::post('simpanoutlet', 'simpanOutlet');
    Route::get('tampiloutlet', 'getOutlet');
    Route::delete('hapusoutlet/{id}', 'hapusOutlet');
    Route::get('ubahoutlet/{id}', 'UbahOutlet');
    Route::post('updateoutlet', 'updateOutlet');
});

Route::controller(memberController::class)->group(function () {
    Route::post('simpanmember', 'simpanMember');
    Route::get('tampilmember', 'getMember');
    Route::delete('hapusmember/{id}', 'hapusMember');
    Route::get('ubahmember/{id}', 'UbahMember');
    Route::post('updatemember', 'updateMember');
});

Route::controller(paketController::class)->group(function () {
    Route::post('simpanpaket', 'simpanPaket');
    Route::get('tampilpaket', 'getPaket');
    Route::delete('hapuspaket/{id}', 'hapusPaket');
    Route::get('ubahpaket/{id}', 'UbahPaket');
    Route::post('updatepaket', 'updatePaket');
});

Route::controller(transaksiController::class)->group(function () {
    Route::post('simpantransaksi', 'simpanKeranjang');
    Route::get('tampiltransaksi', 'getPaket');
    Route::delete('hapustransaksi/{id}', 'hapusTransaksi');
    Route::get('detailtransaksi/{id}', 'getPaketById');
    Route::post('updatetransaksi', 'updateTransaksi');

    Route::get('/keranjang', 'getAllKeranjang');

    Route::post('/pesanan', 'checkOut');

    Route::delete('/hapus/itemKeranjang/{id}', 'hapusKeranjang');
});


