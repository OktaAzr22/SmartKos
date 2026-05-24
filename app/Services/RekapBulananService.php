<?php

namespace App\Services;

use App\Models\Pengeluaran;
use App\Models\RekapBulanan;
use App\Models\RekapKategoriPengeluaran;
use App\Models\SaldoUser;
use App\Models\UangSaku;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RekapBulananService
{
    public function generateMonthlyRecap(int $userId): void
    {
        DB::transaction(function () use ($userId) {

            $bulan = now()->month;
            $tahun = now()->year;

            $exists = RekapBulanan::query()
                ->where('user_id', $userId)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->exists();

            if ($exists) {
                throw new \Exception(
                    'Rekap bulan ini sudah ada.'
                );
            }

            $saldoUser = SaldoUser::firstOrCreate(
                ['user_id' => $userId],
                ['saldo' => 0]
            );

            $rekapSebelumnya = RekapBulanan::query()
                ->where('user_id', $userId)
                ->latest('tahun')
                ->latest('bulan')
                ->first();

            $totalPemasukan = UangSaku::query()
                ->where('user_id', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->sum('jumlah');

            $totalPengeluaran = Pengeluaran::query()
                ->where('user_id', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->sum('jumlah');

            $jumlahPemasukan = UangSaku::query()
                ->where('user_id', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->count();

            $jumlahPengeluaran = Pengeluaran::query()
                ->where('user_id', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->count();

            $saldoAwal = $rekapSebelumnya
                ? $rekapSebelumnya->saldo_akhir
                : $saldoUser->saldo;

            $saldoAkhir = $saldoAwal
                + $totalPemasukan
                - $totalPengeluaran;

            $rekap = RekapBulanan::create([
                'user_id'           => $userId,
                'bulan'             => $bulan,
                'tahun'             => $tahun,
                'total_pemasukan'   => $totalPemasukan,
                'total_pengeluaran' => $totalPengeluaran,
                'total_transaksi'   => $jumlahPemasukan + $jumlahPengeluaran,
                'saldo_awal'        => $saldoAwal,
                'saldo_akhir'       => $saldoAkhir,
            ]);

            $topKategori = Pengeluaran::query()
                ->select(
                    'id_kategori',
                    DB::raw('COUNT(*) as jumlah_transaksi'),
                    DB::raw('SUM(jumlah) as total_nominal')
                )
                ->where('user_id', $userId)
                ->whereMonth('tanggal', $bulan)
                ->whereYear('tanggal', $tahun)
                ->groupBy('id_kategori')
                ->orderByDesc('jumlah_transaksi')
                ->limit(3)
                ->get();

            foreach ($topKategori as $kategori) {

                RekapKategoriPengeluaran::create([
                    'rekap_bulanan_id' => $rekap->id,
                    'id_kategori'      => $kategori->id_kategori,
                    'jumlah_transaksi' => $kategori->jumlah_transaksi,
                    'total_nominal'    => $kategori->total_nominal,
                ]);

            }

            $saldoUser->update([
                'saldo' => $saldoAkhir
            ]);
        });
    }

    public function calculatePercentage($rekap)
    {
        foreach ($rekap as $item) {

            $prev = RekapBulanan::query()
                ->where('user_id', $item->user_id)
                ->where(function ($q) use ($item) {

                    $q->where('tahun', '<', $item->tahun)
                        ->orWhere(function ($q2) use ($item) {

                            $q2->where('tahun', $item->tahun)
                                ->where('bulan', '<', $item->bulan);

                        });

                })
                ->latest('tahun')
                ->latest('bulan')
                ->first();

            if (!$prev) {

                $item->pemasukan_percent = null;
                $item->pengeluaran_percent = null;

                continue;
            }

            $item->pemasukan_percent =
                $prev->total_pemasukan == 0
                ? 0
                : round(
                    (
                        ($item->total_pemasukan - $prev->total_pemasukan)
                        / $prev->total_pemasukan
                    ) * 100
                );

            $item->pengeluaran_percent =
                $prev->total_pengeluaran == 0
                ? 0
                : round(
                    (
                        ($item->total_pengeluaran - $prev->total_pengeluaran)
                        / $prev->total_pengeluaran
                    ) * 100
                );
        }

        return $rekap;
    }

    public function getDetail(int $id, int $userId): array
    {
        $rekap = RekapBulanan::query()
            ->where('user_id', $userId)
            ->findOrFail($id);

        $pemasukan = UangSaku::query()
            ->where('user_id', $userId)
            ->whereMonth('tanggal', $rekap->bulan)
            ->whereYear('tanggal', $rekap->tahun)
            ->get();

        $pengeluaran = Pengeluaran::query()
            ->where('user_id', $userId)
            ->whereMonth('tanggal', $rekap->bulan)
            ->whereYear('tanggal', $rekap->tahun)
            ->get();

        return [
            'rekap'       => $rekap,
            'bulanNama'   => Carbon::create()
                ->month($rekap->bulan)
                ->translatedFormat('F'),
            'pemasukan'   => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'bulan'       => $rekap->bulan,
            'tahun'       => $rekap->tahun,
        ];
    }

    public function generatePdf(int $id, int $userId)
    {
        return DB::transaction(function () use ($id, $userId) {

            $rekap = RekapBulanan::query()
                ->where('user_id', $userId)
                ->findOrFail($id);

            $bulanNama = Carbon::create()
                ->month($rekap->bulan)
                ->translatedFormat('F');

            $fileName = "Rekap-{$bulanNama}-{$rekap->tahun}.pdf";

            $directory = "rekap/user_{$userId}/{$rekap->tahun}";

            Storage::makeDirectory($directory);

            $path = "{$directory}/{$fileName}";

            $pdf = Pdf::loadView(
                'keuangan.rekap.pdf',
                $this->getDetail($id, $userId)
            )->setPaper('A4', 'portrait');

            Storage::put(
                $path,
                $pdf->output()
            );

            $rekap->update([
                'pdf_path'   => $path,
                'is_printed' => true,
            ]);

            return response()->file(
                storage_path("app/private/{$path}")
            );
        });
    }

    public function viewPdf(int $id, int $userId)
    {
        $rekap = RekapBulanan::query()
            ->where('user_id', $userId)
            ->findOrFail($id);

        abort_unless(
            $rekap->pdf_path,
            404
        );

        $fullPath = storage_path(
            "app/private/{$rekap->pdf_path}"
        );

        abort_unless(
            file_exists($fullPath),
            404
        );

        return response()->file($fullPath);
    }
}