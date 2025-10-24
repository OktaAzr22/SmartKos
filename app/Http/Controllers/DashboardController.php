<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekapBulanan;
use App\Models\Pengeluaran;
use App\Models\UangSaku;
use App\Models\SaldoUser;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        $userId = Auth::id();
        $bulanSekarang = Carbon::now()->month;
        $tahunSekarang = Carbon::now()->year;

        // Ambil saldo terakhir dari rekap_bulanan atau saldo_user
        $saldoSekarang = RekapBulanan::where('id_user', $userId)
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->value('saldo_akhir') ?? 0;

        // Total semua saldo sepanjang waktu (total pemasukan - total pengeluaran)
        $totalPemasukanSemua = UangSaku::where('id_user', $userId)->sum('jumlah');
        $totalPengeluaranSemua = Pengeluaran::where('id_user', $userId)->sum('jumlah');
        $totalSaldoSemua = $totalPemasukanSemua - $totalPengeluaranSemua;

        // Total pemasukan bulan ini
        $totalPemasukanBulan = UangSaku::where('id_user', $userId)
            ->whereMonth('created_at', $bulanSekarang)
            ->whereYear('created_at', $tahunSekarang)
            ->sum('jumlah');

        // Total pengeluaran bulan ini
        $totalPengeluaranBulan = Pengeluaran::where('id_user', $userId)
            ->whereMonth('tanggal_pengeluaran', $bulanSekarang)
            ->whereYear('tanggal_pengeluaran', $tahunSekarang)
            ->sum('jumlah');

        return view('dashboard.index', compact(
            'saldoSekarang',
            'totalSaldoSemua',
            'totalPemasukanSemua',
            'totalPengeluaranSemua',
            'totalPemasukanBulan',
            'totalPengeluaranBulan'
        ));
    }
}
