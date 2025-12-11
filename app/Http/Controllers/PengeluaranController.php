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
        $data = Pengeluaran::where('user_id', Auth::id())
        ->with('kategori')
        ->latest()->get();

        $kategori = KategoriPengeluaran::all();

        return view('pengeluaran.index', compact('data', 'kategori'));
    }

    public function create()
{
    $kategori = KategoriPengeluaran::all();
    return view('pengeluaran.create', compact('kategori'));
}


    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
            'id_kategori'  => 'required|exists:kategori_pengeluaran,id_kategori',
        ]);

        // Ambil saldo user
        $saldo = SaldoUser::firstOrCreate(['user_id' => Auth::id()]);

        if ($saldo->saldo < $request->jumlah) {
            return back()->with('error', 'Saldo tidak mencukupi untuk melakukan pengeluaran!');
        }

        $pengeluaran = Pengeluaran::create([
            'user_id' => Auth::id(),
            'id_kategori' => $request->id_kategori,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        // Update saldo
        $saldo = SaldoUser::firstOrCreate(['user_id' => Auth::id()]);
        $saldo->saldo -= $pengeluaran->jumlah;
        $saldo->save();

        return back()->with('success', 'Pengeluaran berhasil ditambahkan');
    }
}