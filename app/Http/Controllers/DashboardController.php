<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        // Ambil saldo aktif user
        $saldo = \App\Models\SaldoUser::where('id_user', $userId)
            ->orderByDesc('tahun')
            ->orderByDesc('id_saldo')
            ->first();

        // Ambil 5 riwayat setor terakhir
        $riwayat = \App\Models\UangSaku::where('id_user', $userId)
            ->orderByDesc('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact('saldo', 'riwayat'));
    }
}
