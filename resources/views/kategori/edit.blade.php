@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto p-6">
    <h2 class="text-2xl font-semibold mb-4">Edit Kategori Pengeluaran</h2>

    <form action="{{ route('kategori.update', $kategori->id_kategori) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Nama Kategori</label>
            <input type="text" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200" required>
            @error('nama_kategori')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <a href="{{ route('kategori.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg mr-2">Batal</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Update</button>
        </div>
    </form>
</div>
@endsection
