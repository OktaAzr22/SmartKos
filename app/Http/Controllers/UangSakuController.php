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
        $data = UangSaku::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(5);

        return view('uang_saku.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric|min:1',
            'tanggal' => 'required|date',
        ]);

        $pemasukan = UangSaku::create([
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        // Update saldo
        $saldo = SaldoUser::firstOrCreate(['user_id' => Auth::id()]);
        $saldo->saldo += $pemasukan->jumlah;
        $saldo->save();

        return back()->with('success', 'Pemasukan berhasil ditambahkan');
    }
}