<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;

    // Tambahkan 'user_id' ke fillable
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tanggal_lahir',
        'jenis_kelamin',
        'kelas',
        'status_aktif',
    ];

    /**
     * Mendefinisikan bahwa Penerima ini milik satu User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relasi yang sudah ada
    public function kodeAkses()
    {
        return $this->hasOne(KodeAkses::class);
    }
}
