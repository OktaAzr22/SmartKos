<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Bulanan</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background: #f0f0f0; }
        h2, h3 { margin: 10px 0 5px 0; }
    </style>
</head>
<body>

<h2>Rekap Bulan {{ $bulanNama }} {{ $rekap->tahun }}</h2>

{{-- Tabel Pemasukan --}}
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
                <td>{{ $p->keterangan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" align="center">Tidak ada pemasukan</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Tabel Pengeluaran --}}
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
                <td>{{ $p->keterangan }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" align="center">Tidak ada pengeluaran</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Ringkasan --}}
<h3>Ringkasan Bulanan</h3>
<table style="width:50%">
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
        <td>Rp {{ number_format($rekap->saldo_akhir, 0, ',', '.') }}</td>
    </tr>
</table>

</body>
</html>
