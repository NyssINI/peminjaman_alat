<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\DatapeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\LogaktivitasController;
use App\Http\Controllers\CetakLaporanController;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'admin') return redirect()->route('users.index');
        if ($role === 'petugas') return redirect()->route('petugas.index');
        return redirect()->route('peminjam.index');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('users', UserController::class);
    Route::resource('alat', AlatController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('peminjam', PeminjamController::class);
    Route::resource('petugas', PetugasController::class);
    Route::resource('datapeminjaman', DataPeminjamanController::class);
    Route::resource('logaktivitas', LogaktivitasController::class);
    Route::resource('cetaklaporan', CetakLaporanController::class);
});         