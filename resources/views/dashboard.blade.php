@extends('layouts.app')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
    {{-- Sisa Saldo Saat Ini --}}
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Sisa Saldo Saat Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($sisaSaldo, 0, ',', '.') }}</p>
            </div>
            <div class="p-2 bg-blue-50 rounded-lg">
                <i class="fas fa-folder text-blue-500"></i>
            </div>
        </div>
        <div class="flex items-center mt-3">
            <span class="text-xs text-green-500 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 12%
            </span>
            <span class="text-xs text-gray-500 ml-2">from last month</span>
        </div>
    </div>
    {{--Total Pemasukan Bulan Ini  --}}
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pemasukan Bulan Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($pemasukanBulan, 0, ',', '.') }}</p>
            </div>
            <div class="p-2 bg-green-50 rounded-lg">
                <i class="fas fa-check-circle text-green-500"></i>
            </div>
        </div>
        <div class="flex items-center mt-3">
            <span class="text-xs text-green-500 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 5%
            </span>
            <span class="text-xs text-gray-500 ml-2">from last month</span>
        </div>
    </div>
    {{--Total Pemasukan Selama Ini  --}}
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Pemasukan Selama Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($pemasukanTotal, 0, ',', '.') }}</p>
            </div>
            <div class="p-2 bg-yellow-50 rounded-lg">
                <i class="fas fa-clock text-yellow-500"></i>
            </div>
        </div>
        <div class="flex items-center mt-3">
            <span class="text-xs text-red-500 font-medium flex items-center">
                <i class="fas fa-arrow-down mr-1"></i> 2%
            </span>
            <span class="text-xs text-gray-500 ml-2">from last month</span>
        </div>
    </div>
    {{-- Total Pengeluaran Bulan Ini --}}
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pengeluaran Bulan Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($pengeluaranBulan, 0, ',', '.') }}</p>
            </div>
            <div class="p-2 bg-purple-50 rounded-lg">
                <i class="fas fa-dollar-sign text-purple-500"></i>
            </div>
        </div>
        <div class="flex items-center mt-3">
            <span class="text-xs text-green-500 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 8%
            </span>
            <span class="text-xs text-gray-500 ml-2">from last month</span>
        </div>
    </div>
</div>
<div>
    {{-- Total Pengeluaran Selama Ini --}}
    <h2 class="text-sm text-gray-500 font-medium mb-1">Total Pengeluaran Selama Ini</h2>
    <p class="text-3xl font-semibold text-orange-600">
        Rp {{ number_format($pengeluaranTotal, 0, ',', '.') }}
    </p>
</div> 
@endsection