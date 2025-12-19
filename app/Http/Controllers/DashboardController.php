<?php

namespace App\Http\Controllers;


use App\Models\Pengeluaran;
use App\Models\RekapBulanan;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();

        /* =========================
        * DATA UTAMA DASHBOARD
        * ========================= */
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

        $totalPemasukan = RekapBulanan::where('user_id', $userId)->sum('total_pemasukan');
        $totalPengeluaran = RekapBulanan::where('user_id', $userId)->sum('total_pengeluaran');

        /* =========================
        * TRANSAKSI LIST
        * ========================= */
        $tipe = $request->query('tipe');

        $pemasukan = UangSaku::select(
            'tanggal',
            'jumlah',
            'keterangan',
            DB::raw("'Pemasukan' as tipe")
        )->where('user_id', $userId);

        $pengeluaran = Pengeluaran::select(
            'tanggal',
            'jumlah',
            'keterangan',
            DB::raw("'Pengeluaran' as tipe")
        )->where('user_id', $userId);

        if ($tipe === 'pemasukan') {
            $transaksiAll = $pemasukan->orderBy('tanggal', 'desc')->get();
        } elseif ($tipe === 'pengeluaran') {
            $transaksiAll = $pengeluaran->orderBy('tanggal', 'desc')->get();
        } else {
            $transaksiAll = $pemasukan
                ->unionAll($pengeluaran)
                ->orderBy('tanggal', 'desc')
                ->get();
        }

        $transaksi = new LengthAwarePaginator(
            $transaksiAll->forPage(request('page', 1), 5),
            $transaksiAll->count(),
            5,
            request('page', 1),
            ['path' => request()->url(), 'query' => request()->query()]
        );

        /* =========================
        * DATA GRAFIK (TAHUNAN)
        * ========================= */
        $tahunTersedia = RekapBulanan::where('user_id', $userId)
            ->select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $tahun = $tahunTersedia->first();

        $rekapBulanan = RekapBulanan::where('user_id', $userId)
            ->where('tahun', $tahun)
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $dataPemasukan = [];
        $dataPengeluaran = [];
        $dataSaldoAkhir = [];

        foreach ($rekapBulanan as $rekap) {
            $labels[] = Carbon::create()->month($rekap->bulan)->translatedFormat('F');
            $dataPemasukan[]   = (int) $rekap->total_pemasukan;
            $dataPengeluaran[] = (int) $rekap->total_pengeluaran;
            $dataSaldoAkhir[]  = (int) $rekap->saldo_akhir;
        }

        /* =========================
        * 🔥 FILTER BULAN KHUSUS KATEGORI
        * ========================= */
        /* =========================
        * BULAN TERSEDIA UNTUK KATEGORI
        * ========================= */
        $bulanKategoriTersedia = RekapBulanan::where('user_id', $userId)
            ->whereHas('kategoriPengeluaran')
            ->where('tahun', now()->year)
            ->orderBy('bulan', 'desc')
            ->pluck('bulan')
            ->unique();
            // 
        $bulanKategori = $request->get(
            'bulan_kategori',
            $bulanKategoriTersedia->first() ?? now()->month
        );

        $rekapKategori = RekapBulanan::with('kategoriPengeluaran.kategori')
            ->where('user_id', $userId)
            ->where('bulan', $bulanKategori)
            ->where('tahun', now()->year)
            ->first();

        $topKategori = $rekapKategori
            ? $rekapKategori->kategoriPengeluaran
            : collect();

        $totalPengeluaranRekap = $topKategori->sum('total_nominal');

        return view('dashboard', compact(
            'saldoSaatIni',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'totalPemasukan',
            'totalPengeluaran',
            'transaksi',
            'tipe',
            'labels',
            'dataPemasukan',
            'dataPengeluaran',
            'dataSaldoAkhir',
            'tahun',
            'tahunTersedia',
            'topKategori',
            'totalPengeluaranRekap',
            'bulanKategori',
            'bulanKategoriTersedia',
        ));
    }

    public function chartData(Request $request)
    {
        $userId = Auth::id();
        $tahun = $request->get('tahun');

        $rekapBulanan = RekapBulanan::where('user_id', $userId)
            ->where('tahun', $tahun)
            ->orderBy('bulan')
            ->get();

        $labels = [];
        $pemasukan = [];
        $pengeluaran = [];
        $saldoAkhir = [];

        foreach ($rekapBulanan as $rekap) {
            $labels[] = Carbon::create()->month($rekap->bulan)->translatedFormat('F');
            $pemasukan[] = (int) $rekap->total_pemasukan;
            $pengeluaran[] = (int) $rekap->total_pengeluaran;
            $saldoAkhir[] = (int) $rekap->saldo_akhir;
        }

        return response()->json([
            'labels' => $labels,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'saldoAkhir' => $saldoAkhir,
        ]);
    }
}