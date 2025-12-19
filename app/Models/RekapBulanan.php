<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBulanan extends Model
{
    use HasFactory;

    protected $table = 'rekap_bulanan';

    protected $fillable = [
        'user_id',
        'bulan',
        'tahun',
        'total_pemasukan',
        'total_pengeluaran',
        'total_transaksi',
        'saldo_awal',
        'saldo_akhir',
        'is_printed',
        'pdf_path',
    ];

    // Formatting jika ingin tampil nama bulan
    public function getNamaBulanAttribute()
    {
        return \Carbon\Carbon::create()->month($this->bulan)->translatedFormat('F');
    }
}

