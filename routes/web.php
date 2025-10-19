<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\UangSakuController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('home');

// 🔐 Auth (Guest Only)
Route::middleware(['guest', 'throttle:5,1'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// 🧾 Dashboard & Fitur (Auth Only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::view('/profile', 'profile')->name('profile');

    // 💰 Uang Saku
    Route::get('/uang-saku/create', [UangSakuController::class, 'create'])->name('uang-saku.create');
    Route::post('/uang-saku/store', [UangSakuController::class, 'store'])->name('uang-saku.store');

    // 📂 Kategori
    Route::resource('kategori', KategoriPengeluaranController::class);

    // 💸 Pengeluaran
    Route::resource('pengeluaran', PengeluaranController::class)->except(['show', 'edit', 'update']);

    // 🚪 Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


