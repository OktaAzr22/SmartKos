<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoUser extends Model
{
    use HasFactory;

    protected $table = 'saldo_user';
    protected $primaryKey = 'id_saldo';
    protected $fillable = [
        'id_user', 'saldo_awal', 'saldo_sekarang', 'bulan', 'tahun'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

