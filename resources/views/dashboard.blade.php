@extends('layouts.app')

@section('content')

   <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    {{-- CARD --}}
    <div class="bg-background dark:bg-dark-900 
                p-4 rounded-xl border border-dark-200 dark:border-dark-700 
                shadow-sm">

        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-dark-500">
                    Sisa Saldo Saat Ini
                </p>
                <p class="text-2xl font-bold text-text mt-1">
                    Rp {{ number_format($saldoSaatIni, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-primary-50 dark:bg-dark-800 rounded-lg">
                <i class="fas fa-folder text-primary"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-success font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 12%
            </span>
            <span class="text-xs text-dark-500 ml-2">
                from last month
            </span>
        </div>
    </div>


    {{-- CARD --}}
    <div class="bg-background dark:bg-dark-900 
                p-4 rounded-xl border border-dark-200 dark:border-dark-700 
                shadow-sm">

        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-dark-500">
                    Total Pemasukan Bulan Ini
                </p>
                <p class="text-2xl font-bold text-text mt-1">
                    Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-success/10 dark:bg-success/20 rounded-lg">
                <i class="fas fa-check-circle text-success"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-success font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 5%
            </span>
            <span class="text-xs text-dark-500 ml-2">
                from last month
            </span>
        </div>
    </div>


    {{-- CARD --}}
    <div class="bg-background dark:bg-dark-900 
                p-4 rounded-xl border border-dark-200 dark:border-dark-700 
                shadow-sm">

        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-dark-500">
                    Pemasukan Selama Ini
                </p>
                <p class="text-2xl font-bold text-text mt-1">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-secondary/10 dark:bg-secondary/20 rounded-lg">
                <i class="fas fa-clock text-secondary"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-danger font-medium flex items-center">
                <i class="fas fa-arrow-down mr-1"></i> 2%
            </span>
            <span class="text-xs text-dark-500 ml-2">
                from last month
            </span>
        </div>
    </div>


    {{-- CARD --}}
    <div class="bg-background dark:bg-dark-900 
                p-4 rounded-xl border border-dark-200 dark:border-dark-700 
                shadow-sm">

        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-dark-500">
                    Total Pengeluaran Bulan Ini
                </p>
                <p class="text-2xl font-bold text-text mt-1">
                    Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-danger/10 dark:bg-danger/20 rounded-lg">
                <i class="fas fa-dollar-sign text-danger"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-success font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 8%
            </span>
            <span class="text-xs text-dark-500 ml-2">
                from last month
            </span>
        </div>
    </div>


    {{-- CARD --}}
    <div class="bg-background dark:bg-dark-900 
                p-4 rounded-xl border border-dark-200 dark:border-dark-700 
                shadow-sm">

        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-dark-500">
                    Total Pengeluaran Selama Ini
                </p>
                <p class="text-2xl font-bold text-text mt-1">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-danger/10 dark:bg-danger/20 rounded-lg">
                <i class="fas fa-dollar-sign text-danger"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-success font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 8%
            </span>
            <span class="text-xs text-dark-500 ml-2">
                from last month
            </span>
        </div>
    </div>

</div>

    <div class="grid grid-cols-12 gap-6 items-stretch">

        {{-- ================= GRAFIK 70% ================= --}}
        <div class="col-span-12 lg:col-span-8
                    bg-white dark:bg-slate-800 rounded-xl shadow p-5
                    border border-gray-200 dark:border-slate-700">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Grafik Keuangan Bulanan
                </h2>

                <select id="tahunSelect"
                    class="px-3 py-2 rounded-lg border dark:border-slate-600
                        bg-white dark:bg-slate-700
                        text-gray-900 dark:text-white text-sm">
                    @foreach ($tahunTersedia as $th)
                        <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>
                            {{ $th }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Skeleton --}}
            <div id="chartSkeleton" class="animate-pulse space-y-3">
                <div class="h-4 bg-gray-200 dark:bg-slate-700 rounded w-1/4"></div>
                <div class="h-[380px] bg-gray-200 dark:bg-slate-700 rounded"></div>
            </div>

            {{-- Chart --}}
            <div id="chartContainer" class="hidden overflow-x-auto no-scrollbar">
                <div class="min-w-[900px] h-[320px]">
                    <canvas id="grafikBulanan"></canvas>
                </div>
            </div>
        </div>

        {{-- ================= DONUT 30% ================= --}}
        <div class="col-span-12 lg:col-span-4
                    bg-white dark:bg-slate-800 rounded-xl shadow p-5
                    border border-gray-200 dark:border-slate-700">

            <div class="flex flex-col h-full">

                <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-white">
                    Chart Data
                    <span class="block text-sm text-gray-500">(Bulan Ini)</span>
                </h2>

                {{-- Donut Center --}}
                <div class="flex-1 flex items-center justify-center">
                    <div class="relative w-full max-w-[200px] h-[200px]">
                        <canvas id="donutBulanIni"></canvas>
                        <div id="donutEmpty"
                            class="absolute inset-0 flex items-center justify-center text-center
                                    text-sm text-gray-500 dark:text-gray-400 hidden">
                            Data belum ada
                        </div>
                    </div>
                </div>

                {{-- Legend --}}
                <div class="mt-4 flex items-center justify-center gap-6 text-sm">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-green-500"></span>
                        <span class="text-gray-700 dark:text-gray-300">
                            Pemasukan
                        </span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-red-500"></span>
                        <span class="text-gray-700 dark:text-gray-300">
                            Pengeluaran
                        </span>
                    </div>
                </div>


            </div>
        </div>

    </div>

    @php
        $clearFilterUrl = request()->url();

        if ($tipe === 'pengeluaran') {
            $nextTipe = 'pemasukan';
        } else {
            $nextTipe = 'pengeluaran';
        }
    @endphp

    <div id="riwayat-transaksi" class="mt-6">

    @if ($transaksi->isEmpty())
        <x-empty-state
            title="Data Belum Ada"
            description="Belum ada transaksi"
        />
    @else

    <div class="bg-background dark:bg-dark-900
                rounded-xl border border-dark-200 dark:border-dark-700
                shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-dark-200 dark:border-dark-700 
                    flex justify-between items-center">
            <h3 class="text-lg font-semibold text-text">
                Riwayat Transaksi
            </h3>
        </div>

        @if ($tipe)
        <div class="px-6 py-3 bg-dark-50 dark:bg-dark-800
                    border-b border-dark-200 dark:border-dark-700
                    flex items-center justify-between">

            <div class="text-sm text-dark-600 dark:text-dark-300">
                Menampilkan data berdasarkan:
                <span class="font-semibold
                    {{ $tipe === 'pemasukan' ? 'text-success' : 'text-danger' }}">
                    {{ ucfirst($tipe) }}
                </span>
            </div>

            <a href="{{ $clearFilterUrl }}"
               class="flex items-center gap-1 text-sm
                      text-dark-500 hover:text-danger transition">
                <i class="fas fa-times"></i>
                <span class="hidden sm:inline">Clear</span>
            </a>
        </div>
        @endif

        <div class="overflow-x-auto max-h-96">
            <table class="min-w-full divide-y divide-dark-200 dark:divide-dark-700">

                <thead class="bg-dark-50 dark:bg-dark-800 sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase">
                            Tipe
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase">
                            Jumlah Rp
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-dark-500 uppercase">
                            Deskripsi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-background dark:bg-dark-900
                               divide-y divide-dark-200 dark:divide-dark-700">

                    @foreach ($transaksi as $item)
                    <tr class="hover:bg-dark-50 dark:hover:bg-dark-800 transition">

                        <td class="px-6 py-4 text-sm font-medium text-text">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $item->tipe === 'Pemasukan'
                                    ? 'bg-success/10 text-success'
                                    : 'bg-danger/10 text-danger' }}">
                                {{ $item->tipe }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm font-semibold
                            {{ $item->tipe === 'Pemasukan' ? 'text-success' : 'text-danger' }}">
                            Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-sm text-dark-600 dark:text-dark-300">
                            {{ $item->keterangan ?? '-' }}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{ $transaksi->withQueryString()->fragment('riwayat-transaksi')->links() }}

    </div>
    @endif
