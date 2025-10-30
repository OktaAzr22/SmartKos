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
        $userId = Auth::id();
        $now = Carbon::now();
        $bulanIni = $now->format('F');
        $tahunIni = $now->year;

        // Ambil semua rekap
        $rekap = RekapBulanan::where('id_user', $userId)
            ->orderByDesc('tahun')
            ->orderByDesc('id_rekap')
            ->get();

        // Cek apakah sudah pernah rekap bulan ini
        $sudahRekap = RekapBulanan::where('id_user', $userId)
            ->where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->exists();

        // Cek apakah sudah akhir bulan
        $isAkhirBulan = $now->isSameDay($now->copy()->endOfMonth());

        return view('keuangan.rekap.index', compact('rekap', 'sudahRekap', 'isAkhirBulan'));
    }

    public function generate()
    {
        $userId = Auth::id();
        $now = Carbon::now();
        $bulan = $now->format('F');
        $tahun = $now->year;

        // Cek kalau belum akhir bulan
        if (!$now->isSameDay($now->copy()->endOfMonth())) {
            return redirect()->route('rekap.index')
                ->with('error', 'Rekap hanya bisa dilakukan di akhir bulan.');
        }

        // Cek apakah sudah ada rekap bulan ini
        $sudahAda = RekapBulanan::where('id_user', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->exists();

        if ($sudahAda) {
            return redirect()->route('rekap.index')
                ->with('error', 'Rekap bulan ini sudah dibuat.');
        }

        DB::beginTransaction();
        try {
            // Hitung total pemasukan & pengeluaran bulan ini
            $totalPemasukan = UangSaku::where('id_user', $userId)
                ->whereMonth('tanggal', $now->month)
                ->whereYear('tanggal', $tahun)
                ->sum('jumlah');

            $totalPengeluaran = Pengeluaran::where('id_user', $userId)
                ->whereMonth('tanggal', $now->month)
                ->whereYear('tanggal', $tahun)
                ->sum('jumlah');

            // Ambil saldo terakhir user
            $saldoUser = SaldoUser::where('id_user', $userId)->first();
            $saldoAkhir = ($saldoUser->saldo ?? 0) + $totalPemasukan - $totalPengeluaran;

            // Simpan rekap
            RekapBulanan::create([
                'id_user' => $userId,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'total_pemasukan' => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
                'saldo_akhir' => $saldoAkhir,
            ]);

            // Update saldo user
            if ($saldoUser) {
                $saldoUser->saldo = $saldoAkhir;
                $saldoUser->save();
            }

            DB::commit();
            return redirect()->route('rekap.index')->with('success', 'Rekap bulan ini berhasil dibuat!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('rekap.index')->with('error', 'Gagal membuat rekap: ' . $e->getMessage());
        }
    }

    /**
     * Rekap otomatis jika lewat akhir bulan dan belum direkap
     */
    public static function autoGenerate()
    {
        $users = SaldoUser::pluck('id_user');
        $now = Carbon::now();

        foreach ($users as $userId) {
            $sudahAda = RekapBulanan::where('id_user', $userId)
                ->where('bulan', $now->format('F'))
                ->where('tahun', $now->year)
                ->exists();

            if (!$sudahAda && $now->greaterThanOrEqualTo($now->copy()->endOfMonth())) {
                app(self::class)->generateAuto($userId);
            }
        }
    }

    private function generateAuto($userId)
    {
        $now = Carbon::now();
        $bulan = $now->format('F');
        $tahun = $now->year;

        $totalPemasukan = UangSaku::where('id_user', $userId)
            ->whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        $totalPengeluaran = Pengeluaran::where('id_user', $userId)
            ->whereMonth('tanggal', $now->month)
            ->whereYear('tanggal', $tahun)
            ->sum('jumlah');

        $saldoUser = SaldoUser::where('id_user', $userId)->first();
        $saldoAkhir = ($saldoUser->saldo ?? 0) + $totalPemasukan - $totalPengeluaran;

        RekapBulanan::create([
            'id_user' => $userId,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'total_pemasukan' => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_akhir' => $saldoAkhir,
        ]);

        if ($saldoUser) {
            $saldoUser->saldo = $saldoAkhir;
            $saldoUser->save();
        }
    }
}
