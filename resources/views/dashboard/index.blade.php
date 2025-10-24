@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">📊 Dashboard Keuangan</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sisa Saldo Saat Ini -->
        <div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-green-500">
            <h2 class="text-sm text-gray-500">Sisa Saldo Saat Ini</h2>
            <p class="text-2xl font-bold text-green-600 mt-1">Rp {{ number_format($saldoSekarang, 0, ',', '.') }}</p>
        </div>

        <!-- Total Saldo Semua Waktu -->
        <div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-blue-500">
            <h2 class="text-sm text-gray-500">Total Saldo Sepanjang Waktu</h2>
            <p class="text-2xl font-bold text-blue-600 mt-1">Rp {{ number_format($totalSaldoSemua, 0, ',', '.') }}</p>
        </div>

        <!-- Total Pengeluaran -->
        <div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-red-500">
            <h2 class="text-sm text-gray-500">Total Pengeluaran</h2>
            <p class="text-2xl font-bold text-red-600 mt-1">Rp {{ number_format($totalPengeluaranSemua, 0, ',', '.') }}</p>
        </div>

        <!-- Total Pemasukan -->
        <div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-emerald-500">
            <h2 class="text-sm text-gray-500">Total Pemasukan</h2>
            <p class="text-2xl font-bold text-emerald-600 mt-1">Rp {{ number_format($totalPemasukanSemua, 0, ',', '.') }}</p>
        </div>

        <!-- Pemasukan Bulan Ini -->
        <div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-teal-500">
            <h2 class="text-sm text-gray-500">Pemasukan Bulan Ini</h2>
            <p class="text-2xl font-bold text-teal-600 mt-1">Rp {{ number_format($totalPemasukanBulan, 0, ',', '.') }}</p>
        </div>

        <!-- Pengeluaran Bulan Ini -->
        <div class="bg-white shadow-md rounded-2xl p-5 border-l-4 border-rose-500">
            <h2 class="text-sm text-gray-500">Pengeluaran Bulan Ini</h2>
            <p class="text-2xl font-bold text-rose-600 mt-1">Rp {{ number_format($totalPengeluaranBulan, 0, ',', '.') }}</p>
        </div>
    </div>
</div>
@endsection
