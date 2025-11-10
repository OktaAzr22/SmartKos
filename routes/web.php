<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekapBulananController;
use App\Http\Controllers\UangSakuController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('home');

// Auth (Guest Only)
Route::middleware(['guest', 'throttle:5,1'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

//  Dashboard & Fitur (Auth Only)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('dashboard.chartData');
Route::get('/dashboard/chart-kategori', [DashboardController::class, 'chartKategori']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');

    Route::resource('uang-saku', UangSakuController::class)->only(['index', 'store']);

    Route::resource('/kategori', KategoriPengeluaranController::class)->names('keuangan.kategori');

    Route::resource('pengeluaran', PengeluaranController::class)->except(['show', 'edit', 'update']);

    Route::get('/rekap', [RekapBulananController::class, 'index'])->name('rekap.index');
    Route::post('/rekap/generate', [RekapBulananController::class, 'generate'])->name('rekap.generate');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout'); 

    Route::get('/test-error', function () {
    abort(500);
});

});