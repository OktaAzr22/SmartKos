@extends('layouts.app')

@section('content')
<x-breadcrumb />
@include('components.modal-delete')

<div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">Tabel Transaksi Pengeluaran</h3>
        <div class="flex space-x-2">
            <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>
            <a href="{{ route('pengeluaran.create') }}">
                <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                    <i class="fas fa-plus"></i>
                    <span>Buat Pengeluaran</span>
                </button>
            </a>
        </div>
    </div> 
    
    @if($pengeluaran->count() > 0)
    <!-- Container dengan tinggi tetap dan scroll otomatis -->
    <div class="max-h-96 overflow-y-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50 sticky top-0 z-10">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Rp</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($pengeluaran as $index => $item)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="status-income px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d M Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-green-600">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-500">{{ $item->deskripsi }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-2">
                            <button class="text-primary-500 hover:text-primary-700">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button"
                                class="delete-btn text-gray-500 hover:text-gray-700"
                                data-action="{{ route('pengeluaran.destroy', $item->id_pengeluaran) }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $pengeluaran->links() }}
    @else
    <div class="py-16 flex flex-col items-center justify-center">
        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
            <i class="fas fa-inbox text-gray-400 text-xl"></i>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada data</h3>
        <p class="text-sm text-gray-500 mb-6">Belum ada transaksi yang tercatat</p>
        <a href="{{ route('pengeluaran.create') }}">
            <button class="px-4 py-2 text-sm font-medium text-white bg-primary-500 border border-transparent rounded-lg hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fas fa-plus mr-2"></i>
                Tambah Transaksi
            </button>
        </a>
    </div>
    @endif
</div>
    
@endsection