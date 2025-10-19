@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-semibold mb-4">Setor Uang Saku</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('uang-saku.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="jumlah" class="block text-sm font-medium">Jumlah (Rp)</label>
            <input type="number" name="jumlah" id="jumlah" step="0.01" class="w-full border rounded p-2" required>
        </div>

        

        <div class="mb-4">
            <label for="keterangan" class="block text-sm font-medium">Keterangan</label>
            <input type="text" name="keterangan" id="keterangan" class="w-full border rounded p-2" placeholder="Contoh: uang bulanan Oktober">
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
            Simpan
        </button>
    </form>
</div>
@endsection
