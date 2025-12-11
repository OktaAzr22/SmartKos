<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';

    protected $fillable = [
        'user_id',
        'id_kategori',
        'jumlah',
        'keterangan',
        'tanggal',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPengeluaran::class, 'id_kategori', 'id_kategori');
    }

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

