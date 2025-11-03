<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\SaldoUser;
use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PengeluaranController extends Controller
{
    public function index()
    {
        $pengeluaran = Pengeluaran::with('kategori')
            ->where('id_user', Auth::id())
            ->latest()
            ->paginate(10);

        return view('keuangan.pengeluaran.index', compact('pengeluaran'));
    }

    public function create()
    {
        $kategori = KategoriPengeluaran::all();
        return view('keuangan.pengeluaran.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori_pengeluaran,id_kategori',
            'jumlah' => 'required|numeric|min:0',
            'tanggal_pengeluaran' => 'nullable|date',
            'deskripsi' => 'nullable|string|max:255',
            
        ]);

        try {
            DB::transaction(function () use ($request) {
                $userId = Auth::id();

                $saldo = SaldoUser::firstOrCreate(
                    [
                        'id_user' => $userId,
                        'bulan' => date('F'),
                        'tahun' => date('Y'),
                    ],
                    [
                        'saldo_awal' => 0,
                        'saldo_sekarang' => 0,
                    ]
                );

                if ($saldo->saldo_sekarang < $request->jumlah) {
                    throw new \Exception('Saldo tidak mencukupi untuk pengeluaran ini.');
                }

                Pengeluaran::create([
                    'id_user' => $userId,
                    'id_kategori' => $request->id_kategori,
                    'jumlah' => $request->jumlah,
                    'tanggal_pengeluaran' => $request->tanggal_pengeluaran ?? date('Y-m-d'),
                    'deskripsi' => $request->deskripsi,
                    
                ]);

                $saldo->saldo_sekarang -= $request->jumlah;
                $saldo->save();
            });

            return redirect()
                ->route('pengeluaran.index')
                ->with('success', 'Pengeluaran berhasil dicatat dan saldo diperbarui!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::findOrFail($id);

        $saldo = SaldoUser::where('id_user', $pengeluaran->id_user)
            ->where('bulan', date('F', strtotime($pengeluaran->tanggal_pengeluaran)))
            ->where('tahun', date('Y', strtotime($pengeluaran->tanggal_pengeluaran)))
            ->first();

        if ($saldo) {
            $saldo->saldo_sekarang += $pengeluaran->jumlah;
            $saldo->save();
        }

        $pengeluaran->delete();

        return redirect()
            ->route('pengeluaran.index')
            ->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}