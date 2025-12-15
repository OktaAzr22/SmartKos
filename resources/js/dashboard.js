import Chart from 'chart.js/auto'

let chart

const chartSkeleton = document.getElementById('chartSkeleton')
const chartContainer = document.getElementById('chartContainer')
const tahunSelect = document.getElementById('tahunSelect')

function showSkeleton(show = true) {
    chartSkeleton.classList.toggle('hidden', !show)
    chartContainer.classList.toggle('hidden', show)
}

function formatRupiah(v) {
    return 'Rp ' + new Intl.NumberFormat('id-ID').format(v)
}

function isDark() {
    return document.documentElement.classList.contains('dark')
}

function getChartDensity(totalMonth) {
    if (totalMonth <= 3) return { category: 0.95, bar: 0.7, point: 5, minWidth: 500 }
    if (totalMonth <= 6) return { category: 0.9, bar: 0.65, point: 4, minWidth: 700 }
    if (totalMonth <= 9) return { category: 0.8, bar: 0.6, point: 4, minWidth: 850 }
    return { category: 0.7, bar: 0.55, point: 3, minWidth: 1000 }
}

function renderChart(labels, pemasukan, pengeluaran, saldo) {
    const ctx = document.getElementById('grafikBulanan')
    const dark = isDark()
    const density = getChartDensity(labels.length)

    ctx.parentElement.style.minWidth = density.minWidth + 'px'

    if (chart) chart.destroy()

    chart = new Chart(ctx, {
        data: {
            labels,
            datasets: [
                {
                    type: 'bar',
                    label: 'Pemasukan',
                    data: pemasukan,
                    backgroundColor: dark ? '#22c55e99' : '#22c55e',
                    barPercentage: density.bar,
                    categoryPercentage: density.category,
                    borderRadius: 6
                },
                {
                    type: 'bar',
                    label: 'Pengeluaran',
                    data: pengeluaran,
                    backgroundColor: dark ? '#ef444499' : '#ef4444',
                    barPercentage: density.bar,
                    categoryPercentage: density.category,
                    borderRadius: 6
                },
                {
                    type: 'line',
                    label: 'Saldo Akhir',
                    data: saldo,
                    borderColor: '#3b82f6',
                    tension: 0.35,
                    pointRadius: density.point
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            scales: {
                x: { ticks: { color: dark ? '#e5e7eb' : '#374151' } },
                y: {
                    ticks: {
                        color: dark ? '#e5e7eb' : '#374151',
                        callback: v => formatRupiah(v)
                    }
                }
            }
        }
    })
}

document.addEventListener('DOMContentLoaded', () => {
    const d = window.dashboardChart

    showSkeleton(true)

    setTimeout(() => {
        renderChart(d.labels, d.pemasukan, d.pengeluaran, d.saldo)
        showSkeleton(false)
    }, 400)

    // Donut
    new Chart(document.getElementById('donutBulanIni'), {
        type: 'doughnut',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                data: [d.pemasukanBulanIni, d.pengeluaranBulanIni],
                backgroundColor: ['#22c55e', '#ef4444']
            }]
        },
        options: {
            cutout: '65%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: c => c.label + ': ' + formatRupiah(c.raw)
                    }
                }
            }
        }
    })
})

tahunSelect.addEventListener('change', function () {
    showSkeleton(true)

    fetch(`${window.dashboardChart.chartUrl}?tahun=${this.value}`)
        .then(r => r.json())
        .then(d => {
            renderChart(d.labels, d.pemasukan, d.pengeluaran, d.saldoAkhir)
            showSkeleton(false)
        })
})

// Dark mode watcher
new MutationObserver(() => {
    const d = window.dashboardChart
    renderChart(
        chart.data.labels,
        chart.data.datasets[0].data,
        chart.data.datasets[1].data,
        chart.data.datasets[2].data
    )
}).observe(document.documentElement, { attributes: true })
