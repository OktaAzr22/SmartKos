<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UangSaku extends Model
{
    use HasFactory;

    protected $table = 'uang_saku';
    protected $primaryKey = 'id_uang_saku';
    protected $fillable = ['id_user', 'jumlah', 'keterangan'];

    public $timestamps = true;
        
    public function user()
        {
            return $this->belongsTo(User::class, 'id_user');
        }
}