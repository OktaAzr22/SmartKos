<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapKategoriPengeluaran extends Model
{
    protected $table = 'rekap_kategori_pengeluaran';
    
    protected $fillable = [
        'rekap_bulanan_id',
        'id_kategori',
        'jumlah_transaksi',
        'total_nominal',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengeluaran::class, 'id_kategori', 'id_kategori');
    }
}
