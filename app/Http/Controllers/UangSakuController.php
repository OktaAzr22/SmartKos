<?php

namespace App\Http\Controllers;

use App\Models\SaldoUser;
use App\Models\UangSaku;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUangSakuRequest;

class UangSakuController extends Controller
{
    public function index()
    {
        $data = UangSaku::query()
            ->where('user_id', Auth::id())
            ->latest('tanggal')
            ->paginate(10);

        return view('keuangan.pemasukan.index', compact('data'));
    }

    public function store(StoreUangSakuRequest $request)
    {
        DB::transaction(function () use ($request) {

            $pemasukan = UangSaku::create([
                'user_id'    => Auth::id(),
                'jumlah'     => $request->jumlah,
                'keterangan' => $request->keterangan,
                'tanggal'    => now(),
            ]);

            $saldo = SaldoUser::firstOrCreate(
                ['user_id' => Auth::id()],
                ['saldo' => 0]
            );

            $saldo->increment('saldo', $pemasukan->jumlah);
        });

        return back()->with(
            'success',
            'Pemasukan berhasil ditambahkan'
        );
    }
}