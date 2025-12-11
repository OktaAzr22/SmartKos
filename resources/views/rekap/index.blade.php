@extends('layouts.app')

@section('content')


                

                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">

                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">Laporan Keuangan Bulanan</h3>
                        <div class="flex space-x-2">
                            <form action="{{ route('rekap.proses') }}" method="POST">
                                @csrf
                                <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                                    <i class="fas fa-plus"></i>
                                    <span>Rekap Bulanan</span>
                                </button>
                            </form>
                            <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                                <i class="fas fa-print"></i>
                                <span>Cetak Laporan</span>
                            </button>
                        </div>
                    </div>

                    @if($rekap->count() == 0)
                        <p class="text-gray-600">Belum ada data rekap bulanan.</p>
                    @else

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bulan Tahun
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pemasukan (Rp)
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pengeluaran (Rp)
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Saldo Awal (Rp)
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Saldo Akhir (Rp)
                                        </th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($rekap as $r)
                                        
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                                    <i class="fas fa-calendar-alt text-blue-600 text-sm"></i>
                                                </div>
                                                <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::create()->month($r->bulan)->translatedFormat('F') }} {{ $r->tahun }}</div>
                                            </div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-green-600">Rp {{ number_format($r->total_pemasukan, 0, ',', '.') }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-red-600">Rp {{ number_format($r->total_pengeluaran, 0, ',', '.') }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">Rp {{ number_format($r->saldo_awal, 0, ',', '.') }}</div>
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">Rp {{ number_format($r->saldo_akhir, 0, ',', '.') }}</div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>

@endsection
