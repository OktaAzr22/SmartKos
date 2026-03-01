@extends('layouts.app')

@section('content')
    <x-breadcrumb />

    @if ($errors->any())
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            showModalById('modalPemasukan');
        });
        </script>
    @endif

    @if ($data->count())
    <div class="mt-6 bg-background dark:bg-dark-900 
                rounded-xl border border-dark-200 dark:border-dark-700 
                shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-dark-200 dark:border-dark-700 
                    flex justify-between items-center">
            
            <h3 class="text-lg font-semibold text-text">
                Tabel Pemasukkan
            </h3>

            <div class="flex space-x-2">
                <button type="button" disabled
                    class="flex items-center space-x-1 text-sm font-medium py-1 px-3 rounded-lg border
                           text-dark-400 border-dark-300 bg-dark-100
                           dark:text-dark-500 dark:border-dark-700 dark:bg-dark-800
                           cursor-not-allowed">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>

                <button onclick="showModalById('modalPemasukan')" 
                    class="flex items-center space-x-1 text-sm font-medium py-1 px-3 rounded-lg border
                           border-dark-300 dark:border-dark-700
                           text-dark-600 hover:text-primary
                           dark:text-dark-300 dark:hover:text-primary
                           transition-colors">
                    <i class="fas fa-download"></i>
                    <span>Tambah Saldo</span>
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-dark-200 dark:divide-dark-700">
                
                <thead class="bg-dark-50 dark:bg-dark-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-background dark:bg-dark-900 divide-y divide-dark-200 dark:divide-dark-700">
                    @foreach ($data as $index => $item)
                        <tr class="hover:bg-dark-50 dark:hover:bg-dark-800 transition duration-150">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-text">
                                    {{ $index + 1 }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-success">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-dark-600 dark:text-dark-300">
                                    {{ $item->keterangan ?? '-' }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-dark-600 dark:text-dark-300">
                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
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
        <x-empty-state title="Data Belum ada" description="Belum ada transaksi">
            <button onclick="showModalById('modalPemasukan')">
                <x-empty-state-action>
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Transaksi
                </x-empty-state-action>
            </button>
        </x-empty-state>

    @endif
    <x-animated-modal id="modalPemasukan" title="Tambah Pemasukkan" size="max-w-md">
        <form action="{{ route('uang_saku.store') }}" method="POST" id="formPemasukan">
            @csrf
            <div class="mb-4">
                <label for="jumlah" class="block text-gray-700 text-sm font-medium mb-2">
                    Jumlah (Rp)
                </label>
                <input
                    type="number"
                    name="jumlah"
                    id="jumlah"
                    min="1"
                    required
                    value="{{ old('jumlah') }}"
                    placeholder="Masukkan jumlah uang saku"
                    class="w-full px-3 py-2 rounded-lg border
           bg-background dark:bg-dark-800
           border-dark-300 dark:border-dark-700
           text-text
           focus:outline-none focus:ring-2 focus:ring-primary
           @error('jumlah') border-danger @enderror">
                @error('jumlah')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block text-gray-700 text-sm font-medium mb-2">
                    Keterangan
                </label>
                <textarea
    name="keterangan"
    id="keterangan"
    rows="4"
    placeholder="Masukkan keterangan"
    class="w-full px-3 py-2 rounded-lg border
           bg-background dark:bg-dark-800
           border-dark-300 dark:border-dark-700
           text-text
           focus:outline-none focus:ring-2 focus:ring-primary
           @error('keterangan') border-danger @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button
                    type="button"
                    onclick="hideModalById('modalPemasukan')"

                    class="px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-800">
                    Batal
                </button>

                <x-btn-save form="formPemasukan" />
            </div>
        </form>
    </x-animated-modal>
@endsection