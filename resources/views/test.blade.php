@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    {{-- Card Utama --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 p-6 mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">🎨 Test Warna Dark Theme</h2>
        
        {{-- Grid untuk menampilkan contoh dark theme --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- 1. Slate Theme --}}
            <div class="bg-slate-900 rounded-xl overflow-hidden border border-slate-700">
                <div class="p-4 bg-slate-800 border-b border-slate-700">
                    <h3 class="text-slate-200 font-semibold flex items-center gap-2">
                        <span class="w-3 h-3 bg-slate-400 rounded-full"></span>
                        Slate Theme
                    </h3>
                </div>
                <div class="p-6">
                    <div class="bg-slate-800 p-4 rounded-lg border border-slate-700">
                        <h4 class="text-slate-50 text-lg font-bold mb-2">Card Title</h4>
                        <p class="text-slate-400 text-sm mb-4">Deskripsi text yang lebih redup untuk konten secondary</p>
                        <button class="w-full bg-slate-700 hover:bg-slate-600 text-slate-200 px-4 py-2 rounded-lg transition-colors">
                            Tombol Slate
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- 2. Gray Theme --}}
            <div class="bg-gray-900 rounded-xl overflow-hidden border border-gray-700">
                <div class="p-4 bg-gray-800 border-b border-gray-700">
                    <h3 class="text-gray-200 font-semibold flex items-center gap-2">
                        <span class="w-3 h-3 bg-gray-400 rounded-full"></span>
                        Gray Theme
                    </h3>
                </div>
                <div class="p-6">
                    <div class="bg-gray-800 p-4 rounded-lg border border-gray-700">
                        <h4 class="text-gray-50 text-lg font-bold mb-2">Dashboard Card</h4>
                        <div class="bg-gray-700 p-3 rounded mb-4">
                            <p class="text-gray-300 text-sm">Content card dengan background berbeda</p>
                        </div>
                        <button class="w-full bg-gray-700 hover:bg-gray-600 text-gray-200 px-4 py-2 rounded-lg transition-colors">
                            Tombol Gray
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- 3. Zinc Theme --}}
            <div class="bg-zinc-900 rounded-xl overflow-hidden border border-zinc-700">
                <div class="p-4 bg-zinc-800 border-b border-zinc-700">
                    <h3 class="text-zinc-200 font-semibold flex items-center gap-2">
                        <span class="w-3 h-3 bg-zinc-400 rounded-full"></span>
                        Zinc Theme
                    </h3>
                </div>
                <div class="p-6">
                    <div class="bg-zinc-800 p-4 rounded-lg border border-zinc-700">
                        <h4 class="text-zinc-50 text-lg font-bold mb-2">Minimal Card</h4>
                        <nav class="bg-zinc-700 rounded-lg p-2 mb-4">
                            <span class="text-zinc-300 text-sm">Logo / Navigation</span>
                        </nav>
                        <p class="text-zinc-400 text-sm mb-4">Main content area dengan warna zinc yang cool</p>
                        <button class="w-full bg-zinc-700 hover:bg-zinc-600 text-zinc-200 px-4 py-2 rounded-lg transition-colors">
                            Tombol Zinc
                        </button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {{-- SECTION: ZINC THEME - 4 CARDS --}}
    <div class="bg-zinc-900 rounded-xl border border-zinc-700 p-6 mb-6">
        {{-- Header Section --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-zinc-50 flex items-center gap-3">
                    <span class="w-2 h-8 bg-zinc-400 rounded-full"></span>
                    Zinc Theme - Statistics Cards
                </h2>
                <p class="text-sm text-zinc-400 mt-2">4 informasi penting dalam tampilan zinc yang cool dan minimalis</p>
            </div>
            
            {{-- Filter Button --}}
            <button class="flex items-center gap-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-4 py-2 rounded-lg transition-colors border border-zinc-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                </svg>
                <span>Filter Periode</span>
            </button>
        </div>

        {{-- Grid 4 Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Card 1: Total Revenue --}}
            <div class="bg-zinc-800 rounded-xl border border-zinc-700 p-6 hover:border-zinc-600 transition-all hover:shadow-lg hover:shadow-zinc-900/50 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-zinc-700 rounded-lg group-hover:bg-zinc-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-zinc-700 text-zinc-300 rounded-full">+12.5%</span>
                </div>
                <h3 class="text-zinc-400 text-sm font-medium mb-1">Total Revenue</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-zinc-50">Rp 45.5M</span>
                    <span class="text-xs text-zinc-500">bulan ini</span>
                </div>
                <div class="mt-4 pt-4 border-t border-zinc-700">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-zinc-400">📈</span>
                        <span class="text-zinc-300">Naik 8.2%</span>
                        <span class="text-zinc-500">dari bulan lalu</span>
                    </div>
                </div>
            </div>

            {{-- Card 2: Total Orders --}}
            <div class="bg-zinc-800 rounded-xl border border-zinc-700 p-6 hover:border-zinc-600 transition-all hover:shadow-lg hover:shadow-zinc-900/50 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-zinc-700 rounded-lg group-hover:bg-zinc-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-zinc-700 text-zinc-300 rounded-full">+5.2%</span>
                </div>
                <h3 class="text-zinc-400 text-sm font-medium mb-1">Total Orders</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-zinc-50">2.845</span>
                    <span class="text-xs text-zinc-500">orders</span>
                </div>
                <div class="mt-4 pt-4 border-t border-zinc-700">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-zinc-400">📦</span>
                        <span class="text-zinc-300">1.230 proses</span>
                        <span class="text-zinc-500">| 1.615 selesai</span>
                    </div>
                </div>
            </div>

            {{-- Card 3: Total Customers --}}
            <div class="bg-zinc-800 rounded-xl border border-zinc-700 p-6 hover:border-zinc-600 transition-all hover:shadow-lg hover:shadow-zinc-900/50 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-zinc-700 rounded-lg group-hover:bg-zinc-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-zinc-700 text-zinc-300 rounded-full">+18.3%</span>
                </div>
                <h3 class="text-zinc-400 text-sm font-medium mb-1">Total Customers</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-zinc-50">1.234</span>
                    <span class="text-xs text-zinc-500">pelanggan</span>
                </div>
                <div class="mt-4 pt-4 border-t border-zinc-700">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-zinc-400">👥</span>
                        <span class="text-zinc-300">156 baru</span>
                        <span class="text-zinc-500">bulan ini</span>
                    </div>
                </div>
            </div>

            {{-- Card 4: Conversion Rate --}}
            <div class="bg-zinc-800 rounded-xl border border-zinc-700 p-6 hover:border-zinc-600 transition-all hover:shadow-lg hover:shadow-zinc-900/50 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="p-3 bg-zinc-700 rounded-lg group-hover:bg-zinc-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-zinc-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <span class="text-xs font-medium px-2 py-1 bg-zinc-700 text-zinc-300 rounded-full">+2.1%</span>
                </div>
                <h3 class="text-zinc-400 text-sm font-medium mb-1">Conversion Rate</h3>
                <div class="flex items-baseline gap-2">
                    <span class="text-2xl font-bold text-zinc-50">23.6%</span>
                    <span class="text-xs text-zinc-500">rata-rata</span>
                </div>
                <div class="mt-4 pt-4 border-t border-zinc-700">
                    <div class="flex items-center gap-2 text-sm">
                        <span class="text-zinc-400">🎯</span>
                        <span class="text-zinc-300">Target 25%</span>
                        <span class="text-zinc-500">| 1.4% lagi</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Additional Info Cards (Mini Cards) --}}
        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-zinc-800/50 rounded-lg p-3 border border-zinc-700">
                <div class="text-xs text-zinc-500">Today</div>
                <div class="text-lg font-semibold text-zinc-200">Rp 2.4M</div>
                <div class="text-xs text-zinc-400">+12% from yesterday</div>
            </div>
            <div class="bg-zinc-800/50 rounded-lg p-3 border border-zinc-700">
                <div class="text-xs text-zinc-500">This Week</div>
                <div class="text-lg font-semibold text-zinc-200">Rp 18.2M</div>
                <div class="text-xs text-zinc-400">+8% from last week</div>
            </div>
            <div class="bg-zinc-800/50 rounded-lg p-3 border border-zinc-700">
                <div class="text-xs text-zinc-500">This Month</div>
                <div class="text-lg font-semibold text-zinc-200">Rp 45.5M</div>
                <div class="text-xs text-zinc-400">+15% from last month</div>
            </div>
            <div class="bg-zinc-800/50 rounded-lg p-3 border border-zinc-700">
                <div class="text-xs text-zinc-500">This Year</div>
                <div class="text-lg font-semibold text-zinc-200">Rp 425M</div>
                <div class="text-xs text-zinc-400">+22% from last year</div>
            </div>
        </div>
    </div>

    {{-- SECTION: ZINC THEME TABEL (dari sebelumnya) --}}
    <div class="bg-zinc-900 rounded-xl border border-zinc-700 p-6">
        {{-- Header Tabel --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-zinc-50 flex items-center gap-2">
                    <span class="w-4 h-4 bg-zinc-400 rounded-full"></span>
                    Daftar Transaksi - Zinc Theme
                </h2>
                <p class="text-sm text-zinc-400 mt-1">Kelola semua data transaksi dengan tema zinc</p>
            </div>
            
            {{-- Tombol Tambah Zinc --}}
            <button class="flex items-center gap-2 bg-zinc-700 hover:bg-zinc-600 text-zinc-200 px-4 py-2 rounded-lg transition-colors border border-zinc-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span>Tambah Data Zinc</span>
            </button>
        </div>

        {{-- Tabel Zinc --}}
        <div class="overflow-x-auto rounded-lg border border-zinc-700">
            <table class="min-w-full divide-y divide-zinc-700">
                <thead class="bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase">Keterangan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-zinc-900 divide-y divide-zinc-800">
                    @php
                        $data3 = [
                            ['no' => 1, 'jumlah' => 'Rp 4.500.000', 'keterangan' => 'Sewa kantor', 'tanggal' => '2024-01-23', 'status' => 'Selesai'],
                            ['no' => 2, 'jumlah' => 'Rp 650.000', 'keterangan' => 'Pulsa & data', 'tanggal' => '2024-01-24', 'status' => 'Proses'],
                            ['no' => 3, 'jumlah' => 'Rp 1.250.000', 'keterangan' => 'ATK kantor', 'tanggal' => '2024-01-25', 'status' => 'Pending'],
                        ];
                    @endphp
                    
                    @foreach($data3 as $item)
                    <tr class="hover:bg-zinc-800/50 transition-colors">
                        <td class="px-6 py-4 text-sm text-zinc-300">{{ $item['no'] }}</td>
                        <td class="px-6 py-4 text-sm text-zinc-200 font-medium">{{ $item['jumlah'] }}</td>
                        <td class="px-6 py-4 text-sm text-zinc-400">{{ $item['keterangan'] }}</td>
                        <td class="px-6 py-4 text-sm text-zinc-400">{{ $item['tanggal'] }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColor = [
                                    'Selesai' => 'bg-zinc-700 text-zinc-300',
                                    'Proses' => 'bg-zinc-600 text-zinc-200',
                                    'Pending' => 'bg-zinc-800 text-zinc-400',
                                ][$item['status']] ?? 'bg-zinc-800 text-zinc-400';
                            @endphp
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusColor }}">
                                {{ $item['status'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button class="text-zinc-400 hover:text-zinc-300">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </button>
                                <button class="text-zinc-500 hover:text-zinc-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination Zinc --}}
        <div class="flex justify-between items-center mt-6">
            <div class="text-sm text-zinc-400">Showing 1 to 3 of 3 results</div>
            <div class="flex gap-2">
                <button class="px-3 py-2 rounded bg-zinc-800 text-zinc-400 border border-zinc-700" disabled>Prev</button>
                <button class="px-4 py-2 rounded bg-zinc-700 text-zinc-200 border border-zinc-600">1</button>
                <button class="px-3 py-2 rounded bg-zinc-800 text-zinc-400 border border-zinc-700">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection