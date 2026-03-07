import Chart from 'chart.js/auto'

    let chart
    let donutChart

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

    function getTextColor() {
        return isDark() ? '#e4e4e7' : '#374151'; 
    }

    function getGridColor() {
        return isDark() ? '#3f3f46' : '#e5e7eb'; 
    }

    function getChartDensity(totalMonth) {
        if (totalMonth <= 3) return { category: 0.95, bar: 0.7, point: 5, minWidth: 500 }
        if (totalMonth <= 6) return { category: 0.9, bar: 0.65, point: 4, minWidth: 700 }
        if (totalMonth <= 9) return { category: 0.8, bar: 0.6, point: 4, minWidth: 850 }
        return { category: 0.7, bar: 0.55, point: 3, minWidth: 1000 }
    }

    function renderChart(labels, pemasukan, pengeluaran, saldo) {
        const ctx = document.getElementById('grafikBulanan')
        if (!ctx) return
        
        const dark = isDark()
        const density = getChartDensity(labels.length)
        const textColor = getTextColor()
        const gridColor = getGridColor()

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
                        backgroundColor: dark ? '#22c55e80' : '#22c55e', 
                        barPercentage: density.bar,
                        categoryPercentage: density.category,
                        borderRadius: 6
                    },
                    {
                        type: 'bar',
                        label: 'Pengeluaran',
                        data: pengeluaran,
                        backgroundColor: dark ? '#ef444480' : '#ef4444', 
                        barPercentage: density.bar,
                        categoryPercentage: density.category,
                        borderRadius: 6
                    },
                    {
                        type: 'line',
                        label: 'Saldo Akhir',
                        data: saldo,
                        borderColor: '#3b82f6',
                        backgroundColor: 'transparent',
                        tension: 0.35,
                        pointRadius: density.point,
                        pointBackgroundColor: dark ? '#3b82f6' : '#3b82f6',
                        pointBorderColor: dark ? '#e4e4e7' : '#ffffff',
                        pointBorderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                            font: { size: 12 }
                        }
                    },
                    tooltip: {
                        backgroundColor: dark ? '#18181b' : '#ffffff', 
                        titleColor: dark ? '#e4e4e7' : '#111827',
                        bodyColor: dark ? '#a1a1aa' : '#4b5563', 
                        borderColor: dark ? '#3f3f46' : '#e5e7eb', 
                        borderWidth: 1
                    }
                },
                scales: {
                    x: { 
                        grid: { color: gridColor },
                        ticks: { color: textColor }
                    },
                    y: {
                        grid: { color: gridColor },
                        ticks: {
                            color: textColor,
                            callback: v => formatRupiah(v)
                        }
                    }
                }
            }
        })
    }

    function renderDonutChart(pemasukan, pengeluaran) {
        const donutCanvas = document.getElementById('donutBulanIni')
        const donutEmpty = document.getElementById('donutEmpty')
        
        if (!donutCanvas) return

        const totalDonut = pemasukan + pengeluaran
        const dark = isDark()
        const textColor = getTextColor()

        if (donutChart) donutChart.destroy()

        if (totalDonut === 0) {
            donutCanvas.classList.add('hidden')
            donutEmpty.classList.remove('hidden')
        } else {
            donutCanvas.classList.remove('hidden')
            donutEmpty.classList.add('hidden')

            donutChart = new Chart(donutCanvas, {
                type: 'doughnut',
                data: {
                    labels: ['Pemasukan', 'Pengeluaran'],
                    datasets: [{
                        data: [pemasukan, pengeluaran],
                        backgroundColor: [
                            dark ? '#22c55e80' : '#22c55e', 
                            dark ? '#ef444480' : '#ef4444'
                        ],
                        borderColor: dark ? '#3f3f46' : '#ffffff', 
                        borderWidth: 2
                    }]
                },
                options: {
                    cutout: '65%',
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: dark ? '#18181b' : '#ffffff',
                            titleColor: dark ? '#e4e4e7' : '#111827',
                            bodyColor: dark ? '#a1a1aa' : '#4b5563',
                            borderColor: dark ? '#3f3f46' : '#e5e7eb',
                            borderWidth: 1,
                            callbacks: {
                                label: c => c.label + ': ' + formatRupiah(c.raw)
                            }
                        }
                    }
                }
            })
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const d = window.dashboardChart

        if (!d) return

        showSkeleton(true)

        setTimeout(() => {
            renderChart(d.labels, d.pemasukan, d.pengeluaran, d.saldo)
            renderDonutChart(d.pemasukanBulanIni, d.pengeluaranBulanIni)
            showSkeleton(false)
        }, 400)
    })

    tahunSelect.addEventListener('change', function () {
        showSkeleton(true)

        fetch(`${window.dashboardChart.chartUrl}?tahun=${this.value}`)
            .then(r => r.json())
            .then(d => {
                renderChart(d.labels, d.pemasukan, d.pengeluaran, d.saldoAkhir)
                renderDonutChart(d.pemasukanBulanIni, d.pengeluaranBulanIni)
                showSkeleton(false)
            })
    })

    const observer = new MutationObserver(() => {
        const d = window.dashboardChart
        if (chart) {
            renderChart(
                chart.data.labels,
                chart.data.datasets[0].data,
                chart.data.datasets[1].data,
                chart.data.datasets[2].data
            )
        }
        if (d) {
            renderDonutChart(d.pemasukanBulanIni, d.pengeluaranBulanIni)
        }
    })
    
    observer.observe(document.documentElement, { attributes: true })