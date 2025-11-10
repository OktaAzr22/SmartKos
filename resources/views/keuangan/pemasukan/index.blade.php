@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    @if ($errors->any() && session('modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showModal('{{ session('modal') }}');
            });
        </script>
    @endif

    @if (session('modal') === 'modalPemasukan' || $errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                openModal('modalPemasukan');
            });
        </script>
    @endif

    <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Tabel Pemasukkan</h3>
            <div class="flex space-x-2">
                <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
                <button onclick="showModal('modalPemasukan')" class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
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
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($uangSaku as $i => $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $uangSaku->firstItem() + $i }}
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
                                    {{ $item->created_at->format('d M Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                <div class="flex justify-center space-x-2">
                                    <button class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">
                                Belum ada data uang saku
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $uangSaku->links() }}
    </div>

    <x-animated-modal id="modalPemasukan" title="Tambah Pemasukkan" size="max-w-md">
        <form action="{{ route('uang-saku.store') }}" method="POST" id="formPemasukan">
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
                        class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('jumlah') border-red-500 @enderror"
                        placeholder="Masukkan jumlah uang saku">
                    @error('jumlah')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="keterangan" class="block text-gray-700 text-sm font-medium mb-2">
                        Keterangan
                    </label>
                    <input
                        type="text"
                        name="keterangan"
                        id="keterangan"
                        value="{{ old('keterangan') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan keterangan">
                    @error('keterangan')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button"
                            onclick="hideModal('modalPemasukan')"
                            class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all transform hover:scale-105">
                        Simpan
                    </button>
                </div>
        </form>
    </x-animated-modal>
@endsection
