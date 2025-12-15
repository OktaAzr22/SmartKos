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

Route::get('/', function () {
    // kalau sudah login, langsung ke dashboard
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    // halaman statis landing
    return view('index');
})->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('/kategori', KategoriPengeluaranController::class)->names('keuangan.kategori');

    Route::resource('/pengeluaran', PengeluaranController::class)
        ->only(['index', 'store', 'create']);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-image', [ProfileController::class, 'updateImage'])->name('profile.updateImage');

    Route::get('/uang-saku', [UangSakuController::class, 'index'])
        ->name('uang_saku.index');

    Route::post('/uang-saku', [UangSakuController::class, 'store'])
        ->name('uang_saku.store');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])
        ->name('pengeluaran.index');

    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])
        ->name('pengeluaran.store');

    Route::get('/rekap', [RekapBulananController::class, 'index'])
        ->name('rekap.index');

    Route::post('/rekap/proses', [RekapBulananController::class, 'prosesRekap'])
        ->name('rekap.proses');

    Route::get('/rekap/{id}/detail', [RekapBulananController::class, 'detail'])
        ->name('rekap.detail');

    Route::get('/rekap/{id}/cetak', [RekapBulananController::class, 'cetakPDF'])
        ->name('rekap.cetak');

    Route::get('/rekap/{id}/pdf', [RekapBulananController::class, 'viewPdf'])
        ->name('rekap.viewPdf'); 

    Route::get('/dashboard/chart', [DashboardController::class, 'chartData'])
    ->name('dashboard.chart');

});