@extends('layouts.app')

@section('content')

<x-breadcrumb />
<div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
        <h3 class="text-lg font-semibold text-gray-900">Catat Pengeluaran</h3>
        <a href="{{ route('pengeluaran.index') }}" 
           class="text-gray-400 hover:text-gray-600 transition">
            <i class="fas fa-times text-lg"></i>
        </a>
    </div>

    <div class="p-6">
        <form action="{{ route('pengeluaran.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div>
                        <label for="id_kategori" class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori Pengeluaran
                        </label>
                        <select name="id_kategori" id="id_kategori"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg 
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $kat)
                                <option value="{{ $kat->id_kategori }}" 
                                    {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700 mb-2">
                            Jumlah Pengeluaran
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">Rp</span>
                            </div>
                            <input type="number" name="jumlah" id="jumlah" step="0.01"
                                value="{{ old('jumlah') }}"
                                class="w-full pl-12 pr-3 py-2 border border-gray-300 rounded-lg 
                                       focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Masukkan jumlah pengeluaran">
                        </div>
                        @error('jumlah')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_pengeluaran" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Pengeluaran
                        </label>
                        <input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran"
                            value="{{ old('tanggal_pengeluaran', date('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('tanggal_pengeluaran')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="10"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg 
                               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                        placeholder="Keterangan tambahan (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <a href="{{ route('pengeluaran.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 
                           rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 
                           focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium text-white bg-blue-600 
                           rounded-lg hover:bg-blue-700 focus:outline-none 
                           focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
