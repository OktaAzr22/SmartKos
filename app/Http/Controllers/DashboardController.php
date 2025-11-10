<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use App\Models\Pengeluaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Ambil total pemasukan & pengeluaran (bulan ini / semua waktu)
     */
    private function getSummary($userId, $mode = 'bulan')
    {
        $bulan = date('m');
        $tahun = date('Y');

        $uangSakuQuery = UangSaku::where('id_user', $userId);
        $pengeluaranQuery = Pengeluaran::where('id_user', $userId);

        if ($mode !== 'semua') {
            $uangSakuQuery->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun);
            $pengeluaranQuery->whereMonth('tanggal_pengeluaran', $bulan)->whereYear('tanggal_pengeluaran', $tahun);
        }

        return [
            'pemasukan' => $uangSakuQuery->sum('jumlah'),
            'pengeluaran' => $pengeluaranQuery->sum('jumlah'),
        ];
    }

    /**
     * API chart JSON
     */
    public function chartData(Request $request)
    {
        $userId = Auth::id();
        $mode = $request->get('mode', 'bulan');

        $summary = $this->getSummary($userId, $mode);

        return response()->json($summary);
    }

    public function chartKategori(Request $request)
    {
        $userId = Auth::id();
        $mode = $request->get('mode', 'bulan');

        $query = \App\Models\Pengeluaran::selectRaw('kategori_pengeluaran.nama_kategori, COUNT(*) as total_transaksi')
            ->join('kategori_pengeluaran', 'pengeluaran.id_kategori', '=', 'kategori_pengeluaran.id_kategori')
            ->where('pengeluaran.id_user', $userId);

        if ($mode !== 'semua') {
            $query->whereMonth('tanggal_pengeluaran', date('m'))
                ->whereYear('tanggal_pengeluaran', date('Y'));
        }

        $data = $query->groupBy('kategori_pengeluaran.nama_kategori')->get();

        return response()->json($data);
    }


    /**
     * Halaman utama dashboard
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $mode = $request->get('mode', 'bulan');
        $filter = $request->get('filter');
        $tahun = date('Y');

        // Ambil saldo bulan ini
        $saldo = SaldoUser::where('id_user', $userId)
            ->where('bulan', date('F'))
            ->where('tahun', $tahun)
            ->first();
        $sisaSaldo = $saldo?->saldo_sekarang ?? 0;

        // Total pemasukan dan pengeluaran (reuse fungsi)
        $summary = $this->getSummary($userId, $mode);

        // Statistik tambahan
        $pemasukanBulan = $this->getSummary($userId, 'bulan')['pemasukan'];
        $pemasukanTotal = $this->getSummary($userId, 'semua')['pemasukan'];
        $pengeluaranBulan = $this->getSummary($userId, 'bulan')['pengeluaran'];
        $pengeluaranTotal = $this->getSummary($userId, 'semua')['pengeluaran'];

        // Gabung semua transaksi
        $pemasukan = UangSaku::where('id_user', $userId)
            ->select('jumlah', 'keterangan', 'created_at as tanggal')
            ->get()
            ->map(fn($item) => [
                'tipe' => 'Pemasukan',
                'jumlah' => $item->jumlah,
                'keterangan' => $item->keterangan ?? '-',
                'tanggal' => $item->tanggal,
            ]);

        $pengeluaran = Pengeluaran::where('id_user', $userId)
            ->select('jumlah', 'deskripsi as keterangan', 'tanggal_pengeluaran as tanggal')
            ->get()
            ->map(fn($item) => [
                'tipe' => 'Pengeluaran',
                'jumlah' => $item->jumlah,
                'keterangan' => $item->keterangan ?? '-',
                'tanggal' => $item->tanggal,
            ]);

        $transaksiGabungan = $pemasukan->concat($pengeluaran);

        // Filter transaksi
        if ($filter) {
            $transaksiGabungan = $transaksiGabungan->where('tipe', ucfirst($filter));
        }

        // Urut & paginate manual
        $transaksiGabungan = $transaksiGabungan->sortByDesc('tanggal')->values();
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $transaksiGabungan->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $transaksi = new LengthAwarePaginator(
            $currentItems,
            $transaksiGabungan->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Hitung jumlah pengeluaran per kategori
        $pengeluaranPerKategori = Pengeluaran::selectRaw('kategori_pengeluaran.nama_kategori, COUNT(*) as total_transaksi')
            ->join('kategori_pengeluaran', 'pengeluaran.id_kategori', '=', 'kategori_pengeluaran.id_kategori')
            ->where('pengeluaran.id_user', $userId)
            ->groupBy('kategori_pengeluaran.nama_kategori')
            ->orderByDesc('total_transaksi')
            ->get();


        return view('dashboard', [
            'sisaSaldo' => $sisaSaldo,
            'pemasukanBulan' => $pemasukanBulan,
            'pemasukanTotal' => $pemasukanTotal,
            'pengeluaranBulan' => $pengeluaranBulan,
            'pengeluaranTotal' => $pengeluaranTotal,
            'transaksi' => $transaksi,
            'filter' => $filter,
            'filterMode' => $mode,
            'totalPemasukan' => $summary['pemasukan'],
            'totalPengeluaran' => $summary['pengeluaran'],
            'pengeluaranPerKategori' => $pengeluaranPerKategori,
        ]);
    }
}
