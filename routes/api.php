<?php

use App\Http\Controllers\KelasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\SiswaController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\Buku;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getsiswa', [SiswaController::class, 'getsiswa']);
Route::get('/getsiswaid/{id}', [SiswaController::class, 'getsiswaid']);

Route::get('/jumlahsiswa', [SiswaController::class, 'jumlahsiswa']);
Route::post('/createsiswa', [SiswaController::class, 'createsiswa']);
Route::delete('/deletesiswa/{id}',[SiswaController::class,'deletesiswa']);
Route::put('/updatesiswa/{id}', [SiswaController::class, 'updatesiswa']);

Route::get('/getkelas', [KelasController::class, 'getkelas']);
Route::post('/createkelas', [KelasController::class, 'createkelas']);
Route::put('/updatekelas/{id_kelas}', [KelasController::class, 'updatekelas']);
Route::delete('/deletekelas/{id_kelas}',[KelasController::class,'deletekelas']);

Route::get('/getbuku', [BukuController::class, 'getbuku']);
Route::get('/jumlahbuku', [BukuController::class, 'jumlahbuku']);
Route::get('/getbukuid/{id}', [BukuController::class, 'getbukuid']);
Route::post('/createbuku', [BukuController::class, 'createbuku']);
Route::put('/updatebuku/{id_buku}', [BukuController::class, 'updatebuku']);
Route::delete('/deletebuku/{id_buku}',[BukuController::class,'deletebuku']);

Route::post('/pinjambuku', [TransaksiController::class, 'pinjamBuku']);
Route::get('/getpinjam', [TransaksiController::class,'getpinjam']);
Route::get('/getpinjamid/{id_peminjaman}', [TransaksiController::class,'getpinjamid']);
Route::delete('/deletepinjam/{id_peminjaman}', [TransaksiController::class,'deletepinjam']);
Route::post('/detailpinjam', [TransaksiController::class, 'detailpinjam']);
Route::get('/getdetail', [TransaksiController::class,'getdetail']);
Route::put('/kembalibuku/{id}', [TransaksiController::class,'kembali']);

