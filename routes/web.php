<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{param1}', function ($param1) {
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '') {
    return 'NIM saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show']);

Route::get('/about', function () {
    return view('halaman-about');
});
Route::get('/matakuliah/{param1}', [MatakuliahController::class, 'show']);
//tes?

Route::get('/home',[HomeController::class,'index'])->name('home');

Route::get('/pegawai', [PegawaiController::class, 'index']);


Route::post('question/store', [QuestionController::class, 'store'])
        ->name('question.store');


Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

// PELANGGAN ROUTES - DIPERBAIKI
Route::resource('pelanggan', PelangganController::class);
Route::get('pelanggan/{id}/show', [PelangganController::class, 'show'])->name('pelanggan.show');
Route::delete('pelanggan/file/{id}', [PelangganController::class, 'deleteFile'])->name('pelanggan.deleteFile');

Route::resource('user', UserController::class);

// Customer routes (jika masih dipakai)
Route::get('customer/{id}/detail', [CustomerController::class, 'detail'])->name('customer.detail');
Route::post('customer/{id}/upload', [CustomerController::class, 'uploadFiles'])->name('customer.uploadFiles');
Route::delete('customer/file/{id}', [CustomerController::class, 'deleteFile'])->name('customer.deleteFile');
