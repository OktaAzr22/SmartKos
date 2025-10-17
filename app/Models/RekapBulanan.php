<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapBulanan extends Model
{
    use HasFactory;

    protected $table = 'rekap_bulanan';
    protected $primaryKey = 'id_rekap';
    protected $fillable = [
        'id_user', 'bulan', 'tahun', 'total_pemasukan', 'total_pengeluaran', 'saldo_akhir', 'tanggal_rekap'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

