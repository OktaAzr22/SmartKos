@extends('layouts.app')

@section('content')

    {{-- Jika terjadi error dan ada session modal, tampilkan modal kembali --}}
    @if ($errors->any() && session('modal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                showModal('{{ session('modal') }}');
            });
        </script>
    @endif

    <button
        onclick="showModal('modalPemasukan')"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-center transition-all transform hover:scale-105">
        <i class="fas fa-plus mr-2"></i> Tambah Saldo
    </button>

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
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
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