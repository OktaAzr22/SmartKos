@extends('layouts.app')

@section('content')
    <x-breadcrumb />
    @include('components.modal-delete')

    @if ($errors->any())
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            showModalById('modalKategori');
        });
        </script>
    @endif

    <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">
                Daftar Kategori Pengeluaran
            </h3>

            <div class="flex space-x-2">
                <button onclick="showModalById('modalKategori')"
                    class="flex items-center space-x-1
                           text-gray-600 hover:text-gray-900
                           text-sm font-medium py-1 px-3
                           rounded-lg border border-gray-300
                           hover:bg-gray-50
                           transition">
                    <i class="fas fa-plus"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>

        {{-- TABLE --}}
        @if($kategori->count() > 0)

            <div class="max-h-96 overflow-y-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-16">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Nama Kategori
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase w-32">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($kategori as $i => $item)
                            <tr class="hover:bg-gray-50 transition">

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ ($kategori->currentPage() - 1) * $kategori->perPage() + ($i + 1) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $item->nama_kategori }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-3">

                                        {{-- EDIT --}}
                                        <button
                                            onclick="showModalById('modalEditKategori-{{ $item->id_kategori }}')"
                                            class="text-indigo-600 hover:opacity-80 transition">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <button type="button"
                                            class="delete-btn text-red-600 hover:opacity-80 transition"
                                            data-action="{{ route('keuangan.kategori.destroy', $item->id_kategori) }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                    </div>
                                </td>

                            </tr>

                            {{-- MODAL EDIT --}}
                            <x-animated-modal
                                id="modalEditKategori-{{ $item->id_kategori }}"
                                title="Edit Kategori"
                                size="max-w-md">

                                <form action="{{ route('keuangan.kategori.update', $item->id_kategori) }}"
                                      method="POST"
                                      id="formEditKategori-{{ $item->id_kategori }}">

                                    @csrf
                                    @method('PUT')

                                    <div class="mb-4">
                                        <label
                                            class="block text-gray-700 text-sm font-medium mb-2">
                                            Nama Kategori
                                        </label>

                                        <input
                                            type="text"
                                            name="nama_kategori"
                                            value="{{ old('nama_kategori', $item->nama_kategori) }}"
                                            required
                                            class="w-full px-3 py-2 rounded-lg
                                                   bg-white
                                                   border border-gray-300
                                                   text-gray-900
                                                   focus:outline-none
                                                   focus:ring-2 focus:ring-indigo-500">

                                        @if ($errors->any() && session('modal') === 'modalEditKategori-' . $item->id_kategori)
                                            @error('nama_kategori')
                                                <p class="text-sm text-red-600 mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        @endif
                                    </div>

                                    <div class="flex justify-end space-x-3 mt-6">

                                        <button type="button"
                                            onclick="hideModalById('modalEditKategori-{{ $item->id_kategori }}')"
                                            class="px-4 py-2 font-medium
                                                   text-gray-600 hover:text-gray-900 transition">
                                            Batal
                                        </button>

                                        <x-btn-save form="formEditKategori-{{ $item->id_kategori }}"/>

                                    </div>

                                </form>
                            </x-animated-modal>

                        @endforeach

                    </tbody>
                </table>

            </div>

            {{ $kategori->links() }}

        @else

            {{-- EMPTY STATE --}}
            <div class="py-16 flex flex-col items-center justify-center">

                <div class="w-16 h-16 bg-gray-100
                            rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-folder-open text-gray-400 text-xl"></i>
                </div>

                <h3 class="text-lg font-medium text-gray-900 mb-2">
                    Tidak ada kategori
                </h3>

                <p class="text-sm text-gray-500 mb-6">
                    Belum ada kategori pengeluaran yang dibuat
                </p>

                <button onclick="showModalById('modalKategori')"
                    class="px-4 py-2 text-sm font-medium
                           text-white bg-indigo-600
                           rounded-lg hover:opacity-90
                           focus:outline-none focus:ring-2 focus:ring-indigo-500
                           transition">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori
                </button>

            </div>

        @endif

    </div>

    {{-- MODAL TAMBAH --}}
    <x-animated-modal id="modalKategori" title="Tambah Kategori" size="max-w-md">

        <form action="{{ route('keuangan.kategori.store') }}"
              method="POST"
              id="formKategori">

            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    required
                    value="{{ old('nama_kategori') }}"
                    placeholder="Masukkan nama kategori"
                    class="w-full px-3 py-2 rounded-lg
                           bg-white
                           border border-gray-300
                           text-gray-900
                           focus:outline-none
                           focus:ring-2 focus:ring-indigo-500">

                @error('nama_kategori')
                    <p class="text-sm text-red-600 mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">

                <button type="button"
                        onclick="hideModalById('modalKategori')"
                        class="px-4 py-2 text-sm font-medium
                               text-gray-600 hover:text-gray-900 transition">
                    Batal
                </button>

                <x-btn-save form="formKategori"/>

            </div>

        </form>

    </x-animated-modal>

@endsection