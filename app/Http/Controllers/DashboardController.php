<?php

namespace App\Http\Controllers;


use App\Models\Pengeluaran;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Saldo saat ini
        $saldo = SaldoUser::where('user_id', $userId)->first();
        $saldoSaatIni = $saldo ? $saldo->saldo : 0;

        // Total pemasukan bulan ini
        $pemasukanBulanIni = UangSaku::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        // Total pemasukan selama ini
        $totalPemasukan = UangSaku::where('user_id', $userId)->sum('jumlah');

        // Total pengeluaran bulan ini
        $pengeluaranBulanIni = Pengeluaran::where('user_id', $userId)
            ->whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)
            ->sum('jumlah');

        // Total pengeluaran selama ini
        $totalPengeluaran = Pengeluaran::where('user_id', $userId)->sum('jumlah');

        return view('dashboard.index', compact(
            'saldoSaatIni',
            'pemasukanBulanIni',
            'totalPemasukan',
            'pengeluaranBulanIni',
            'totalPengeluaran'
        ));
    }
}
