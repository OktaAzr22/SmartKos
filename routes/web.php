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

    return auth()->check()
        ? redirect()->route('dashboard')
        : view('index');

})->name('home');

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('login');
        Route::post('/login', 'login')->name('login.process');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/dashboard/chart', 'chartData')->name('dashboard.chart');
    });
    Route::resource('/kategori', KategoriPengeluaranController::class)->names('keuangan.kategori');
    Route::resource('/pengeluaran', PengeluaranController::class)
            ->only(['index','create','store',
    ]);
    Route::controller(UangSakuController::class)->group(function () {
        Route::get('/uang-saku', 'index')->name('uang_saku.index');
        Route::post('/uang-saku', 'store')->name('uang_saku.store');
    });
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::put('/profile/update', 'update')->name('profile.update');
        Route::put('/profile/update-image', 'updateImage')->name('profile.updateImage');
    });
    Route::prefix('rekap')->name('rekap.')->controller(RekapBulananController::class)->group(function () {
        Route::get('/', 'index')->name('index');
            Route::post('/proses', 'prosesRekap')->name('proses');
            Route::get('/{id}/detail', 'detail')->name('detail');
            Route::get('/{id}/cetak', 'cetakPDF')->name('cetak');
            Route::get('/{id}/pdf', 'viewPdf')->name('viewPdf');
        });
});

if (app()->environment('local')) {

    Route::get('/test', function () {

        return view('test');

    })->name('test');

}