<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\RekapBulanan;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RekapBulananController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua rekap milik user
        $rekap = RekapBulanan::where('id_user', $userId)
            ->orderByDesc('tahun')
            ->orderByDesc('id_rekap')
            ->get();

        return view('rekap.index', compact('rekap'));
    }

    public function generate()
    {
        $userId = Auth::id();
        $bulan = date('F'); // contoh: October
        $tahun = date('Y');

        DB::beginTransaction();
        try {
            // Hitung total uang saku bulan ini
            $totalPemasukan = UangSaku::where('id_user', $userId)
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', $tahun)
                ->sum('jumlah');

            // Hitung total pengeluaran bulan ini
            $totalPengeluaran = Pengeluaran::where('id_user', $userId)
                ->whereMonth('tanggal_pengeluaran', date('m'))
                ->whereYear('tanggal_pengeluaran', $tahun)
                ->sum('jumlah');

            // Ambil saldo terakhir user bulan ini
            $saldo = SaldoUser::where('id_user', $userId)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->first();

            $saldoAkhir = $saldo ? $saldo->saldo_sekarang : 0;

            // Simpan ke tabel rekap_bulanan
            RekapBulanan::updateOrCreate(
                [
                    'id_user' => $userId,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                ],
                [
                    'total_pemasukan' => $totalPemasukan,
                    'total_pengeluaran' => $totalPengeluaran,
                    'saldo_akhir' => $saldoAkhir,
                ]
            );

            DB::commit();
            return redirect()
                ->route('rekap.index')
                ->with('success', 'Rekap bulanan berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Gagal membuat rekap: ' . $e->getMessage());
        }
    }
}
