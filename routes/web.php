<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

// 1. Jalur UTAMA (/) harus mengarah ke halaman welcome (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// 2. Jalur BARU (/dashboard) mengarah ke halaman dashboard isi form parkir
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// 3. Jalur aksi untuk memproses data form
Route::post('/parkir/masuk', [TransaksiController::class, 'parkirMasuk'])->name('parkir.masuk');
Route::post('/parkir/keluar/{id}', [TransaksiController::class, 'parkirKeluar'])->name('parkir.keluar');