@extends('layouts.app')

@section('content')
<x-breadcrumb />
@include('components.modal-delete')

<div class="mt-6 bg-white dark:bg-gray-800 rounded-xl border 
            border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">

    {{-- Header --}}
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 
                flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
            Tabel Transaksi Pengeluaran
        </h3>

        <div class="flex space-x-2">

            {{-- Filter --}}
            <button class="flex items-center space-x-1 text-gray-500 dark:text-gray-300 
                           hover:text-gray-700 dark:hover:text-gray-100
                           text-sm font-medium py-1 px-3 rounded-lg 
                           border border-gray-300 dark:border-gray-600">
                <i class="fas fa-filter"></i>
                <span>Filter</span>
            </button>

            {{-- Create --}}
            <a href="{{ route('pengeluaran.create') }}">
                <button class="flex items-center space-x-1 text-gray-500 dark:text-gray-300 
                               hover:text-gray-700 dark:hover:text-gray-100
                               text-sm font-medium py-1 px-3 rounded-lg 
                               border border-gray-300 dark:border-gray-600">
                    <i class="fas fa-plus"></i>
                    <span>Buat Pengeluaran</span>
                </button>
            </a>

        </div>
    </div>

    {{-- Jika ada data --}}
    @if($pengeluaran->count() > 0)

    <div class="max-h-96 overflow-y-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            
            {{-- Table Head --}}
            <thead class="bg-gray-50 dark:bg-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Kategori
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Tanggal
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Jumlah Rp
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Deskripsi
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium 
                               text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                        Aksi
                    </th>
                </tr>
            </thead>

            {{-- Table Body --}}
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($pengeluaran as $item)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150">

                    {{-- Kategori --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold 
                                     rounded-full bg-gray-100 dark:bg-gray-700
                                     text-gray-700 dark:text-gray-200">
                            {{ $item->kategori->nama_kategori ?? '-' }}
                        </span>
                    </td>

                    {{-- Tanggal --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                            {{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d M Y') }}
                        </div>
                    </td>

                    {{-- Jumlah --}}
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-green-600 dark:text-green-400">
                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                        </div>
                    </td>

                    {{-- Deskripsi --}}
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            {{ $item->deskripsi }}
                        </div>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <div class="flex space-x-3">

                            {{-- Edit --}}
                            <button class="text-blue-500 dark:text-blue-400 
                                           hover:text-blue-700 dark:hover:text-blue-300 transition">
                                <i class="fas fa-edit"></i>
                            </button>

                            {{-- Delete --}}
                            <button type="button"
                                class="delete-btn text-gray-500 dark:text-gray-300
                                       hover:text-gray-700 dark:hover:text-gray-100 transition"
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

    {{-- Empty State --}}
    <div class="py-16 flex flex-col items-center justify-center text-center">
        
        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full 
                    flex items-center justify-center mb-4">
            <i class="fas fa-inbox text-gray-400 dark:text-gray-300 text-xl"></i>
        </div>

        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
            Tidak ada data
        </h3>

        <p class="text-sm text-gray-500 dark:text-gray-300 mb-6">
            Belum ada transaksi yang tercatat
        </p>

        <a href="{{ route('pengeluaran.create') }}">
            <button class="px-4 py-2 text-sm font-medium text-white 
                           bg-blue-600 dark:bg-blue-500 
                           rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600
                           focus:outline-none focus:ring-2 
                           focus:ring-offset-2 focus:ring-blue-500">
                <i class="fas fa-plus mr-2"></i>
                Tambah Transaksi
            </button>
        </a>

    </div>

    @endif

</div>

@endsection
