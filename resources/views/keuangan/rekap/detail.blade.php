@extends('layouts.app')

@section('content')
<x-breadcrumb />
                <div class="mt-2 bg-white dark:bg-slate-900 rounded-2xl border border-gray-200 dark:border-slate-700 shadow-sm overflow-hidden">
                    <div class="px-6 py-6 border-b border-gray-100 dark:border-slate-700">
                        <div class="flex flex-col gap-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-slate-100">
                                    Rekap Bulan {{ $bulanNama }} {{ $rekap->tahun }}
                                </h3>
                                <p class="text-sm text-gray-500 dark:text-slate-400">
                                    Ringkasan keuangan bulanan
                                </p>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="p-4 rounded-xl 
                                            bg-gray-50 dark:bg-slate-800 
                                            border border-gray-200 dark:border-slate-700">
                                    <p class="text-xs text-gray-500 dark:text-slate-400">Saldo Awal</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-slate-100">
                                        Rp {{ number_format($rekap->saldo_awal, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="p-4 rounded-xl 
                                            bg-green-50 dark:bg-emerald-900/30 
                                            border border-green-100 dark:border-emerald-800">
                                    <p class="text-xs text-green-600 dark:text-emerald-400">
                                        Total Pemasukan
                                    </p>
                                    <p class="text-sm font-semibold text-green-700 dark:text-emerald-300">
                                        Rp {{ number_format($rekap->total_pemasukan, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="p-4 rounded-xl 
                                            bg-red-50 dark:bg-rose-900/30 
                                            border border-red-100 dark:border-rose-800">
                                    <p class="text-xs text-red-600 dark:text-rose-400">
                                        Total Pengeluaran
                                    </p>
                                    <p class="text-sm font-semibold text-red-700 dark:text-rose-300">
                                        Rp {{ number_format($rekap->total_pengeluaran, 0, ',', '.') }}
                                    </p>
                                </div>

                                <div class="p-4 rounded-xl 
                                            bg-blue-50 dark:bg-sky-900/30 
                                            border border-blue-100 dark:border-sky-800">
                                    <p class="text-xs text-blue-600 dark:text-sky-400">
                                        Saldo Akhir
                                    </p>
                                    <p class="text-sm font-semibold text-blue-700 dark:text-sky-300">
                                        Rp {{ number_format($rekap->saldo_akhir, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ===================== PEMASUKAN ===================== -->
                    <div class="px-6 py-4 bg-green-50/70 dark:bg-slate-900 border-b border-green-100 dark:border-slate-800">
                        <div class="flex items-center gap-4">
                            <div class="flex-1 h-px bg-green-200 dark:bg-emerald-700"></div>

                            <h4 class="text-sm font-semibold text-green-700 dark:text-emerald-300 whitespace-nowrap">
                                Data Pemasukan
                            </h4>

                            <div class="flex-1 h-px bg-green-200 dark:bg-emerald-700"></div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-slate-700">
                            <thead class="bg-gray-50 dark:bg-slate-800 
                                        text-gray-500 dark:text-slate-400 text-xs uppercase">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium">Tanggal</th>
                                    <th class="px-6 py-3 text-left font-medium">Jumlah</th>
                                    <th class="px-6 py-3 text-left font-medium">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                                @forelse($pemasukan as $p)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-slate-200">
                                            {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                        </td>

                                        <td class="px-6 py-4 text-sm font-semibold text-green-600 dark:text-emerald-300">
                                            Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-slate-400">
                                            {{ $p->keterangan }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="border p-2 text-center" colspan="3">Tidak ada pemasukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- ===================== PENGELUARAN ===================== -->
                    <div class="px-6 py-4 
                                bg-red-50/70 dark:bg-slate-900
                                border-b border-red-100 dark:border-slate-800">
                        <div class="flex items-center gap-4">
                            <div class="flex-1 h-px bg-red-200 dark:bg-rose-700"></div>

                            <h4 class="text-sm font-semibold text-red-700 dark:text-rose-300 whitespace-nowrap">
                                Data Pengeluaran
                            </h4>

                            <div class="flex-1 h-px bg-red-200 dark:bg-rose-700"></div>
                        </div>
                    </div>

                    <!-- TABLE PENGELUARAN -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 dark:divide-slate-700">
                            <thead class="bg-gray-50 dark:bg-slate-800 
                                        text-gray-500 dark:text-slate-400 text-xs uppercase">
                                <tr>
                                    <th class="px-6 py-3 text-left font-medium">Tanggal</th>
                                    <th class="px-6 py-3 text-left font-medium">Kategori</th>
                                    <th class="px-6 py-3 text-left font-medium">Jumlah</th>
                                    <th class="px-6 py-3 text-left font-medium">Deskripsi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-slate-700">
                                @forelse($pengeluaran as $p)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-slate-800 transition">
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-slate-200">
                                            {{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}
                                        </td>

                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full 
                                                        bg-orange-100 dark:bg-orange-900/30 
                                                        text-orange-700 dark:text-orange-300 
                                                        text-xs font-medium">
                                                {{ $p->kategori->nama_kategori ?? '-' }}
                                            </span>
                                        </td>

                                        <td class="px-6 py-4 text-sm font-semibold text-red-600 dark:text-rose-300">
                                            {{ number_format($p->jumlah, 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-4 text-sm text-gray-500 dark:text-slate-400">
                                            {{ $p->keterangan }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="border p-2 text-center" colspan="4">Tidak ada pengeluaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
@endsection