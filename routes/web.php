<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\c_mitra;
use App\Http\Controllers\c_kategori;
use App\Http\Controllers\c_fasilitas;
use App\Http\Controllers\c_postingan;
use App\Http\Controllers\c_pengguna;
use App\Http\Controllers\c_pengunjung;
use App\Http\Controllers\c_feedback;
use App\Http\Controllers\c_beritainformasi;
use App\Http\Controllers\c_profil;
use App\Http\Controllers\c_pembatalan;
use App\Http\Controllers\c_tiket_masif;
use App\Http\Controllers\invoice;


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

Route::get('/', [App\Http\Controllers\c_login::class, 'index'])->name('login');
Route::get('/dashboard', [App\Http\Controllers\c_login::class, 'dashboard'] )->name('dashboard')->middleware('auth');
Route::post('/check', [App\Http\Controllers\c_login::class, 'check'])->name('login.check');
Route::post('/', [App\Http\Controllers\c_login::class, 'logout'])->name('user.logout');

Route::controller(c_mitra::class)->group(function () {
    Route::get('/mitra/akun', 'index')->name('mitra.akun')->middleware('auth');
    Route::post('/mitra/akun/store', 'store')->name('mitra.akun.store');
    Route::get('/mitra/akun/create', 'create')->name('mitra.akun.create');
    Route::get('/mitra/akun/edit/{id}', 'edit')->name('mitra.akun.edit');
    Route::post('/mitra/akun/update/{id}', 'update')->name('mitra.akun.update');
    Route::get('/mitra/akun/destroy/{id}', 'destroy')->name('mitra.akun.destroy');
    Route::get('/mitra/akun/detail/{id}', 'detail')->name('mitra.akun.detail');
    Route::get('/mitra/akun/active/{id}', 'active')->name('mitra.akun.active');
    Route::get('/mitra/akun/inactive/{id}', 'inactive')->name('mitra.akun.inactive');
});

Route::controller(c_beritainformasi::class)->middleware('auth')->group(function () {
    Route::get('/berinfo', 'index')->name('berinfo');
    Route::post('/berinfo/store', 'store')->name('berinfo.store');
    Route::get('/berinfo/create', 'create')->name('berinfo.create');
    Route::get('/berinfo/edit/{id}', 'edit')->name('berinfo.edit');
    Route::post('/berinfo/update/{id}', 'update')->name('berinfo.update');
    Route::get('/berinfo/destroy/{id}', 'destroy')->name('berinfo.destroy');
    Route::get('/berinfo/detail/{id}', 'detail')->name('berinfo.detail');
    Route::get('/berinfo/active/{id}', 'active')->name('berinfo.active');
    Route::get('/berinfo/inactive/{id}', 'inactive')->name('berinfo.inactive');
});

Route::controller(invoice::class)->middleware('auth')->group(function () {
    Route::get('/invoice/store/{id}', 'store')->name('invoice.store');
});

Route::controller(c_tiket_masif::class)->middleware('auth')->group(function () {
    Route::get('/masif', 'index')->name('masif');
    Route::get('/masif/edit/{id}', 'edit')->name('masif.edit');
    Route::get('/masif/wisata/{id}/{idm}', 'wisata')->name('masif.wisata');
    Route::get('/masif/paket/{id}/{idm}', 'paket')->name('masif.paket');
    Route::get('/masif/harga/{id}/{tgl}', 'harga')->name('masif.harga');
    Route::post('/masif/update/{id}', 'update')->name('masif.update');
    Route::get('/masif/detail/{id}', 'detail')->name('masif.detail');
    Route::get('/masif/invoice/{id}', 'invoice')->name('masif.invoice');
    Route::get('/masif/hubungi/{id}', 'hubungi')->name('masif.hubungi');
});

Route::controller(c_pengguna::class)->middleware('auth')->group(function () {
    Route::get('/pengguna', 'index')->name('pengguna');
    Route::post('/pengguna/store', 'store')->name('pengguna.store');
    Route::get('/pengguna/create', 'create')->name('pengguna.create');
    Route::get('/pengguna/edit/{id}', 'edit')->name('pengguna.edit');
    Route::post('/pengguna/update/{id}', 'update')->name('pengguna.update');
    Route::get('/pengguna/destroy/{id}', 'destroy')->name('pengguna.destroy');
    Route::get('/pengguna/detail/{id}', 'detail')->name('pengguna.detail');
    Route::get('/pengguna/active/{id}', 'active')->name('pengguna.active');
    Route::get('/pengguna/inactive/{id}', 'inactive')->name('pengguna.inactive');
});