</div>

    <div class="bg-background dark:bg-dark-900 
            rounded-xl shadow-sm 
            border border-dark-200 dark:border-dark-700
            p-4 mt-6">

    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 class="font-semibold text-text">
                Kategori Pengeluaran Teratas
            </h3>
            <p class="text-xs text-dark-500">
                Ringkasan kategori dengan pengeluaran terbesar
            </p>
        </div>

        @if ($bulanKategoriTersedia->count())
            <form method="GET">
                <select name="bulan_kategori"
                    class="rounded-lg px-3 py-1.5 text-sm
                           bg-background dark:bg-dark-800
                           border border-dark-300 dark:border-dark-700
                           text-text
                           focus:outline-none focus:ring-2 focus:ring-primary"
                    onchange="this.form.submit()">
                    @foreach ($bulanKategoriTersedia as $bulan)
                        <option value="{{ $bulan }}"
                            {{ $bulanKategori == $bulan ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                        </option>
                    @endforeach
                </select>
            </form>
        @endif
    </div>

    @if ($topKategori->count())

        @php
            $maxNominal = $topKategori->max('total_nominal') ?? 1;
        @endphp

        @foreach ($topKategori as $index => $item)
            @php
                $percentBar = ($item->total_nominal / $maxNominal) * 100;
                $percentTotal = $totalPengeluaranRekap > 0
                    ? round(($item->total_nominal / $totalPengeluaranRekap) * 100)
                    : 0;
            @endphp

            <div class="py-3 border-b border-dark-200 dark:border-dark-700 last:border-b-0">

                <div class="flex justify-between items-center mb-1">
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-dark-700 dark:text-dark-200">
                            {{ $item->kategori->nama_kategori }}
                        </span>

                        @if ($index === 0)
                            <span class="text-xs px-2 py-0.5 rounded-full
                                         bg-danger/10 text-danger font-semibold">
                                🔥 Paling Boros
                            </span>
                        @elseif ($index === 1)
                            <span class="text-xs px-2 py-0.5 rounded-full
                                         bg-secondary/10 text-secondary">
                                🔁 Sering
                            </span>
                        @endif
                    </div>

                    <span class="text-sm font-semibold text-danger">
                        Rp {{ number_format($item->total_nominal, 0, ',', '.') }}
                    </span>
                </div>

                <p class="text-xs text-dark-500 mb-1">
                    {{ $item->jumlah_transaksi }} transaksi • {{ $percentTotal }}%
                </p>

                <div class="w-full bg-dark-200 dark:bg-dark-800 rounded-full h-2 overflow-hidden"
                     title="{{ $percentTotal }}% dari total pengeluaran">

                    <div class="h-2 rounded-full transition-all duration-700 ease-out
                        {{ $index === 0 
                            ? 'bg-danger' 
                            : ($index === 1 ? 'bg-secondary' : 'bg-primary') }}"
                        style="width: {{ $percentBar }}%">
                    </div>

                </div>

            </div>
        @endforeach

    @else
        <div class="text-center py-8 text-dark-400 text-sm">
            <div class="text-2xl mb-2">📉</div>
            Belum ada data pengeluaran untuk bulan ini
        </div>
    @endif

</div>

    <script>
        window.dashboardChart = {
            labels: @json($labels),
            pemasukan: @json($dataPemasukan),
            pengeluaran: @json($dataPengeluaran),
            saldo: @json($dataSaldoAkhir),
            pemasukanBulanIni: {{ $pemasukanBulanIni }},
            pengeluaranBulanIni: {{ $pengeluaranBulanIni }},
            chartUrl: "{{ route('dashboard.chart') }}"
        }
    </script>
    @vite('resources/js/dashboard.js')

@endsection