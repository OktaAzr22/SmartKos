<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekapBulanan;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;

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
        $bulan = Carbon::now()->month;
        $tahun = Carbon::now()->year;

        if (RekapBulanan::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->where('user_id', Auth::id())
            ->exists()) {
            return back()->with('warning', 'Rekap bulan ini sudah dilakukan!');
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

        

        if ($rekapSebelumnya) {
            
            $saldo_awal = $rekapSebelumnya->saldo_akhir;
            $saldo_akhir = $saldo_awal + $total_pemasukan - $total_pengeluaran;

        } else {
            
            $saldo_awal = $saldoUser->saldo;  
            $saldo_akhir = $total_pemasukan - $total_pengeluaran; 
            
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

        
        $saldoUser->saldo = $saldo_akhir;
        $saldoUser->save();

        return back()->with('success', 'Rekap bulanan selesai!');
    }

    public function cetakPDF($id)
    {
        $rekap = RekapBulanan::where('user_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        $pemasukan = UangSaku::where('user_id', Auth::id())
            ->whereMonth('tanggal', $rekap->bulan)
            ->whereYear('tanggal', $rekap->tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $pengeluaran = Pengeluaran::with('kategori')
            ->where('user_id', Auth::id())
            ->whereMonth('tanggal', $rekap->bulan)
            ->whereYear('tanggal', $rekap->tahun)
            ->orderBy('tanggal', 'asc')
            ->get();

        $bulanNama = Carbon::create()->month($rekap->bulan)->translatedFormat('F');

        $pdf = Pdf::loadView('rekap.pdf', [
            'rekap'        => $rekap,
            'pemasukan'    => $pemasukan,
            'pengeluaran'  => $pengeluaran,
            'bulanNama'    => $bulanNama
        ]);

        return $pdf->stream("Rekap-{$bulanNama}-{$rekap->tahun}.pdf");
    }

    /**
     * Halaman Detail (Hanya tampilkan data)
     */
    public function detail($id)
    {
        $rekap = RekapBulanan::where('user_id', Auth::id())->findOrFail($id);

        $bulan = $rekap->bulan;
        $tahun = $rekap->tahun;

        $pemasukan = UangSaku::where('user_id', Auth::id())
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $pengeluaran = Pengeluaran::where('user_id', Auth::id())
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get();

        $bulanNama = Carbon::create()->month($bulan)->translatedFormat('F');

        return view('rekap.detail', compact(
            'rekap',
            'bulanNama',
            'pemasukan',
            'pengeluaran',
            'bulan',
            'tahun'
        ));
    }
}