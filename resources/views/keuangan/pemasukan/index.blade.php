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
    <div class="mt-6 bg-white dark:bg-zinc-900 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700 flex justify-between items-center">
            
            <h3 class="text-lg font-semibold text-gray-800 dark:text-zinc-100">
                Tabel Pemasukkan
            </h3>

            <div class="flex space-x-2">
                <button type="button" disabled
                    class="flex items-center space-x-1 text-sm font-medium py-1 px-3 rounded-lg border
                           text-gray-400 dark:text-zinc-500 border-gray-300 dark:border-zinc-700 bg-gray-100 dark:bg-zinc-800
                           cursor-not-allowed">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>

                <button onclick="showModalById('modalPemasukan')" 
                    class="flex items-center space-x-1 text-sm font-medium py-1 px-3 rounded-lg border
                           border-gray-300 dark:border-zinc-600
                           text-gray-700 dark:text-zinc-300 hover:text-indigo-600 dark:hover:text-indigo-400
                           transition-colors">
                    <i class="fas fa-download"></i>
                    <span>Tambah Saldo</span>
                </button>
            </div>
        </div>

        <div class="overflow-y-auto overflow-x-auto max-h-[60vh] no-scrollbar">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                
                <thead class="bg-gray-50 dark:bg-zinc-800 sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            No
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Keterangan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase tracking-wider">
                            Tanggal
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-800">
                    @foreach ($data as $index => $item)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition duration-150">
                            
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-800 dark:text-zinc-200">
                                    {{ $index + 1 }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-green-600 dark:text-green-400">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 dark:text-zinc-400">

                                    @if(!empty(trim($item->keterangan)))

                                        <span 
                                            class="cursor-pointer hover:underline"
                                            data-popover="{{ $item->keterangan }}"
                                        >
                                            {{ \Illuminate\Support\Str::limit($item->keterangan, 50) }}
                                        </span>

                                    @else
                                        <span class="italic text-gray-400 dark:text-zinc-500">
                                            Tidak ada keterangan.
                                        </span>

                                    @endif

                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600 dark:text-zinc-400">
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
                <label for="jumlah" class="block text-gray-700 dark:text-zinc-300 text-sm font-medium mb-2">
                    Jumlah (Rp)
                </label>
                <input
                    type="text"
                    name="jumlah"
                    id="jumlah"
                    min="1"
                    required
                    value="{{ old('jumlah') }}"
                    placeholder="Masukkan jumlah uang saku"
                    class="format-rupiah w-full px-3 py-2 rounded-lg border
                           bg-white dark:bg-zinc-800
                           border-gray-300 dark:border-zinc-600
                           text-gray-800 dark:text-zinc-200
                           placeholder-gray-400 dark:placeholder-zinc-500
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400
                           @error('jumlah') border-red-500 dark:border-red-500 @enderror">
                @error('jumlah')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="keterangan" class="block text-gray-700 dark:text-zinc-300 text-sm font-medium mb-2">
                    Keterangan
                </label>
                <textarea
                    name="keterangan"
                    id="keterangan"
                    rows="4"
                    placeholder="Masukkan keterangan"
                    class="w-full px-3 py-2 rounded-lg border
                           bg-white dark:bg-zinc-800
                           border-gray-300 dark:border-zinc-600
                           text-gray-800 dark:text-zinc-200
                           placeholder-gray-400 dark:placeholder-zinc-500
                           focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:focus:ring-indigo-400
                           @error('keterangan') border-red-500 dark:border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">
                <button
                    type="button"
                    onclick="hideModalById('modalPemasukan')"
                    class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-zinc-400 hover:text-gray-800 dark:hover:text-zinc-200">
                    Batal
                </button>

                <x-btn-save form="formPemasukan" />
            </div>
        </form>
    </x-animated-modal>


@endsection