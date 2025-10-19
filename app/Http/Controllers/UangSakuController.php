<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UangSakuController extends Controller
{
    public function create()
    {
        return view('uang_saku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $userId = Auth::id();

        // 1️⃣ Simpan ke tabel uang_saku
        $uangSaku = UangSaku::create([
            'id_user' => $userId,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
        ]);

        // 2️⃣ Update saldo_user
        $bulan = date('F');
        $tahun = date('Y');

        // Cari saldo aktif user di bulan & tahun tersebut
        $saldo = SaldoUser::where('id_user', $userId)
            ->where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->first();

        if ($saldo) {
            // Update saldo yang sudah ada
            $saldo->saldo_sekarang += $request->jumlah;
            $saldo->save();
        } else {
            // Jika belum ada saldo bulan ini, buat baru
            SaldoUser::create([
                'id_user' => $userId,
                'saldo_awal' => $request->jumlah,
                'saldo_sekarang' => $request->jumlah,
                'bulan' => $bulan,
                'tahun' => $tahun,
            ]);
        }

        return redirect()->back()->with('success', 'Setoran uang saku berhasil disimpan!');
    }
}
