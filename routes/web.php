<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('home');

// Halaman login (guest only)
Route::middleware('guest', 'throttle:5,1')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
});

// Halaman dashboard (auth only)
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
     Route::view('/produk', 'produk')->name('produk');
    Route::view('/profile', 'profile')->name('profile');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

