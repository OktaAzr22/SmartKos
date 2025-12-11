<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\UangSakuController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaldoUserController;
use App\Http\Controllers\RekapBulananController;


// ===========================
// AUTH
// ===========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===========================
// PROTECT ROUTES WITH AUTH
// ===========================
Route::middleware('auth')->group(function () {

    // ======================
    // DASHBOARD
    // ======================
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('/kategori', KategoriPengeluaranController::class)->names('keuangan.kategori');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])
    ->name('pengeluaran.create');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');

    // ======================
    // UANG SAKU (PEMASUKAN)
    // ======================
    Route::get('/uang-saku', [UangSakuController::class, 'index'])
        ->name('uang_saku.index');

    Route::post('/uang-saku', [UangSakuController::class, 'store'])
        ->name('uang_saku.store');


    // ======================
    // PENGELUARAN
    // ======================
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])
        ->name('pengeluaran.index');

    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])
        ->name('pengeluaran.store');


    


    // ======================
    // REKAP BULANAN
    // ======================
    Route::get('/rekap', [RekapBulananController::class, 'index'])
        ->name('rekap.index');

    Route::post('/rekap/proses', [RekapBulananController::class, 'prosesRekap'])
        ->name('rekap.proses');
});
