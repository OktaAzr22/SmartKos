@extends('layouts.app')

@section('content')
    
    <x-breadcrumb />
  <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Rekap Keuangan</h3>
                        <div class="flex space-x-2">
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                                <i class="fas fa-filter"></i>
                                <span>Filter</span>
                            </button>
                            @if(!$sudahRekap && $isAkhirBulan)
                            <form action="{{ route('rekap.generate') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                                    Buat Rekap Bulan Ini
                                </button>
                            </form>
                            @elseif($sudahRekap)
                                <button disabled class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300 cursor-not-allowed">
                                    Rekap Bulan Ini Sudah Dibuat
                                </button>
                            @else
                                <button disabled class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300 cursor-not-allowed">
                                    ⏳ Rekap hanya bisa di akhir bulan
                                </button>
                            @endif
                            
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemasukan Rp</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengeluaran Rp</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Akhir</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($rekap as $index => $item)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $loop->iteration }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->bulan }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->tahun }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-green-600">Rp {{ number_format($item->total_pemasukan, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-red-600">Rp {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-blue-600">Rp {{ number_format($item->saldo_akhir, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex space-x-2">
                                            <button class="text-primary-500 hover:text-primary-700" title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-gray-500">Belum ada data rekap bulanan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                   
                </div>
@endsection
