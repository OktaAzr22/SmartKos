@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">

    {{-- Notifikasi sukses/error --}}
    @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-semibold text-gray-800 dark:text-white">Daftar Kategori Pengeluaran</h1>
        <a href="{{ route('kategori.create') }}" 
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
           + Tambah Kategori
        </a>
    </div>

    <table class="w-full border border-gray-300 dark:border-gray-700 rounded-lg overflow-hidden">
        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
            <tr>
                <th class="px-4 py-2 text-left">#</th>
                <th class="px-4 py-2 text-left">Nama Kategori</th>
                <th class="px-4 py-2 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategori as $kat)
                <tr class="text-amber-100 border-t border-gray-200 dark:border-gray-700">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2 text-amber-100">{{ $kat->nama_kategori }}</td>
                    <td class="px-4 py-2 text-center flex gap-2 justify-center">
                        <a href="{{ route('kategori.edit', $kat->id_kategori) }}" 
                           class="px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Edit</a>
                        <form action="{{ route('kategori.destroy', $kat->id_kategori) }}" method="POST" 
                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                        Belum ada kategori.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
