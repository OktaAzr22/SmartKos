@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
  @if (session('error'))
    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
        {{ session('error') }}
    </div>
@endif
    <h1 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">Catat Pengeluaran</h1>

    <form action="{{ route('pengeluaran.store') }}" method="POST">

        @csrf

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="id_kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori Pengeluaran</label>
            <select name="id_kategori" id="id_kategori"
        class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-white">
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

        {{-- Jumlah --}}
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah (Rp)</label>
            <input type="number" name="jumlah" id="jumlah" step="0.01"
       value="{{ old('jumlah') }}"
       class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-white"
       placeholder="Masukkan jumlah pengeluaran">
            @error('jumlah')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div class="mb-4">
            <label for="tanggal_pengeluaran" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Pengeluaran</label>
           <input type="date" name="tanggal_pengeluaran" id="tanggal_pengeluaran"
       value="{{ old('tanggal_pengeluaran', date('Y-m-d')) }}"
       class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-white">
            @error('tanggal_pengeluaran')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="3"
          class="w-full px-3 py-2 border rounded-lg focus:ring focus:ring-blue-300 dark:bg-gray-700 dark:text-white"
          placeholder="Keterangan tambahan (opsional)">{{ old('deskripsi') }}</textarea>
        </div>

        

        {{-- Tombol --}}
        <div class="flex justify-end">
            <a href="{{ route('pengeluaran.index') }}" 
               class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition mr-2">Batal</a>
            <button type="submit" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan</button>
        </div>
    </form>
</div>
@endsection
