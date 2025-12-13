@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto bg-white p-6 rounded-xl shadow">

    <h2 class="text-2xl font-bold mb-4">
        Rekap Bulan {{ $bulanNama }} {{ $rekap->tahun }}
    </h2>

    {{-- ================== TABEL PEMASUKAN ================== --}}
    <h3 class="text-xl font-semibold mt-6 mb-2">Pemasukan</h3>

    <table class="w-full border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemasukan as $p)
                <tr>
                    <td class="border p-2">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td class="border p-2">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                    <td class="border p-2">{{ $p->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td class="border p-2 text-center" colspan="3">Tidak ada pemasukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{-- ================== TABEL PENGELUARAN ================== --}}
    <h3 class="text-xl font-semibold mt-6 mb-2">Pengeluaran</h3>

    <table class="w-full border border-gray-300 text-sm">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Jumlah</th>
                <th class="border p-2">Kategori</th>
                <th class="border p-2">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaran as $p)
                <tr>
                    <td class="border p-2">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td class="border p-2">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                    <td class="border p-2">{{ $p->kategori->nama_kategori ?? '-' }}</td>
                    <td class="border p-2">{{ $p->keterangan }}</td>
                </tr>
            @empty
                <tr>
                    <td class="border p-2 text-center" colspan="4">Tidak ada pengeluaran</td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{-- ================== TABEL RINGKASAN ================== --}}
    <h3 class="text-xl font-semibold mt-6 mb-2">Ringkasan Bulanan</h3>

    <table class="w-1/2 border border-gray-300 text-sm">
        <tr>
            <th class="border p-2 bg-gray-100">Saldo Awal</th>
            <td class="border p-2">Rp {{ number_format($rekap->saldo_awal, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="border p-2 bg-gray-100">Total Pemasukan</th>
            <td class="border p-2">Rp {{ number_format($rekap->total_pemasukan, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="border p-2 bg-gray-100">Total Pengeluaran</th>
            <td class="border p-2">Rp {{ number_format($rekap->total_pengeluaran, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th class="border p-2 bg-gray-100">Saldo Akhir</th>
            <td class="border p-2">Rp {{ number_format($rekap->saldo_akhir, 0, ',', '.') }}</td>
        </tr>
    </table>

    {{-- Tombol Cetak --}}
    <div class="mt-6">
        <a href="{{ route('rekap.cetak', $rekap->id) }}" target="_blank"
   class="px-4 py-2 bg-blue-600 text-white rounded">
   Cetak PDF
</a>
    </div>

</div>

@endsection
