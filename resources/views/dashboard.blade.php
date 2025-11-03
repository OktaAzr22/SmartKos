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
    {{-- Total Pengeluaran Selama Ini --}}
    <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pengeluaran Selama Ini</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($pengeluaranTotal, 0, ',', '.') }}</p>
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


    <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Riwayat Transaksi</h3>
            <div class="flex space-x-2">
                <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                    <i class="fas fa-plus"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Tanggal</span>
                                @if (request('filter'))
                                    <a href="{{ route('dashboard') }}" title="Hapus Filter" class="ml-2 text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <div class="flex items-center">
                                <span>Tipe</span>
                                @php
                                    $filter = request('filter');
                                    $nextFilter = $filter === 'pemasukan' ? 'pengeluaran' : 'pemasukan';
                                @endphp
                                <a href="{{ route('dashboard', ['filter' => $nextFilter]) }}"
                                class="ml-2 text-gray-400 hover:text-gray-600"
                                title="Filter berdasarkan tipe">
                                    @if ($filter === 'pemasukan')
                                        <i class="fas fa-sort text-xs text-green-500"></i>
                                    @elseif ($filter === 'pengeluaran')
                                        <i class="fas fa-sort text-xs text-red-500"></i>
                                    @else
                                        <i class="fas fa-filter text-xs"></i>
                                    @endif
                                </a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($transaksi as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ \Carbon\Carbon::parse($item['tanggal'])->format('d M Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded-full {{ $item['tipe'] === 'Pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $item['tipe'] }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-500">{{ $item['keterangan'] }}</div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <div class="text-sm font-medium {{ $item['tipe'] === 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                    Rp{{ number_format($item['jumlah'], 0, ',', '.') }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 text-gray-500">Belum ada transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
                {{ $transaksi->links() }}
        </div>
    </div>
@endsection