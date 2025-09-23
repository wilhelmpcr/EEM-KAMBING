<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PegawaiController;



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
    return 'Nama saya: '.$param1;
});

Route::get('/nim/{param1?}', function ($param1 = '2457301152') {
    return 'NIM saya: '.$param1;
});

Route::get('/mahasiswa/{param1}', [MahasiswaController::class, 'show'])->name('user.show');

Route::get('/about', function () {
    return view('halaman-about');
});

route::get ('/blade',[PegawaiController::class,'index']);
