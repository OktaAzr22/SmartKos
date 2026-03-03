@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    @include('components.modal-delete')

@if($data->count() > 0)
    <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">
                Tabel Transaksi Pengeluaran
            </h3>

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
        
        <div class="max-h-96 overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Kategori
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah Rp
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Deskripsi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($data as $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-700">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $item->tanggal->translatedFormat('d F Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-green-600">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600">
                                    @if(!empty(trim($item->keterangan)))
                                        {{ $item->keterangan }}
                                    @else
                                        <span class="italic text-gray-400">Tidak ada deskripsi</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $data->links() }}
    </div>
@else
    <x-empty-state title="Tidak ada data" description="Belum ada transaksi">
        <a href="{{ route('pengeluaran.create') }}">
            <x-empty-state-action>
                <i class="fas fa-plus mr-2"></i>
                Tambah Transaksi
            </x-empty-state-action>
        </a>
    </x-empty-state>
@endif

@endsection