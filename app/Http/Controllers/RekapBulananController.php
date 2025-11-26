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
    public function indexUser()
    {
        $userId = auth()->id();

        $rekap = RekapBulanan::where('id_user', $userId)
            ->orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->get();

        return view('rekap.user', compact('rekap'));
    }

    public function prosesRekapUser()
{
    $userId = auth()->id();

    $now = now();

    // ================================================
    // 1. Rekap hanya bisa di akhir bulan
    // ================================================
    if ($now->day !== $now->endOfMonth()->day) {
        return back()->with('error', 'Rekap hanya dapat dilakukan pada akhir bulan!');
    }

    // ================================================
    // 2. Cek apakah bulan ini sudah direkap
    // ================================================
    $bulanIni = $now->format('F');
    $tahunIni = $now->year;

    $sudahRekapBulanIni = RekapBulanan::where('id_user', $userId)
        ->where('bulan', $bulanIni)
        ->where('tahun', $tahunIni)
        ->exists();

    if ($sudahRekapBulanIni) {

        // ================================================
        // 3. Jika sudah rekap bulan ini → cek bulan lalu
        // ================================================
        $bulanLaluCarbon = $now->copy()->subMonth();
        $bulanLalu = $bulanLaluCarbon->format('F');
        $tahunLalu = $bulanLaluCarbon->year;

        $sudahRekapBulanLalu = RekapBulanan::where('id_user', $userId)
            ->where('bulan', $bulanLalu)
            ->where('tahun', $tahunLalu)
            ->exists();

        if ($sudahRekapBulanLalu) {
            return back()->with('error', 'Rekap bulan ini dan bulan lalu sudah dilakukan!');
        }

        // Kalau bulan ini sudah direkap, bulan lalu belum → gunakan bulan lalu
        $targetRekap = $bulanLaluCarbon;
    } else {
        // Rekap bulan ini
        $targetRekap = $now;
    }

    // ================================================
    // 4. UBAH VARIABEL BULAN & TAHUN AGAR LOGIKAMU TETAP JALAN
    // ================================================
    $bulanIni = $targetRekap->format('F');
    $tahunIni = $targetRekap->year;

    // ================================================
    // 5. Baru lanjutkan logika asli kamu (TIDAK DIUBAH)
    // ================================================

    // HITUNG PEMASUKAN BULAN
    $totalPemasukan = UangSaku::where('id_user', $userId)
        ->whereMonth('created_at', $targetRekap->month)
        ->whereYear('created_at', $targetRekap->year)
        ->sum('jumlah');

    // HITUNG PENGELUARAN BULAN
    $totalPengeluaran = Pengeluaran::where('id_user', $userId)
        ->whereMonth('tanggal_pengeluaran', $targetRekap->month)
        ->whereYear('tanggal_pengeluaran', $targetRekap->year)
        ->sum('jumlah');

    // AMBIL SALDO BULAN SEBELUMNYA
    $bulanLalu = $targetRekap->copy()->subMonth()->format('F');
    $tahunLalu = $targetRekap->copy()->subMonth()->year;

    $saldoSebelumnya = SaldoUser::where('id_user', $userId)
        ->where('bulan', $bulanLalu)
        ->where('tahun', $tahunLalu)
        ->value('saldo_sekarang') ?? 0;

    // HITUNG SALDO AKHIR
    $saldoAkhir = $saldoSebelumnya + $totalPemasukan - $totalPengeluaran;

    // SIMPAN + UPDATE SALDO (logika asli kamu)
    DB::transaction(function () use (
        $userId,
        $bulanIni,
        $tahunIni,
        $totalPemasukan,
        $totalPengeluaran,
        $saldoSebelumnya,
        $saldoAkhir
    ) {

        RekapBulanan::create([
            'id_user'     => $userId,
            'bulan'       => $bulanIni,
            'tahun'       => $tahunIni,
            'total_pemasukan'  => $totalPemasukan,
            'total_pengeluaran' => $totalPengeluaran,
            'saldo_akhir' => $saldoAkhir,
        ]);

        SaldoUser::updateOrCreate(
            [
                'id_user' => $userId,
                'bulan'   => $bulanIni,
                'tahun'   => $tahunIni,
            ],
            [
                'saldo_awal'      => $saldoSebelumnya,
                'saldo_sekarang'  => $saldoAkhir,
            ]
        );
    });

    return back()->with('success', "Rekap bulan $bulanIni tahun $tahunIni berhasil diproses!");
}

}
