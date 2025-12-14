@extends('layouts.app')

@section('content')

  <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
      {{-- Sisa Saldo Saat Ini --}}
      <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-200 dark:border-slate-700 shadow-sm">
          <div class="flex justify-between items-start">
              <div>
                  <p class="text-sm font-medium text-gray-500">Sisa Saldo Saat Ini</p>
                  <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($saldoSaatIni, 0, ',', '.') }}</p>
              </div>
              <div class="p-2 bg-blue-50 rounded-lg">
                  <i class="fas fa-folder text-blue-500"></i>
              </div>
          </div>
          <div class="flex items-center mt-3">
              <span class="text-xs text-green-500 font-medium flex items-center">
                  <i class="fas fa-arrow-up mr-1"></i> 12%
              </span>
              <span class="text-xs text-gray-500 ml-2">from last month</span>
          </div>
      </div>
      {{--Total Pemasukan Bulan Ini  --}}
      <div class="bg-white dark:bg-slate-800 p-4 rounded-xl border border-gray-200 dark:border-slate-700 shadow-sm">
          <div class="flex justify-between items-start">
              <div>
                  <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pemasukan Bulan Ini</p>
                  <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 mt-1">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</p>
              </div>
              <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                  <i class="fas fa-check-circle text-green-500"></i>
              </div>
          </div>
          <div class="flex items-center mt-3">
              <span class="text-xs text-green-500 font-medium flex items-center">
                  <i class="fas fa-arrow-up mr-1"></i> 5%
              </span>
              <span class="text-xs text-gray-500 dark:text-gray-400 ml-2">from last month</span>
          </div>
      </div>
      {{--Total Pemasukan Selama Ini  --}}
      <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
          <div class="flex justify-between items-start">
              <div>
                  <p class="text-sm font-medium text-gray-500">Pemasukan Selama Ini</p>
                  <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
              </div>
              <div class="p-2 bg-yellow-50 rounded-lg">
                  <i class="fas fa-clock text-yellow-500"></i>
              </div>
          </div>
          <div class="flex items-center mt-3">
              <span class="text-xs text-red-500 font-medium flex items-center">
                  <i class="fas fa-arrow-down mr-1"></i> 2%
              </span>
              <span class="text-xs text-gray-500 ml-2">from last month</span>
          </div>
      </div>
      {{-- Total Pengeluaran Bulan Ini --}}
      <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
          <div class="flex justify-between items-start">
              <div>
                  <p class="text-sm font-medium text-gray-500">Total Pengeluaran Bulan Ini</p>
                  <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</p>
              </div>
              <div class="p-2 bg-purple-50 rounded-lg">
                  <i class="fas fa-dollar-sign text-purple-500"></i>
              </div>
          </div>
          <div class="flex items-center mt-3">
              <span class="text-xs text-green-500 font-medium flex items-center">
                  <i class="fas fa-arrow-up mr-1"></i> 8%
              </span>
              <span class="text-xs text-gray-500 ml-2">from last month</span>
          </div>
      </div>
      {{-- Total Pengeluaran Selama Ini --}}
      <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
          <div class="flex justify-between items-start">
              <div>
                  <p class="text-sm font-medium text-gray-500">Total Pengeluaran Selama Ini</p>
                  <p class="text-2xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
              </div>
              <div class="p-2 bg-purple-50 rounded-lg">
                  <i class="fas fa-dollar-sign text-purple-500"></i>
              </div>
          </div>
          <div class="flex items-center mt-3">
              <span class="text-xs text-green-500 font-medium flex items-center">
                  <i class="fas fa-arrow-up mr-1"></i> 8%
              </span>
              <span class="text-xs text-gray-500 ml-2">from last month</span>
          </div>
      </div>
  </div>

  {{--  --}}
@php
    $clearFilterUrl = request()->url();

    // toggle 2 state only
    if ($tipe === 'pengeluaran') {
        $nextTipe = 'pemasukan';
    } else {
        $nextTipe = 'pengeluaran';
    }
@endphp


{{--  --}}
                <div class="mt-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Riwayat Transaksi
                        </h3>
                    </div>
                    @if ($tipe)
                    <div class="px-6 py-3 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                        <div class="text-sm text-gray-600">
                            Menampilkan data berdasarkan:
                            <span class="font-semibold
                                {{ $tipe === 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst($tipe) }}
                            </span>
                        </div>

                        <a href="{{ $clearFilterUrl }}"
                        class="flex items-center gap-1 text-sm text-gray-500 hover:text-red-600 transition"
                        title="Hapus filter">
                            <i class="fas fa-times"></i>
                            <span class="hidden sm:inline">Clear</span>
                        </a>
                    </div>
                    @endif

                    <div class="overflow-x-auto max-h-96">
                        <table class="min-w-full table-fixed divide-y divide-gray-200">
                            <thead class="bg-gray-50 sticky top-0 z-10">
                                <tr>
                                    <th scope="col" class="px-6 py-3 w-32 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-32 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['tipe' => $nextTipe, 'page' => 1]) }}">
                                            Tipe
                                            @if ($tipe === 'pemasukan')
                                                <i class="fas fa-arrow-up text-green-500 ml-1"></i>
                                            @elseif ($tipe === 'pengeluaran')
                                                <i class="fas fa-arrow-down text-red-500 ml-1"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-6 py-3 w-40 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jumlah Rp
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Deskripsi
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($transaksi as $item)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                            
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="
                                            px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                            {{ $item->tipe === 'Pemasukan'
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700' }}
                                        ">
                                            {{ $item->tipe }}
                                        </span>
                                    </td>


                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="
                                            text-sm font-medium
                                            {{ $item->tipe === 'Pemasukan' ? 'text-green-600' : 'text-red-600' }}
                                        ">
                                            @if ($item->tipe === 'Pemasukan')
                                                 Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                            @else
                                                Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                                            @endif
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500 line-clamp-3">
                                            {{ $item->keterangan ?? '-' }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" align="center">Belum ada transaksi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $transaksi->links() }}
                </div>
{{--  --}}
@endsection