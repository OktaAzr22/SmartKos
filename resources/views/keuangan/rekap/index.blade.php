@extends('layouts.app')

@section('content')
<x-breadcrumb />
@if($rekap->count() == 0)
    <div class="py-16 flex flex-col items-center justify-center text-center bg-amber-200 rounded-2xl">
          
          <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full 
                      flex items-center justify-center mb-4">
              <i class="fas fa-inbox text-gray-400 dark:text-gray-300 text-xl"></i>
          </div>

          <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-2">
              Tidak ada data
          </h3>

          <p class="text-sm text-gray-500 dark:text-gray-300 mb-6">
              Belum ada transaksi yang tercatat
          </p>

          <form action="{{ route('rekap.proses') }}" method="POST">
            @csrf
            <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                <i class="fas fa-plus"></i>
                <span>Rekap Bulanan</span>
            </button>
        </form>

      </div>
@else
                <div class="mb-6 bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-900">
                            Laporan Keuangan 
                            @if($tahunDipilih)
                                {{ $tahunDipilih }}
                            @endif
                        </h3>
                        <div class="flex items-center space-x-2">
                            <form method="GET">
                                <div class="flex items-center space-x-1 text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300 bg-white">
                                    <i class="fas fa-calendar-alt text-gray-500"></i>
                                    <select name="tahun" onchange="this.form.submit()" class="ml-1 bg-transparent border-none focus:outline-none focus:ring-0 text-sm">
                                        <option value="">Pilih Periode</option>
                                        @foreach($listTahun as $tahun)
                                            <option value="{{ $tahun }}"
                                                {{ $tahunDipilih == $tahun ? 'selected' : '' }}>
                                                {{ $tahun }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            
                            <form action="{{ route('rekap.proses') }}" method="POST">
                                @csrf
                                <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
                                    <i class="fas fa-plus"></i>
                                    <span>Rekap Bulanan</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaksi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemasukan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengeluaran</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Awal</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saldo Akhir</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($rekap as $r)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary-600" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <div class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::create()->month($r->bulan)->translatedFormat('F') }}  {{ $r->tahun }}</div>
                                                <div class="text-xs text-gray-500">Total transaksi: 99</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-600">Rp {{ number_format($r->total_pemasukan, 0, ',', '.') }}</div>
                                        @if(!is_null($r->pemasukan_percent))
                                            <div class="text-xs flex items-center gap-1">
                                                <span
                                                    class="
                                                        {{ $r->pemasukan_percent > 0 ? 'text-green-600' :
                                                        ($r->pemasukan_percent < 0 ? 'text-red-600' : 'text-gray-500') }}
                                                    ">
                                                    {{ $r->pemasukan_percent > 0 ? '+' : '' }}{{ $r->pemasukan_percent }}%
                                                </span>

                                                <span class="text-gray-400">
                                                    dari bulan lalu
                                                </span>
                                            </div>
                                        @else
                                            <div class="text-xs text-gray-400">Data pertama</div>
                                        @endif
                                    </td>
                
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-600">Rp {{ number_format($r->total_pengeluaran, 0, ',', '.') }}</div>
                                        @if(!is_null($r->pengeluaran_percent))
                                            <div class="text-xs flex items-center gap-1">
                                                <span
                                                    class="
                                                        {{ $r->pengeluaran_percent > 0 ? 'text-red-600' :
                                                        ($r->pengeluaran_percent < 0 ? 'text-green-600' : 'text-gray-500') }}
                                                    ">
                                                    {{ $r->pengeluaran_percent > 0 ? '+' : '' }}{{ $r->pengeluaran_percent }}%
                                                </span>

                                                <span class="text-gray-400">
                                                    dari bulan lalu
                                                </span>
                                            </div>
                                        @else
                                            <div class="text-xs text-gray-400">Data pertama</div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-700">Rp {{ number_format($r->saldo_awal, 0, ',', '.') }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-bold text-gray-600">Rp {{ number_format($r->saldo_akhir, 0, ',', '.') }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex space-x-2">
                                            @if (!$r->is_printed)
                                                <a href="{{ route('rekap.detail', $r->id) }}">
                                                    <button class="view-btn p-2 text-primary-500 hover:text-primary-700 hover:bg-primary-50 rounded transition duration-150" title="View Details">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </a>
                                                
                                                <a href="{{ route('rekap.cetak', $r->id) }}" target="_blank">
                                                    <button class="print-btn p-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded transition duration-150" title="Cetak PDF">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd" />
                                                        </svg>
                                                    </button>
                                                </a>
                                            @else
                                            
                                                <!-- Icon 3: View Laporan -->
                                                <button type="button" onclick="openPdfModal('{{ route('rekap.viewPdf', $r->id) }}')" class="view-alt-btn p-2 text-blue-500 hover:text-blue-700 hover:bg-blue-50 rounded transition duration-150" title="View Laporan">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
                    {{ $rekap->links() }}
                    
                   
                </div>
{{--  --}}
@endif

{{-- MODAL PREVIEW PDF --}}
<div id="pdfModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-lg w-11/12 md:w-3/4 h-[90vh] flex flex-col">

        {{-- Header --}}
        <div class="flex justify-between items-center p-4 border-b">
            <h3 class="text-lg font-semibold">Preview Rekap PDF</h3>
            <button onclick="closePdfModal()" class="text-gray-600 text-xl">&times;</button>
        </div>

        {{-- Content --}}
        <div class="flex-1">
            <iframe id="pdfFrame"
                    src=""
                    class="w-full h-full"
                    frameborder="0">
            </iframe>
        </div>

        {{-- Footer --}}
        <div class="p-3 border-t text-right">
            <button onclick="closePdfModal()"
                    class="px-4 py-2 bg-gray-600 text-white rounded">
                Tutup
            </button>
        </div>

    </div>
</div>

<script>
function openPdfModal(url) {
    document.getElementById('pdfFrame').src = url;
    document.getElementById('pdfModal').classList.remove('hidden');
    document.getElementById('pdfModal').classList.add('flex');
}

function closePdfModal() {
    document.getElementById('pdfFrame').src = '';
    document.getElementById('pdfModal').classList.add('hidden');
    document.getElementById('pdfModal').classList.remove('flex');
}
</script>
@endsection
