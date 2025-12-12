<?php

namespace App\Http\Controllers;


use App\Models\Pengeluaran;
use App\Models\RekapBulanan;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $saldo = SaldoUser::where('user_id', $userId)->first();
        $saldoSaatIni = $saldo ? $saldo->saldo : 0;

        $pemasukanBulanIni = UangSaku::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        $pengeluaranBulanIni = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

         $totalPemasukan = RekapBulanan::where('user_id', $userId)
            ->sum('total_pemasukan');

        $totalPengeluaran = RekapBulanan::where('user_id', $userId)
            ->sum('total_pengeluaran');

        return view('dashboard.index', compact(
            'saldoSaatIni',
            'pemasukanBulanIni',
            'totalPemasukan',
            'pengeluaranBulanIni',
            'totalPengeluaran'
        ));
    }
}
