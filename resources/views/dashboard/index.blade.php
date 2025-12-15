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

    {{-- ================= WRAPPER ================= --}}
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
                    Pemasukan vs Pengeluaran
                    <span class="block text-sm text-gray-500">(Bulan Ini)</span>
                </h2>

                {{-- Donut Center --}}
                <div class="flex-1 flex items-center justify-center">
                    <div class="relative w-full max-w-[200px] h-[200px]">
                        <canvas id="donutBulanIni"></canvas>
                    </div>
                </div>

                {{-- Legend --}}
                <div class="mt-4 space-y-2 text-sm">
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
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0 z-10">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['tipe' => $nextTipe, 'page' => 1]) }}">
                                Tipe
                                @if ($tipe === 'pemasukan')
                                    <i class="fas fa-arrow-up text-green-500 ml-1"></i>
                                @elseif ($tipe === 'pengeluaran')
                                    <i class="fas fa-arrow-down text-red-500 ml-1"></i>
                                @endif
                            </a>
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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

                        <td class="px-6 py-4 whitespace-nowrap">
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

    


    {{-- ================= SCRIPT ================= --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    let chart;

    function showSkeleton(show = true) {
        chartSkeleton.classList.toggle('hidden', !show);
        chartContainer.classList.toggle('hidden', show);
    }

    function formatRupiah(v) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(v);
    }

    function isDark() {
        return document.documentElement.classList.contains('dark');
    }

    function getChartDensity(totalMonth) {
        if (totalMonth <= 3) {
            return {
                category: 0.95,
                bar: 0.7,
                point: 5,
                minWidth: 500
            };
        }

        if (totalMonth <= 6) {
            return {
                category: 0.9,
                bar: 0.65,
                point: 4,
                minWidth: 700
            };
        }

        if (totalMonth <= 9) {
            return {
                category: 0.8,
                bar: 0.6,
                point: 4,
                minWidth: 850
            };
        }

        return {
            category: 0.7,
            bar: 0.55,
            point: 3,
            minWidth: 1000
        };
    }

    function renderChart(labels, pemasukan, pengeluaran, saldo) {
        const ctx = document.getElementById('grafikBulanan');
        const dark = isDark();

        const density = getChartDensity(labels.length);

        ctx.parentElement.style.minWidth = density.minWidth + 'px';

        if (chart) chart.destroy();

        chart = new Chart(ctx, {
            data: {
                labels,
                datasets: [
                    {
                        type: 'bar',
                        label: 'Pemasukan',
                        data: pemasukan,
                        backgroundColor: dark ? '#22c55e99' : '#22c55e',
                        borderRadius: 6,
                        barPercentage: density.bar,
                        categoryPercentage: density.category,
                        maxBarThickness: 34,
                    },
                    {
                        type: 'bar',
                        label: 'Pengeluaran',
                        data: pengeluaran,
                        backgroundColor: dark ? '#ef444499' : '#ef4444',
                        borderRadius: 6,
                        barPercentage: density.bar,
                        categoryPercentage: density.category,
                        maxBarThickness: 32,
                    },
                    {
                        type: 'line',
                        label: 'Saldo Akhir',
                        data: saldo,
                        borderColor: '#3b82f6',
                        tension: 0.35,
                        pointRadius: density.point,
                        pointHoverRadius: density.point + 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        labels: { color: dark ? '#e5e7eb' : '#374151' }
                    },
                    tooltip: {
                        callbacks: {
                            label: c =>
                                `${c.dataset.label}: Rp ${new Intl.NumberFormat('id-ID').format(c.raw)}`
                        }
                    }
                },
                scales: {
                    x: {
                        offset: true,
                        ticks: {
                            maxRotation: 0,
                            color: dark ? '#e5e7eb' : '#374151'
                        }
                    },
                    y: {
                        ticks: {
                            color: dark ? '#e5e7eb' : '#374151',
                            callback: v => 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
                        }
                    }
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        showSkeleton(true);

        setTimeout(() => {
            renderChart(
                @json($labels),
                @json($dataPemasukan),
                @json($dataPengeluaran),
                @json($dataSaldoAkhir)
            );
            showSkeleton(false);
        }, 400);
    });

    tahunSelect.addEventListener('change', function () {
        showSkeleton(true);
        fetch(`{{ route('dashboard.chart') }}?tahun=${this.value}`)
            .then(r => r.json())
            .then(d => {
                renderChart(d.labels, d.pemasukan, d.pengeluaran, d.saldoAkhir);
                showSkeleton(false);
            });
    });

    new MutationObserver(() => {
        if (chart) {
            renderChart(
                chart.data.labels,
                chart.data.datasets[0].data,
                chart.data.datasets[1].data,
                chart.data.datasets[2].data
            );
        }
    }).observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class']
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('donutBulanIni');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [
                        {{ $pemasukanBulanIni }},
                        {{ $pengeluaranBulanIni }}
                    ],
                    backgroundColor: ['#22c55e', '#ef4444'],
                    borderWidth: 2
                    
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: c =>
                                c.label + ': ' + formatRupiah(c.raw)
                        }
                    }
                }
            }
        });
    });
</script>



    



@endsection