<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UangSakuController extends Controller
{
    public function index()
    {
        
        $uangSaku = UangSaku::where('id_user', Auth::id())
            ->latest()
            ->paginate(5);

        return view('keuangan.pemasukan.index', compact('uangSaku'));
    }

    public function create()
    {
        return view('keuangan.pemasukan.create');
    }

    public function store(Request $request)
    {
        try {
            
            $request->validate([
                'jumlah' => [
                    'required',
                    'numeric',
                    'min:2',
                    'max:9999999999999', 
                ],
                'keterangan' => 'nullable|string|max:255',
            ], [
                'jumlah.required' => 'Jumlah nominal wajib diisi.',
                'jumlah.numeric' => 'Masukkan hanya angka untuk jumlah nominal.',
                'jumlah.min' => 'Nominal minimal adalah 1.',
                'jumlah.max' => 'Masukkan jumlah nominal yang valid (tidak boleh terlalu besar).',
            ]);


            $userId = Auth::id();

            
            $uangSaku = UangSaku::create([
                'id_user' => $userId,
                'jumlah' => $request->jumlah,
                'keterangan' => $request->keterangan,
            ]);

            
            $bulan = date('F');
            $tahun = date('Y');

            
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

            
            return redirect()
                ->back()
                ->with('success', 'Setoran uang saku berhasil disimpan!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('modal', 'modalPemasukan');
        } catch (\Throwable $th) {
            // ✅ Tangani error lain (misal DB overflow atau lainnya)
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data. Pastikan jumlah nominal valid.')
                ->withInput()
                ->with('modal', 'modalPemasukan');
        }
    }
}
