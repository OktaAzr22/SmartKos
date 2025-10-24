@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold text-gray-700 mb-6">Dashboard Keuangan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Sisa Saldo --}}
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100">
            <h2 class="text-sm text-gray-500 font-medium mb-1">Sisa Saldo Saat Ini</h2>
            <p class="text-3xl font-semibold text-green-600">
                Rp {{ number_format($sisaSaldo, 0, ',', '.') }}
            </p>
        </div>

        {{-- Total Pemasukan Bulan Ini --}}
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100">
            <h2 class="text-sm text-gray-500 font-medium mb-1">Total Pemasukan Bulan Ini</h2>
            <p class="text-3xl font-semibold text-blue-600">
                Rp {{ number_format($pemasukanBulan, 0, ',', '.') }}
            </p>
        </div>

        {{-- Total Pemasukan Selama Ini --}}
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100">
            <h2 class="text-sm text-gray-500 font-medium mb-1">Total Pemasukan Selama Ini</h2>
            <p class="text-3xl font-semibold text-indigo-600">
                Rp {{ number_format($pemasukanTotal, 0, ',', '.') }}
            </p>
        </div>

        {{-- Total Pengeluaran Bulan Ini --}}
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100">
            <h2 class="text-sm text-gray-500 font-medium mb-1">Total Pengeluaran Bulan Ini</h2>
            <p class="text-3xl font-semibold text-red-600">
                Rp {{ number_format($pengeluaranBulan, 0, ',', '.') }}
            </p>
        </div>

        {{-- Total Pengeluaran Selama Ini --}}
        <div class="bg-white shadow rounded-xl p-6 border border-gray-100">
            <h2 class="text-sm text-gray-500 font-medium mb-1">Total Pengeluaran Selama Ini</h2>
            <p class="text-3xl font-semibold text-orange-600">
                Rp {{ number_format($pengeluaranTotal, 0, ',', '.') }}
            </p>
        </div>

    </div>

    <div class="mt-10">
        <a href="{{ route('rekap.index') }}" 
           class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            Lihat Rekap Bulanan →
        </a>
    </div>
</div>
@endsection
