
@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Dashboard</h1>
<p>Selamat datang, {{ Auth::user()->name ?? 'Pengguna' }} 👋</p>
<div class="max-w-5xl mx-auto mt-8 p-6 bg-white rounded-lg shadow-md">

    <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

    <!-- TOTAL SALDO -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-blue-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Total Saldo Saat Ini</h3>
            <p class="text-3xl font-bold mt-2">
                Rp {{ number_format($saldo->saldo_sekarang ?? 0, 0, ',', '.') }}
            </p>
            <p class="text-sm mt-1 opacity-80">
                Bulan: {{ $saldo->bulan ?? '-' }} {{ $saldo->tahun ?? '-' }}
            </p>
        </div>

        <div class="bg-green-600 text-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold">Saldo Awal Bulan Ini</h3>
            <p class="text-3xl font-bold mt-2">
                Rp {{ number_format($saldo->saldo_awal ?? 0, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <!-- RIWAYAT SETOR -->
    <div class="bg-gray-50 p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Riwayat Setor Terbaru</h3>

        @if($riwayat->isEmpty())
            <p class="text-gray-500">Belum ada data setoran.</p>
        @else
            <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="py-2 px-4 text-left">Tanggal Setor</th>
                        <th class="py-2 px-4 text-left">Jumlah</th>
                        <th class="py-2 px-4 text-left">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayat as $item)
                        <tr class="border-t">
                            <td class="py-2 px-4">{{ \Carbon\Carbon::parse($item->tanggal_setor)->format('d M Y') }}</td>
                            <td class="py-2 px-4 text-green-600 font-semibold">
                                + Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="py-2 px-4">{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
