<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $bulan = date('F');
        $tahun = date('Y');

        $saldo = SaldoUser::where('id_user', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();
        $sisaSaldo = $saldo ? $saldo->saldo_sekarang : 0;

        $pemasukanBulan = UangSaku::where('id_user', $userId)
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', $tahun)
            ->sum('jumlah');

        $pemasukanTotal = UangSaku::where('id_user', $userId)->sum('jumlah');

        $pengeluaranBulan = Pengeluaran::where('id_user', $userId)
            ->whereMonth('tanggal_pengeluaran', date('m'))
            ->whereYear('tanggal_pengeluaran', $tahun)
            ->sum('jumlah');

        $pengeluaranTotal = Pengeluaran::where('id_user', $userId)->sum('jumlah');

        // 🔹 Ambil data pemasukan
        $pemasukan = UangSaku::where('id_user', $userId)
            ->select('id_uang_saku', 'jumlah', 'keterangan', 'created_at as tanggal')
            ->get()
            ->map(function ($item) {
                return [
                    'tipe' => 'Pemasukan',
                    'jumlah' => $item->jumlah,
                    'keterangan' => $item->keterangan ?? '-',
                    'tanggal' => $item->tanggal,
                ];
            });

        // 🔹 Ambil data pengeluaran
        $pengeluaran = Pengeluaran::where('id_user', $userId)
            ->select('id_pengeluaran', 'jumlah', 'deskripsi as keterangan', 'tanggal_pengeluaran as tanggal')
            ->get()
            ->map(function ($item) {
                return [
                    'tipe' => 'Pengeluaran',
                    'jumlah' => $item->jumlah,
                    'keterangan' => $item->keterangan ?? '-',
                    'tanggal' => $item->tanggal,
                ];
            });

        // 🔹 Gabungkan
    $transaksiGabungan = $pemasukan->concat($pengeluaran);

    // 🔹 Filter berdasarkan tipe jika ada request
    $filter = $request->get('filter');
    if ($filter === 'pemasukan') {
        $transaksiGabungan = $transaksiGabungan->where('tipe', 'Pemasukan');
    } elseif ($filter === 'pengeluaran') {
        $transaksiGabungan = $transaksiGabungan->where('tipe', 'Pengeluaran');
    }

    // 🔹 Urutkan berdasarkan tanggal terbaru
    $transaksiGabungan = $transaksiGabungan->sortByDesc('tanggal')->values();

    // 🔹 Pagination manual
    $perPage = 5;
    $currentPage = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
    $currentItems = $transaksiGabungan->slice(($currentPage - 1) * $perPage, $perPage)->values();

    $transaksi = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentItems,
        $transaksiGabungan->count(),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('dashboard', compact(
        'sisaSaldo',
        'pemasukanBulan',
        'pemasukanTotal',
        'pengeluaranBulan',
        'pengeluaranTotal',
        'transaksi',
        'filter' // 👈 kirim ke view untuk tanda dropdown aktif
    ));
}
}