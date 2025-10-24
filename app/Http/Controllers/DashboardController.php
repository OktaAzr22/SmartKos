<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $bulan = date('F');
        $tahun = date('Y');

        // 💰 Sisa saldo saat ini
        $saldo = SaldoUser::where('id_user', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();
        $sisaSaldo = $saldo ? $saldo->saldo_sekarang : 0;

        // 🟢 Total pemasukan bulan ini
        $pemasukanBulan = UangSaku::where('id_user', $userId)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', $tahun)
            ->sum('jumlah');

        // 💹 Total pemasukan selama ini
        $pemasukanTotal = UangSaku::where('id_user', $userId)->sum('jumlah');

        // 🔴 Total pengeluaran bulan ini
        $pengeluaranBulan = Pengeluaran::where('id_user', $userId)
            ->whereMonth('tanggal_pengeluaran', date('m'))
            ->whereYear('tanggal_pengeluaran', $tahun)
            ->sum('jumlah');

        // 📉 Total pengeluaran selama ini
        $pengeluaranTotal = Pengeluaran::where('id_user', $userId)->sum('jumlah');

        return view('dashboard.index', compact(
            'sisaSaldo',
            'pemasukanBulan',
            'pemasukanTotal',
            'pengeluaranBulan',
            'pengeluaranTotal'
        ));
    }
}
