@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Tambah Kategori Pengeluaran</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_kategori" class="block text-sm font-medium">Nama Kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="w-full border rounded p-2" placeholder="Contoh: Makan, Transportasi, Tagihan" required>
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
