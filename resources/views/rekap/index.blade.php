@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-700">Rekap Bulanan</h1>
        <form action="{{ route('rekap.generate') }}" method="POST">
            @csrf
            <button type="submit" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                Buat Rekap Bulan Ini
            </button>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Bulan</th>
                    <th class="px-4 py-2 text-left">Tahun</th>
                    <th class="px-4 py-2 text-right">Pemasukan</th>
                    <th class="px-4 py-2 text-right">Pengeluaran</th>
                    <th class="px-4 py-2 text-right">Saldo Akhir</th>
                    <th class="px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rekap as $item)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $item->bulan }}</td>
                        <td class="px-4 py-2">{{ $item->tahun }}</td>
                        <td class="px-4 py-2 text-right">Rp {{ number_format($item->total_pemasukan, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-right">Rp {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 text-right font-semibold text-green-700">
                            Rp {{ number_format($item->saldo_akhir, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-2 text-center">
                            <a href="#" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">Belum ada data rekap bulanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
