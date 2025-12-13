<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Bulanan</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
        }
        th {
            background: #f0f0f0;
            text-align: left;
        }
        h2, h3 {
            margin: 10px 0 5px 0;
        }

        .watermark {
            position: fixed;
            top: 45%;
            left: 10%;
            transform: rotate(-30deg);
            font-size: 60px;
            color: rgba(0,0,0,0.08);
            z-index: -1;
        }
    </style>
</head>
<body>

<h2>Rekap Bulan {{ $bulanNama }} {{ $rekap->tahun }}</h2>

<div class="watermark">
    {{ auth()->user()->name }}
</div>
<div class="watermark">
    {{ auth()->user()->email }} – {{ now()->format('d-m-Y') }}
</div>

<h3>Ringkasan Bulanan</h3>

<table style="width: 60%">
    <tr>
        <th>Bulan</th>
        <td>{{ $bulanNama }} {{ $rekap->tahun }}</td>
    </tr>
    <tr>
        <th>Saldo Awal</th>
        <td>Rp {{ number_format($rekap->saldo_awal, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Total Pemasukan</th>
        <td>Rp {{ number_format($rekap->total_pemasukan, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Total Pengeluaran</th>
        <td>Rp {{ number_format($rekap->total_pengeluaran, 0, ',', '.') }}</td>
    </tr>
    <tr>
        <th>Saldo Akhir</th>
        <td><strong>Rp {{ number_format($rekap->saldo_akhir, 0, ',', '.') }}</strong></td>
    </tr>
</table>

<br><br>

<p>
    Dicetak oleh: <strong>{{ $user->full_name ?? '-' }}</strong> <br>
    Tanggal cetak: {{ now()->format('d-m-Y H:i') }}
</p>

{{-- Pemasukan --}}
<h3>Pemasukan</h3>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pemasukan as $p)
            <tr>
                <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                <td>{{ $p->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" align="center">Tidak ada pemasukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Pengeluaran --}}
<h3>Pengeluaran</h3>
<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pengeluaran as $p)
            <tr>
                <td>{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                <td>Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                <td>{{ $p->kategori->nama_kategori ?? '-' }}</td>
                <td>{{ $p->keterangan ?? '-' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" align="center">Tidak ada pengeluaran</td>
            </tr>
        @endforelse
    </tbody>
</table>
</body>
</html>
