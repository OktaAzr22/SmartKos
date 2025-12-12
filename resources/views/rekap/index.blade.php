@extends('layouts.app')

@section('content')

@if($rekap->count() == 0)
    <p>Belum ada data rekap bulanan.</p>

    <form action="{{ route('rekap.proses') }}" method="POST">
        @csrf
        <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
            <i class="fas fa-plus"></i>
            <span>Rekap Bulanan</span>
        </button>
    </form>

@else

<div>

    {{-- Tombol Rekap Baru --}}
    <form action="{{ route('rekap.proses') }}" method="POST" class="mb-4">
        @csrf
        <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
            <i class="fas fa-plus"></i>
            <span>Rekap Bulanan</span>
        </button>
    </form>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th>Transaksi</th>
                <th>Pemasukan (Rp)</th>
                <th>Pengeluaran (Rp)</th>
                <th>Saldo Awal (Rp)</th>
                <th>Saldo Akhir (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rekap as $r)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::create()->month($r->bulan)->translatedFormat('F') }} 
                        {{ $r->tahun }}
                    </td>

                    <td>Rp {{ number_format($r->total_pemasukan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($r->total_pengeluaran, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($r->saldo_awal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($r->saldo_akhir, 0, ',', '.') }}</td>

                    <td class="border p-2 space-x-2">

                        <a href="{{ route('rekap.detail', $r->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white rounded">
                           Detail
                        </a>

                        <a href="{{ route('rekap.cetak', $r->id) }}"
                           target="_blank"
                           class="px-3 py-1 bg-green-600 text-white rounded">
                           Cetak
                        </a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endif

@endsection
