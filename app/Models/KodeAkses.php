<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeAkses extends Model
{
    use HasFactory;
    
    protected $table = 'kode_akses';

    protected $fillable = [
        'penerima_id',
        'kode',
        'status_kelulusan', // <-- DITAMBAHKAN
        'tanggal_kadaluarsa',
    ];

    public function penerima()
    {
        return $this->belongsTo(Penerima::class);
    }
}
