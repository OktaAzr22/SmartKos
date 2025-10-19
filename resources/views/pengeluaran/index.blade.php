@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="mb-4 p-3 text-green-700 bg-green-100 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Daftar Pengeluaran</h1>
        <a href="{{ route('pengeluaran.create') }}" 
           class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
           + Tambah Pengeluaran
        </a>
    </div>

    {{-- Tabel --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b">No</th>
                    <th class="px-6 py-3 border-b">Kategori</th>
                    <th class="px-6 py-3 border-b">Tanggal</th>
                    <th class="px-6 py-3 border-b">Jumlah</th>
                    <th class="px-6 py-3 border-b">Deskripsi</th>
                    <th class="px-6 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengeluaran as $index => $item)
                    <tr class="border-b hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-6 py-3">{{ $index + 1 }}</td>
                        <td class="px-6 py-3">{{ $item->kategori->nama_kategori ?? '-' }}</td>
                        <td class="px-6 py-3">{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d M Y') }}</td>
                        <td class="px-6 py-3">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td class="px-6 py-3">{{ $item->deskripsi }}</td>
                        <td class="px-6 py-3 text-center">
                            <form action="{{ route('pengeluaran.destroy', $item->id_pengeluaran) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            Belum ada data pengeluaran.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
