@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 bg-green-200 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-4 text-red-800 bg-red-200 rounded-lg">
            {{ session('error') }}
        </div>
    @endif


    {{-- Judul --}}
    <div class="flex items-center justify-between mb-5">
        <h1 class="text-2xl font-semibold text-gray-700">Rekap Bulanan</h1>

        {{-- Tombol Rekap --}}
        <form action="{{ route('rekap.user.proses') }}" method="POST">
            @csrf

            @php
                $today = now();
                $endOfMonth = now()->endOfMonth()->day;

                // Cek rekap bulan ini
                $sudahRekapBulanIni = $rekap->where('bulan', $today->format('F'))
                                            ->where('tahun', $today->year)
                                            ->count() > 0;

                // Cek rekap bulan lalu
                $bulanLalu = now()->subMonth()->format('F');
                $tahunLalu = now()->subMonth()->year;

                $sudahRekapBulanLalu = $rekap->where('bulan', $bulanLalu)
                                             ->where('tahun', $tahunLalu)
                                             ->count() > 0;
            @endphp


            {{-- Kondisi tombol --}}
            @if($today->day === $endOfMonth)
                
                {{-- Jika bulan ini belum rekap → tampilkan tombol rekap bulan ini --}}
                @unless($sudahRekapBulanIni)
                    <button class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Rekap Bulan Ini
                    </button>
                @else
                    {{-- Jika bulan ini sudah tapi bulan lalu belum --}}
                    @unless($sudahRekapBulanLalu)
                        <button class="px-4 py-2 text-white bg-yellow-600 rounded-lg hover:bg-yellow-700">
                            Rekap Bulan Lalu
                        </button>
                    @else
                        <button disabled class="px-4 py-2 bg-gray-400 cursor-not-allowed text-white rounded-lg">
                            Rekap Selesai
                        </button>
                    @endunless
                @endunless

            @else
                <button disabled class="px-4 py-2 bg-gray-400 cursor-not-allowed text-white rounded-lg">
                    Rekap hanya di akhir bulan
                </button>
            @endif

        </form>
    </div>


    {{-- Tabel Rekap --}}
    <div class="bg-white shadow rounded-lg p-5">
        <table class="w-full table-auto">
            <thead>
                <tr class="border-b">
                    <th class="px-3 py-2 text-left">Bulan</th>
                    <th class="px-3 py-2 text-left">Tahun</th>
                    <th class="px-3 py-2 text-left">Pemasukan</th>
                    <th class="px-3 py-2 text-left">Pengeluaran</th>
                    <th class="px-3 py-2 text-left">Saldo Akhir</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rekap as $item)
                    <tr class="border-b">
                        <td class="px-3 py-2">{{ $item->bulan }}</td>
                        <td class="px-3 py-2">{{ $item->tahun }}</td>
                        <td class="px-3 py-2">Rp {{ number_format($item->total_pemasukan, 0, ',', '.') }}</td>
                        <td class="px-3 py-2">Rp {{ number_format($item->total_pengeluaran, 0, ',', '.') }}</td>
                        <td class="px-3 py-2 font-semibold">
                            Rp {{ number_format($item->saldo_akhir, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-3 py-2 text-center text-gray-500">
                            Belum ada data rekap
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
