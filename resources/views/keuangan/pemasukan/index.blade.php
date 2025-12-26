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
        <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-900">Tabel Pemasukkan</h3>
                <div class="flex space-x-2">
                    <button type="button" disabled
                        class="flex items-center space-x-1 text-sm font-medium py-1 px-3 rounded-lg border
                            text-gray-400 border-gray-300 bg-gray-100
                            cursor-not-allowed hover:text-gray-400">
                        <i class="fas fa-filter"></i>
                        <span>Filter</span>
                    </button>

                    <button onclick="showModalById('modalPemasukan')" class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                        <i class="fas fa-download"></i>
                        <span>Tambah Saldo</span>
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($data as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $index + 1 }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
                                        {{ $item->keterangan ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-700">
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
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500
                        @error('jumlah') border-red-500 @enderror">
                @error('jumlah')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="tanggal" class="block text-gray-700 text-sm font-medium mb-2">
                    Tanggal
                </label>
                <input
                    type="date"
                    name="tanggal"
                    id="tanggal"
                    required
                    value="{{ old('tanggal') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500
                        @error('tanggal') border-red-500 @enderror">
                @error('tanggal')
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
                    class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500
                        @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
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