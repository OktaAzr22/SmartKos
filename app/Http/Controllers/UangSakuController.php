<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UangSakuController extends Controller
{
    public function index()
    {
        $data = UangSaku::where('user_id', Auth::id())
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        return view('keuangan.pemasukan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'jumlah' => str_replace('.', '', $request->jumlah)
        ]);
        
        $request->validate([
            'jumlah' => 'required|numeric|min:2',
            'keterangan' => 'nullable|string',
        ]);

        $tanggalSekarang = Carbon::now();

        $pemasukan = UangSaku::create([
            'user_id' => Auth::id(),
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal'    => $tanggalSekarang,
        ]);

        $saldo = SaldoUser::firstOrCreate(['user_id' => Auth::id()]);
        $saldo->saldo += $pemasukan->jumlah;
        $saldo->save();

        return back()->with('success', 'Pemasukan berhasil ditambahkan');
    }
}