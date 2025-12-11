<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapBulanan;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekapBulananController extends Controller
{
    public function index()
    {
        $rekap = RekapBulanan::where('user_id', Auth::id())
                     ->orderBy('tahun', 'desc')
                     ->orderBy('bulan', 'desc')
                     ->get();

        return view('rekap.index', compact('rekap'));
    }

    public function prosesRekap()
    {
        $bulan = 4;
        $tahun = 2026;

        if (RekapBulanan::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('user_id', Auth::id())
            ->exists()) {
            return back()->with('error', 'Rekap bulan ini sudah dilakukan!');
        }

        $saldoUser = SaldoUser::firstOrCreate(['user_id' => Auth::id()]);

        $rekapSebelumnya = RekapBulanan::where('user_id', Auth::id())
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();

        $total_pemasukan = UangSaku::where('user_id', Auth::id())
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        $total_pengeluaran = Pengeluaran::where('user_id', Auth::id())
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        // =============================
        // LOGIC YANG BENAR SESUAI MAUMU
        // =============================

        if ($rekapSebelumnya) {
            // bukan bulan pertama
            $saldo_awal = $rekapSebelumnya->saldo_akhir;
            $saldo_akhir = $saldo_awal + $total_pemasukan - $total_pengeluaran;

        } else {
            // bulan pertama
            $saldo_awal = $saldoUser->saldo;  // contoh: 10.000
            $saldo_akhir = $total_pemasukan - $total_pengeluaran; 
            // contoh: 10.000 - 2.000 = 8.000 ✔
        }

        RekapBulanan::create([
            'user_id' => Auth::id(),
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total_pemasukan' => $total_pemasukan,
            'total_pengeluaran' => $total_pengeluaran,
            'saldo_awal' => $saldo_awal,
            'saldo_akhir' => $saldo_akhir,
        ]);

        // update saldo user agar sinkron
        $saldoUser->saldo = $saldo_akhir;
        $saldoUser->save();

        return back()->with('success', 'Rekap bulanan selesai!');
    }
}