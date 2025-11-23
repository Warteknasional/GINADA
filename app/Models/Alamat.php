<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';

    protected $fillable = [
        'user_id',
        'judul',
        'penerima',
        'no_hp',
        'alamat_lengkap',
        'kota',
        'provinsi',
        'kode_pos',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
