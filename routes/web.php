<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pcr', function () {
    return 'Selamat Datang di Website Kampus PCR!';
});

Route::get('/mahasiswa', function () {
    return 'Halo Mahasiswa';
})->name('mahasiswa.show');

Route::get('/nama/{eem}', function ($param1) {
    return 'Nama saya: ' . $param1;
});

Route::get('/nim/{param1?}', function ($param1 = '2457301152') {
    return 'NIM saya: ' . $param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show'])->name('user.show');

Route::get('/about', function () {
    return view('halaman-about');
});

route::get('/blade', [PegawaiController::class, 'index']);

route::get('/home', [HomeController::class, 'index'])->name('home');

Route::post('question/store', [QuestionController::class, 'store'])
    ->name('question.store');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('pelanggan', PelangganController::class);
