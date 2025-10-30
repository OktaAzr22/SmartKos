@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    @include('components.modal-delete')

    @if ($errors->any() && session('modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showModal('{{ session('modal') }}');
            });
        </script>
    @endif
    
    <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Kategori Pengeluaran</h3>
            <div class="flex space-x-2">
                <button onclick="showModal('modalKategori')" class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                    <i class="fas fa-plus"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>
    
        @if($kategori->count() > 0)
        <!-- Container dengan tinggi maksimum dan scroll otomatis -->
        <div class="max-h-96 overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($kategori as $i => $item)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ ($kategori->currentPage() - 1) * $kategori->perPage() + ($i + 1) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_kategori }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center space-x-3">
                                    <button 
                                        onclick="showModal('modalEditKategori-{{ $item->id_kategori }}')" 
                                        class="text-blue-500 hover:text-blue-700">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <button type="button"
                                        class="delete-btn text-gray-500 hover:text-gray-700" 
                                        data-action="{{ route('keuangan.kategori.destroy', $item->id_kategori) }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <x-animated-modal id="modalEditKategori-{{ $item->id_kategori }}" title="Edit Kategori" size="max-w-md">
                            <form action="{{ route('keuangan.kategori.update', $item->id_kategori) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="nama_kategori_{{ $item->id_kategori }}" class="block text-gray-700 text-sm font-medium mb-2">
                                        Nama Kategori
                                    </label>
                                    <input 
                                        type="text"
                                        name="nama_kategori"
                                        id="nama_kategori_{{ $item->id_kategori }}"
                                        value="{{ old('nama_kategori', $item->nama_kategori) }}"
                                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                                        required>

                                    @if ($errors->any() && session('modal') === 'modalEditKategori-' . $item->id_kategori)
                                        @error('nama_kategori')
                                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                                        @enderror
                                    @endif
                                </div>

                                <div class="flex justify-end space-x-3 mt-6">
                                    <button type="button" onclick="hideModal('modalEditKategori-{{ $item->id_kategori }}')" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium">
                                        Batal
                                    </button>
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-all transform hover:scale-105">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </x-animated-modal>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $kategori->links() }}
        @else
        <!-- Tampilan ketika tidak ada data -->
        <div class="py-16 flex flex-col items-center justify-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-folder-open text-gray-400 text-xl"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada kategori</h3>
            <p class="text-sm text-gray-500 mb-6">Belum ada kategori pengeluaran yang dibuat</p>
            <button onclick="showModal('modalKategori')" class="px-4 py-2 text-sm font-medium text-white bg-primary-500 border border-transparent rounded-lg hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                <i class="fas fa-plus mr-2"></i>
                Tambah Kategori
            </button>
        </div>
        @endif
    </div>

    <x-animated-modal id="modalKategori" title="Tambah Kategori" size="max-w-md">
        <form action="{{ route('keuangan.kategori.store') }}" method="POST" id="formKategori">
            @csrf
                <div class="mb-4">
                    <label for="nama_kategori" class="block text-gray-700 text-sm font-medium mb-2">
                        Nama Kategori
                    </label>
                    <input
                        type="text"
                        name="nama_kategori"
                        id="nama_kategori"
                        required
                        value="{{ old('nama_kategori') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan nama kategori">
                    @error('nama_kategori')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button"
                            onclick="hideModal('modalKategori')"
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