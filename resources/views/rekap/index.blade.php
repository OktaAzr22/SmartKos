@extends('layouts.app')

@section('content')

@if($rekap->count() == 0)
    <p>Belum ada data rekap bulanan.</p>

    <form action="{{ route('rekap.proses') }}" method="POST">
        @csrf
        <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
            <i class="fas fa-plus"></i>
            <span>Rekap Bulanan</span>
        </button>
    </form>

@else

<div>

    {{-- Tombol Rekap Baru --}}
    <form action="{{ route('rekap.proses') }}" method="POST" class="mb-4">
        @csrf
        <button class="flex items-center space-x-1 text-gray-500 hover:text-gray-700 text-sm font-medium py-1 px-3 rounded-lg border border-gray-300">
            <i class="fas fa-plus"></i>
            <span>Rekap Bulanan</span>
        </button>
    </form>

    <table class="table-auto w-full border-collapse">
        <thead>
            <tr>
                <th>Transaksi</th>
                <th>Pemasukan (Rp)</th>
                <th>Pengeluaran (Rp)</th>
                <th>Saldo Awal (Rp)</th>
                <th>Saldo Akhir (Rp)</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rekap as $r)
                <tr>
                    <td>
                        {{ \Carbon\Carbon::create()->month($r->bulan)->translatedFormat('F') }} 
                        {{ $r->tahun }}
                    </td>

                    <td>Rp {{ number_format($r->total_pemasukan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($r->total_pengeluaran, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($r->saldo_awal, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($r->saldo_akhir, 0, ',', '.') }}</td>

                   <td class="space-x-2">

    @if (!$r->is_printed)

    <a href="{{ route('rekap.detail', $r->id) }}"
       class="px-3 py-1 bg-blue-500 text-white rounded">
        Detail
    </a>

    <a href="{{ route('rekap.cetak', $r->id) }}"
       target="_blank"
       class="px-3 py-1 bg-green-600 text-white rounded">
        Cetak PDF
    </a>

@else

    <button
        type="button"
        onclick="openPdfModal('{{ route('rekap.viewPdf', $r->id) }}')"
        class="px-3 py-1 bg-green-600 text-white rounded">
        Lihat PDF
    </button>

@endif


</td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

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
