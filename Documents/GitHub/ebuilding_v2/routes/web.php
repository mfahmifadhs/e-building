<?php

use App\Http\Controllers\AreaKerjaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\KriteriaPenilaianController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
})->name('login');

Route::get('masuk', [AuthController::class, 'index'])->name('masuk');
Route::get('daftar', [AuthController::class, 'daftar'])->name('daftar-user');
Route::get('keluar', [AuthController::class, 'keluar'])->name('keluar');
Route::post('login/{id}', [AuthController::class, 'postLogin'])->name('post.login');
Route::get('captcha-reload', [AuthController::class, 'reloadCaptcha']);


Route::group(['middleware' => 'auth'], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('dashboard', [DashboardController::class, 'index'])->name('penilaian.filter');


    Route::group(['middleware' => ['access:supervisor']], function () {
        // Penilaian
        Route::post('penilaian/tambah', [PenilaianController::class, 'store'])->name('penilaian.create');

    });


    Route::group(['middleware' => ['access:public']], function () {

        Route::get('penilaian/kriteria', [KriteriaPenilaianController::class, 'index'])->name('kriteria.show');
        Route::get('penilaian/area', [AreaKerjaController::class, 'index'])->name('area_kerja.show');
        Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.show');
        Route::get('penilaian/laporan', [PenilaianController::class, 'showLaporan'])->name('penilaian.laporan.show');
        Route::post('penilaian', [PenilaianController::class, 'index'])->name('penilaian.filter.admin');

    });


    Route::group(['middleware' => ['access:admin']], function () {


    });


    Route::group(['middleware' => ['access:master']], function () {
        // Penilaian
        Route::get('penilaian/edit/{id}', [PenilaianController::class, 'edit'])->name('penilaian.edit');
        Route::get('penilaian/hapus/{id}', [PenilaianController::class, 'destroy'])->name('penilaian.delete');
        Route::post('penilaian/edit/{id}', [PenilaianController::class, 'update'])->name('penilaian.edit');
        // Gedung
        Route::get('gedung', [GedungController::class, 'index'])->name('gedung.show');
        Route::get('gedung/tambah', [GedungController::class, 'create'])->name('gedung.create');
        Route::get('gedung/edit/{id}', [GedungController::class, 'edit'])->name('gedung.edit');
        Route::get('gedung/delete/{id}', [GedungController::class, 'destroy'])->name('gedung.delete');
        Route::post('gedung/tambah', [GedungController::class, 'store'])->name('gedung.create');
        Route::post('gedung/edit/{id}', [GedungController::class, 'update'])->name('gedung.edit');
        // Gedung Gedilg
        Route::get('gedung/area-kerja/tambah', [AreaKerjaController::class, 'create'])->name('area_kerja.create');
        Route::get('gedung/area-kerja/edit/{id}', [AreaKerjaController::class, 'edit'])->name('area_kerja.edit');
        Route::get('gedung/area-kerja/delete/{id}', [AreaKerjaController::class, 'destroy'])->name('area_kerja.delete');
        Route::post('gedung/area-kerja/tambah', [AreaKerjaController::class, 'store'])->name('area_kerja.create');
        Route::post('gedung/area-kerja/edit/{id}', [AreaKerjaController::class, 'update'])->name('area_kerja.edit');
        // Kriteria
        Route::get('penilaian/kriteria/tambah', [KriteriaPenilaianController::class, 'create'])->name('kriteria.create');
        Route::get('penilaian/kriteria/edit/{id}', [KriteriaPenilaianController::class, 'edit'])->name('kriteria.edit');
        Route::get('penilaian/kriteria/delete/{id}', [KriteriaPenilaianController::class, 'destroy'])->name('kriteria.delete');
        Route::post('penilaian/kriteria/tambah', [KriteriaPenilaianController::class, 'store'])->name('kriteria.create');
        Route::post('penilaian/kriteria/edit/{id}', [KriteriaPenilaianController::class, 'update'])->name('kriteria.edit');
        // Pegawai
        Route::get('pegawai', [PegawaiController::class, 'index'])->name('pegawai.show');
        Route::get('pegawai/tambah', [PegawaiController::class, 'create'])->name('pegawai.create');
        Route::get('pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
        Route::get('pegawai/hapus/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.delete');
        Route::post('pegawai/tambah', [PegawaiController::class, 'store'])->name('pegawai.create');
        Route::post('pegawai/edit/{id}', [PegawaiController::class, 'update'])->name('pegawai.edit');
        Route::post('pegawai/select', [PegawaiController::class, 'select'])->name('pegawai.select');
        // Penyedia
        Route::get('penyedia', [PenyediaController::class, 'index'])->name('penyedia.show');
        Route::get('penyedia/tambah', [PenyediaController::class, 'create'])->name('penyedia.create');
        Route::get('penyedia/edit/{id}', [PenyediaController::class, 'edit'])->name('penyedia.edit');
        Route::get('penyedia/hapus/{id}', [PenyediaController::class, 'destroy'])->name('penyedia.delete');
        Route::post('penyedia/tambah', [PenyediaController::class, 'store'])->name('penyedia.create');
        Route::post('penyedia/edit/{id}', [PenyediaController::class, 'update'])->name('penyedia.edit');
        // Pengguna
        Route::get('user', [UserController::class, 'index'])->name('user.show');
        Route::get('user/tambah', [UserController::class, 'create'])->name('user.create');
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::get('user/hapus/{id}', [UserController::class, 'destroy'])->name('user.delete');
        Route::post('user/tambah', [UserController::class, 'store'])->name('user.create');
        Route::post('user/edit/{id}', [UserController::class, 'update'])->name('user.edit');
        // Unit Kerja

    });


    Route::get('pegawai/info/{id}', [PegawaiController::class, 'show']);
    Route::get('penilaian/kriteria/info/{id}', [KriteriaPenilaianController::class, 'info']);
    Route::get('pegawai/select/{id}', [PegawaiController::class, 'selectById']);
    Route::get('gedung/area-kerja/select/{id}', [AreaKerjaController::class, 'selectByCategory']);

});
