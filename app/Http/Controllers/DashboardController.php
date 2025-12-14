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

         $totalPemasukan = RekapBulanan::where('user_id', $userId)
            ->sum('total_pemasukan');

        $totalPengeluaran = RekapBulanan::where('user_id', $userId)
            ->sum('total_pengeluaran');

        $tipe = $request->query('tipe'); // pengeluaran | pemasukan | null

    // ===== QUERY PEMASUKAN =====
    $pemasukan = UangSaku::select(
            'tanggal',
            'jumlah',
            'keterangan',
            DB::raw("'Pemasukan' as tipe")
        )
        ->where('user_id', $userId);

    // ===== QUERY PENGELUARAN =====
    $pengeluaran = Pengeluaran::select(
            'tanggal',
            'jumlah',
            'keterangan',
            DB::raw("'Pengeluaran' as tipe")
        )
        ->where('user_id', $userId);

    // ===== FILTER TIPE =====
    if ($tipe === 'pemasukan') {
        $transaksiAll = $pemasukan
            ->orderBy('tanggal', 'desc')
            ->get();
    } elseif ($tipe === 'pengeluaran') {
        $transaksiAll = $pengeluaran
            ->orderBy('tanggal', 'desc')
            ->get();
    } else {
        $transaksiAll = $pemasukan
            ->unionAll($pengeluaran)
            ->orderBy('tanggal', 'desc')
            ->get();
    }

    // ===== PAGINATION 10 DATA =====
    $page = request()->get('page', 1);
    $perPage = 5;

    $transaksi = new LengthAwarePaginator(
        $transaksiAll->forPage($page, $perPage),
        $transaksiAll->count(),
        $perPage,
        $page,
        [
            'path' => request()->url(),
            'query' => request()->query(),
        ]
    );
        
        


        return view('dashboard.index', compact(
            'saldoSaatIni',
            'pemasukanBulanIni',
            'totalPemasukan',
            'pengeluaranBulanIni',
            'totalPengeluaran',
            'transaksi',
            'tipe'
            
        ));
    }
}
