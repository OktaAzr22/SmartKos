@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                Rekap Bulanan
            </h1>
            <p class="text-gray-500 text-sm">Laporan Pemasukan, Pengeluaran, dan Saldo</p>
        </div>

        <a href="{{ route('rekap.proses') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
           Proses Rekap Bulanan
        </a>
    </div>

    {{-- TABLE --}}
    <div class="overflow-x-auto rounded-lg shadow">
        <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                <tr>
                    <th class="px-4 py-3">User</th>
                    <th class="px-4 py-3">Bulan</th>
                    <th class="px-4 py-3">Tahun</th>
                    <th class="px-4 py-3">Pemasukan</th>
                    <th class="px-4 py-3">Pengeluaran</th>
                    <th class="px-4 py-3">Saldo Akhir</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($rekap as $item)
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <td class="px-4 py-3">{{ $item->user->first_name ?? 'User' }}</td>
                        <td class="px-4 py-3">{{ $item->bulan }}</td>
                        <td class="px-4 py-3">{{ $item->tahun }}</td>
                        <td class="px-4 py-3 text-green-600">Rp {{ number_format($item->total_pemasukan, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-red-600">Rp {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 font-semibold">Rp {{ number_format($item->saldo_akhir, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="#"
                               class="text-blue-600 hover:underline">
                               Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>



@endsection
