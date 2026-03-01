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

    <div class="mt-6 bg-background dark:bg-dark-900
                rounded-xl border border-dark-200 dark:border-dark-700
                shadow-sm overflow-hidden">

        {{-- HEADER --}}
        <div class="px-6 py-4 border-b border-dark-200 dark:border-dark-700
                    flex justify-between items-center">
            <h3 class="text-lg font-semibold text-text">
                Daftar Kategori Pengeluaran
            </h3>

            <div class="flex space-x-2">
                <button onclick="showModalById('modalKategori')"
                    class="flex items-center space-x-1
                           text-dark-500 hover:text-text
                           text-sm font-medium py-1 px-3
                           rounded-lg border border-dark-300 dark:border-dark-700
                           hover:bg-dark-50 dark:hover:bg-dark-800
                           transition">
                    <i class="fas fa-plus"></i>
                    <span>Tambah</span>
                </button>
            </div>
        </div>

        {{-- TABLE --}}
        @if($kategori->count() > 0)

            <div class="max-h-96 overflow-y-auto">

                <table class="min-w-full divide-y divide-dark-200 dark:divide-dark-700">

                    <thead class="bg-dark-50 dark:bg-dark-800 sticky top-0 z-10">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase w-16">
                                No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase">
                                Nama Kategori
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-dark-500 uppercase w-32">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-background dark:bg-dark-900
                                  divide-y divide-dark-200 dark:divide-dark-700">

                        @foreach ($kategori as $i => $item)
                            <tr class="hover:bg-dark-50 dark:hover:bg-dark-800 transition">

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-text">
                                        {{ ($kategori->currentPage() - 1) * $kategori->perPage() + ($i + 1) }}
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-text">
                                        {{ $item->nama_kategori }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center space-x-3">

                                        {{-- EDIT --}}
                                        <button
                                            onclick="showModalById('modalEditKategori-{{ $item->id_kategori }}')"
                                            class="text-primary hover:opacity-80 transition">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        {{-- DELETE --}}
                                        <button type="button"
                                            class="delete-btn text-danger hover:opacity-80 transition"
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
                                            class="block text-dark-600 text-sm font-medium mb-2">
                                            Nama Kategori
                                        </label>

                                        <input
                                            type="text"
                                            name="nama_kategori"
                                            value="{{ old('nama_kategori', $item->nama_kategori) }}"
                                            required
                                            class="w-full px-3 py-2 rounded-lg
                                                   bg-background dark:bg-dark-800
                                                   border border-dark-300 dark:border-dark-700
                                                   text-text
                                                   focus:outline-none
                                                   focus:ring-2 focus:ring-primary">

                                        @if ($errors->any() && session('modal') === 'modalEditKategori-' . $item->id_kategori)
                                            @error('nama_kategori')
                                                <p class="text-sm text-danger mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        @endif
                                    </div>

                                    <div class="flex justify-end space-x-3 mt-6">

                                        <button type="button"
                                            onclick="hideModalById('modalEditKategori-{{ $item->id_kategori }}')"
                                            class="px-4 py-2 font-medium
                                                   text-dark-500 hover:text-text transition">
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

                <div class="w-16 h-16 bg-dark-100 dark:bg-dark-800
                            rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-folder-open text-dark-400 text-xl"></i>
                </div>

                <h3 class="text-lg font-medium text-text mb-2">
                    Tidak ada kategori
                </h3>

                <p class="text-sm text-dark-500 mb-6">
                    Belum ada kategori pengeluaran yang dibuat
                </p>

                <button onclick="showModalById('modalKategori')"
                    class="px-4 py-2 text-sm font-medium
                           text-white bg-primary
                           rounded-lg hover:opacity-90
                           focus:outline-none focus:ring-2 focus:ring-primary
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
                <label class="block text-dark-600 text-sm font-medium mb-2">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    name="nama_kategori"
                    required
                    value="{{ old('nama_kategori') }}"
                    placeholder="Masukkan nama kategori"
                    class="w-full px-3 py-2 rounded-lg
                           bg-background dark:bg-dark-800
                           border border-dark-300 dark:border-dark-700
                           text-text
                           focus:outline-none
                           focus:ring-2 focus:ring-primary">

                @error('nama_kategori')
                    <p class="text-sm text-danger mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3 mt-6">

                <button type="button"
                        onclick="hideModalById('modalKategori')"
                        class="px-4 py-2 text-sm font-medium
                               text-dark-500 hover:text-text transition">
                    Batal
                </button>

                <x-btn-save form="formKategori"/>

            </div>

        </form>

    </x-animated-modal>

@endsection