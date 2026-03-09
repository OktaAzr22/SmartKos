@extends('layouts.app')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

    <!-- CARD 1: Sisa Saldo Saat Ini -->
    <div class="bg-white dark:bg-zinc-900 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm 
                hover:border-blue-500 dark:hover:border-blue-500 transition-all hover:shadow-lg hover:shadow-blue-500/10 dark:hover:shadow-blue-500/20 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-zinc-400">
                    Sisa Saldo Saat Ini
                </p>
                <p class="text-2xl font-bold text-gray-900 dark:text-zinc-100 mt-1">
                    Rp {{ number_format($saldoSaatIni, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg group-hover:bg-blue-200 dark:group-hover:bg-blue-800/50 transition-colors">
                <i class="fas fa-folder text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-green-600 dark:text-green-400 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 12%
            </span>
            <span class="text-xs text-gray-500 dark:text-zinc-500 ml-2">
                from last month
            </span>
        </div>
    </div>

    <!-- CARD 2: Total Pemasukan Bulan Ini -->
    <div class="bg-white dark:bg-zinc-900 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm 
                hover:border-green-500 dark:hover:border-green-500 transition-all hover:shadow-lg hover:shadow-green-500/10 dark:hover:shadow-green-500/20 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-zinc-400">
                    Total Pemasukan Bulan Ini
                </p>
                <p class="text-2xl font-bold text-gray-900 dark:text-zinc-100 mt-1">
                    Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg group-hover:bg-green-200 dark:group-hover:bg-green-800/50 transition-colors">
                <i class="fas fa-check-circle text-green-600 dark:text-green-400 group-hover:text-green-700 dark:group-hover:text-green-300"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-green-600 dark:text-green-400 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 5%
            </span>
            <span class="text-xs text-gray-500 dark:text-zinc-500 ml-2">
                from last month
            </span>
        </div>
    </div>

    <!-- CARD 3: Pemasukan Selama Ini -->
    <div class="bg-white dark:bg-zinc-900 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm 
                hover:border-orange-500 dark:hover:border-orange-500 transition-all hover:shadow-lg hover:shadow-orange-500/10 dark:hover:shadow-orange-500/20 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-zinc-400">
                    Pemasukan Selama Ini
                </p>
                <p class="text-2xl font-bold text-gray-900 dark:text-zinc-100 mt-1">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg group-hover:bg-orange-200 dark:group-hover:bg-orange-800/50 transition-colors">
                <i class="fas fa-clock text-orange-600 dark:text-orange-400 group-hover:text-orange-700 dark:group-hover:text-orange-300"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-red-600 dark:text-red-400 font-medium flex items-center">
                <i class="fas fa-arrow-down mr-1"></i> 2%
            </span>
            <span class="text-xs text-gray-500 dark:text-zinc-500 ml-2">
                from last month
            </span>
        </div>
    </div>

    <!-- CARD 4: Total Pengeluaran Bulan Ini -->
    <div class="bg-white dark:bg-zinc-900 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm 
                hover:border-red-500 dark:hover:border-red-500 transition-all hover:shadow-lg hover:shadow-red-500/10 dark:hover:shadow-red-500/20 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-zinc-400">
                    Total Pengeluaran Bulan Ini
                </p>
                <p class="text-2xl font-bold text-gray-900 dark:text-zinc-100 mt-1">
                    Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg group-hover:bg-red-200 dark:group-hover:bg-red-800/50 transition-colors">
                <i class="fas fa-dollar-sign text-red-600 dark:text-red-400 group-hover:text-red-700 dark:group-hover:text-red-300"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-green-600 dark:text-green-400 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 8%
            </span>
            <span class="text-xs text-gray-500 dark:text-zinc-500 ml-2">
                from last month
            </span>
        </div>
    </div>

    <!-- CARD 5: Total Pengeluaran Selama Ini -->
    <div class="bg-white dark:bg-zinc-900 p-4 rounded-xl border border-gray-200 dark:border-zinc-700 shadow-sm 
                hover:border-red-500 dark:hover:border-red-500 transition-all hover:shadow-lg hover:shadow-red-500/10 dark:hover:shadow-red-500/20 group">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-sm font-medium text-gray-500 dark:text-zinc-400">
                    Total Pengeluaran Selama Ini
                </p>
                <p class="text-2xl font-bold text-gray-900 dark:text-zinc-100 mt-1">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </p>
            </div>

            <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg group-hover:bg-red-200 dark:group-hover:bg-red-800/50 transition-colors">
                <i class="fas fa-dollar-sign text-red-600 dark:text-red-400 group-hover:text-red-700 dark:group-hover:text-red-300"></i>
            </div>
        </div>

        <div class="flex items-center mt-3">
            <span class="text-xs text-green-600 dark:text-green-400 font-medium flex items-center">
                <i class="fas fa-arrow-up mr-1"></i> 8%
            </span>
            <span class="text-xs text-gray-500 dark:text-zinc-500 ml-2">
                from last month
            </span>
        </div>
    </div>

</div>

<div class="grid grid-cols-12 gap-6 items-stretch">

    <div class=" col-span-12 lg:col-span-8
                bg-white dark:bg-zinc-900 rounded-xl shadow p-5
                border border-gray-200 dark:border-zinc-700">

        <div class="flex justify-between items-center mb-4">

            <h2 class="text-lg font-semibold text-gray-900 dark:text-zinc-100">
                Grafik Keuangan Bulanan
            </h2>
             
            @if($tahunTersedia->isNotEmpty())
                <select id="tahunSelect"
                        class="px-3 py-2 rounded-lg border border-gray-300 dark:border-zinc-600
                            bg-white dark:bg-zinc-800 text-gray-900 dark:text-zinc-200 text-sm">
                    @foreach ($tahunTersedia as $th)
                        <option value="{{ $th }}" {{ $th == $tahun ? 'selected' : '' }}>
                            {{ $th }}
                        </option>
                    @endforeach
                </select>
            @endif

        </div>

        <div class="relative">
            <div id="chartSkeleton" class="animate-pulse space-y-3">
                <div class="h-4 bg-gray-200 dark:bg-zinc-700 rounded w-1/4"></div>
                <div class="h-[380px] bg-gray-200 dark:bg-zinc-700 rounded"></div>
            </div>

            <div id="chartContainer" class="hidden overflow-x-auto no-scrollbar">
                <div class="min-w-[900px] h-[320px]">
                    <canvas id="grafikBulanan"></canvas>
                </div>
            </div>

            <div id="chartEmpty"
                class="absolute inset-0 flex flex-col items-center justify-center
                text-gray-500 dark:text-zinc-400 hidden">

                <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 3v18h18M7 14l4-4 4 4 4-4"/>
                </svg>

                <p class="text-sm">Data grafik belum tersedia</p>

            </div>
        </div>

    </div>

    <div class="col-span-12 lg:col-span-4
                bg-white dark:bg-zinc-900 rounded-xl shadow p-5
                border border-gray-200 dark:border-zinc-700">

        <div class="flex flex-col h-full">

            <h2 class="text-lg font-semibold mb-4 text-gray-900 dark:text-zinc-100">
                Chart Data
                <span class="block text-sm text-gray-500 dark:text-zinc-400">(Bulan Ini)</span>
            </h2>

            <div class="flex-1 flex items-center justify-center">
                <div class="relative w-full max-w-[200px] h-[200px]">
                    <canvas id="donutBulanIni"></canvas>
                    <div id="donutEmpty"
                        class="absolute inset-0 flex flex-col items-center justify-center
                        text-gray-500 dark:text-zinc-400 hidden">

                        <svg class="w-7 h-7 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3v18h18M7 14l4-4 4 4 4-4"/>
                        </svg>

                        <p class="text-xs">Data belum tersedia</p>

                    </div>
                </div>
            </div>

            <div id="donutLegend" class="mt-4 flex items-center justify-center gap-6 text-sm">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    <span class="text-gray-700 dark:text-zinc-300">
                        Pemasukan
                    </span>
                </div>

                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-red-500"></span>
                    <span class="text-gray-700 dark:text-zinc-300">
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

    <div class="bg-white dark:bg-zinc-900
                rounded-xl border border-gray-200 dark:border-zinc-700
                shadow-sm overflow-hidden">

        <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700
                    flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-zinc-100">
                Riwayat Transaksia
            </h3>
            <form method="GET">
                <select name="per_page"
                        onchange="this.form.submit()"
                        class="text-sm border-gray-300 rounded-md dark:bg-zinc-800 dark:border-zinc-700 dark:text-white">

                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>

                </select>
            </form>
        </div>

        @if ($tipe)
        <div class="px-6 py-3 bg-gray-50 dark:bg-zinc-800/50
                    border-b border-gray-200 dark:border-zinc-700
                    flex items-center justify-between">

            <div class="text-sm text-gray-600 dark:text-zinc-400">
                Menampilkan data berdasarkan:
                <span class="font-semibold
                    {{ $tipe === 'pemasukan' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ ucfirst($tipe) }}
                </span>
            </div>

            <a href="{{ $clearFilterUrl }}"
               class="flex items-center gap-1 text-sm
                      text-gray-500 dark:text-zinc-400 hover:text-red-600 dark:hover:text-red-400 transition">
                <i class="fas fa-times"></i>
                <span class="hidden sm:inline">Clear</span>
            </a>
        </div>
        @endif

        <div class="overflow-x-auto max-h-96">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">

                <thead class="bg-gray-50 dark:bg-zinc-800 sticky top-0 z-10">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase">
                            Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase">
                            <a href="{{ $toggleTipeUrl }}"
                            class="flex items-center gap-1 text-gray-500 dark:text-zinc-400 hover:text-indigo-600 transition">

                                Tipe

                                @if($tipe === 'pemasukan')
                                    <i class="fas fa-arrow-up text-green-500 text-xs"></i>
                                @elseif($tipe === 'pengeluaran')
                                    <i class="fas fa-arrow-down text-red-500 text-xs"></i>
                                @else
                                    <i class="fas fa-sort text-xs"></i>
                                @endif

                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase">
                            Jumlah Rp
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-zinc-400 uppercase">
                            Deskripsi
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-800">

                    @foreach ($transaksi as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800/50 transition">

                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-zinc-200">
                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $item->tipe === 'Pemasukan'
                                    ? 'bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400'
                                    : 'bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400' }}">
                                {{ $item->tipe }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-sm font-semibold
                            {{ $item->tipe === 'Pemasukan' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            Rp{{ number_format($item->jumlah, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-zinc-400">
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

<div class="bg-white dark:bg-zinc-900 
            rounded-xl shadow-sm 
            border border-gray-200 dark:border-zinc-700
            p-4 mt-6">

    <div class="flex justify-between items-center mb-4">
        <div>
            <h3 class="font-semibold text-gray-900 dark:text-zinc-100">
                Kategori Pengeluaran Teratas
            </h3>
            <p class="text-xs text-gray-500 dark:text-zinc-400">
                Ringkasan kategori dengan pengeluaran terbesar
            </p>
        </div>

        @if ($bulanKategoriTersedia->count())
            <form method="GET">
                <select name="bulan_kategori"
                    class="rounded-lg px-3 py-1.5 text-sm
                           bg-white dark:bg-zinc-800
                           border border-gray-300 dark:border-zinc-600
                           text-gray-900 dark:text-zinc-200
                           focus:outline-none focus:ring-2 focus:ring-blue-500"
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

            <div class="py-3 border-b border-gray-200 dark:border-zinc-700 last:border-b-0">

                <div class="flex justify-between items-center mb-1">
                    <div class="flex items-center gap-2">
                        <span class="font-medium text-gray-800 dark:text-zinc-200">
                            {{ $item->kategori->nama_kategori }}
                        </span>

                        @if ($index === 0)
                            <span class="text-xs px-2 py-0.5 rounded-full
                                         bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 font-semibold">
                                🔥 Paling Boros
                            </span>
                        @elseif ($index === 1)
                            <span class="text-xs px-2 py-0.5 rounded-full
                                         bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400">
                                🔁 Sering
                            </span>
                        @endif
                    </div>

                    <span class="text-sm font-semibold text-red-600 dark:text-red-400">
                        Rp {{ number_format($item->total_nominal, 0, ',', '.') }}
                    </span>
                </div>

                <p class="text-xs text-gray-500 dark:text-zinc-400 mb-1">
                    {{ $item->jumlah_transaksi }} transaksi • {{ $percentTotal }}%
                </p>

                <div class="w-full bg-gray-200 dark:bg-zinc-700 rounded-full h-2 overflow-hidden"
                     title="{{ $percentTotal }}% dari total pengeluaran">

                    <div class="h-2 rounded-full transition-all duration-700 ease-out
                        {{ $index === 0 
                            ? 'bg-red-500 dark:bg-red-500' 
                            : ($index === 1 ? 'bg-orange-500 dark:bg-orange-500' : 'bg-blue-500 dark:bg-blue-500') }}"
                        style="width: {{ $percentBar }}%">
                    </div>

                </div>

            </div>
        @endforeach

    @else
        <div class="text-center py-8 text-gray-400 dark:text-zinc-500 text-sm">
            <div class="text-2xl mb-2">📉</div>
            Data pengeluaran bulan ini belum tersedia.
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