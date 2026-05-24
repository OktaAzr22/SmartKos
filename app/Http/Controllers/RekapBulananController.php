<?php

namespace App\Http\Controllers;

use App\Models\RekapBulanan;
use App\Services\RekapBulananService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapBulananController extends Controller
{
    public function __construct(
        protected RekapBulananService $rekapService
    ) {}

    public function index(Request $request)
    {
        $userId = Auth::id();

        $tahunDipilih = $request->tahun;

        $listTahun = RekapBulanan::query()
            ->where('user_id', $userId)
            ->select('tahun')
            ->distinct()
            ->latest('tahun')
            ->pluck('tahun');

        $rekap = RekapBulanan::query()
            ->where('user_id', $userId)
            ->when($tahunDipilih, function ($query) use ($tahunDipilih) {

                $query->where('tahun', $tahunDipilih);

            })
            ->latest('tahun')
            ->latest('bulan')
            ->paginate(12)
            ->withQueryString();

        $rekap = $this->rekapService
            ->calculatePercentage($rekap);

        return view('keuangan.rekap.index', compact(
            'rekap',
            'listTahun',
            'tahunDipilih'
        ));
    }

    public function prosesRekap()
    {
        $this->rekapService->generateMonthlyRecap(
            Auth::id()
        );

        return back()->with(
            'success',
            'Rekap bulanan berhasil dibuat!'
        );
    }

    public function detail($id)
    {
        $data = $this->rekapService->getDetail(
            $id,
            Auth::id()
        );

        return view('keuangan.rekap.detail', $data);
    }

    public function cetakPDF($id)
    {
        return $this->rekapService->generatePdf(
            $id,
            Auth::id()
        );
    }

    public function viewPdf($id)
    {
        return $this->rekapService->viewPdf(
            $id,
            Auth::id()
        );
    }
}