Route::controller(c_pengunjung::class)->middleware('auth')->group(function () {
    Route::get('/pengunjung', 'index')->name('pengunjung');
    Route::get('/pengunjung/pengunjung/{id}', 'pengunjung')->name('pengunjung.pengunjung');
    Route::post('/pengunjung/bayar/{id}', 'bayar')->name('pengunjung.bayar');
    Route::get('/pengunjung/histori/{id}', 'histori')->name('pengunjung.histori');
    Route::get('/pengunjung/detail/{id}', 'detail')->name('pengunjung.detail');
    Route::get('/pengunjung/detailhistori/{id}', 'detailhistori')->name('pengunjung.detailhistori');
});

Route::controller(c_postingan::class)->middleware('auth')->group(function () {
    Route::get('/mitra', 'index')->name('mitra');
    Route::get('/mitra/postingan/{id}', 'postingan')->name('mitra.postingan');
    Route::post('/mitra/postingan/store/{id}', 'store')->name('mitra.postingan.store');
    Route::get('/mitra/postingan/create/{id}', 'create')->name('mitra.postingan.create');
    Route::get('/mitra/postingan/edit/{id}', 'edit')->name('mitra.postingan.edit');
    Route::post('/mitra/postingan/update/{id}', 'update')->name('mitra.postingan.update');
    Route::get('/mitra/postingan/destroy/{id}', 'destroy')->name('mitra.postingan.destroy');
    Route::get('/mitra/postingan/detail/{id}', 'detail')->name('mitra.postingan.detail');
});

Route::controller(c_kategori::class)->middleware('auth')->group(function () {
    Route::get('/datamaster/kategori', 'index')->name('datamaster.kategori');
    Route::post('/datamaster/kategori/store', 'store')->name('datamaster.kategori.store');
    Route::get('/datamaster/kategori/create', 'create')->name('datamaster.kategori.create');
    Route::get('/datamaster/kategori/edit/{id}', 'edit')->name('datamaster.kategori.edit');
    Route::post('/datamaster/kategori/update/{id}', 'update')->name('datamaster.kategori.update');
    Route::get('/datamaster/kategori/destroy/{id}', 'destroy')->name('datamaster.kategori.destroy');
});

Route::controller(c_fasilitas::class)->middleware('auth')->group(function () {
    Route::get('/datamaster/fasilitas', 'index')->name('datamaster.fasilitas');
    Route::post('/datamaster/fasilitas/store', 'store')->name('datamaster.fasilitas.store');
    Route::get('/datamaster/fasilitas/create', 'create')->name('datamaster.fasilitas.create');
    Route::get('/datamaster/fasilitas/edit/{id}', 'edit')->name('datamaster.fasilitas.edit');
    Route::post('/datamaster/fasilitas/update/{id}', 'update')->name('datamaster.fasilitas.update');
    Route::get('/datamaster/fasilitas/destroy/{id}', 'destroy')->name('datamaster.fasilitas.destroy');
});

Route::controller(c_feedback::class)->middleware('auth')->group(function () {
    Route::get('/feedback', 'index')->name('feedback');
    Route::get('/feedback/detail/{id}', 'detail')->name('feedback.detail');
    Route::get('/feedback/balas/{id}', 'balas')->name('feedback.balas');
   
});

Route::controller(c_profil::class)->middleware('auth')->group(function () {
    Route::get('/profil', 'index')->name('profil');
    Route::get('/profil/edit', 'edit')->name('profil.edit');
    Route::get('/profil/keamanan', 'keamanan')->name('profil.keamanan');
    Route::post('/profil/update/{id}', 'update')->name('profil.update');
    Route::post('/profil/update2/{id}', 'update2')->name('profil.update2');
   
});

Route::controller(c_pembatalan::class)->middleware('auth')->group(function () {
    Route::get('/pembatalan', 'index')->name('pembatalan');
    Route::get('/pembatalan/detail/{id}', 'detail')->name('pembatalan.detail');
    Route::post('/pembatalan/batalkan/{id}', 'batalkan')->name('pembatalan.batalkan');
    Route::get('/pembatalan/bukti/{id}', 'bukti')->name('pembatalan.bukti');
   
   
});
