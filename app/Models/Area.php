<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $table = 'area';

    protected $fillable = [
        'nama_area',
        'ongkir',
        'estimasi', // <--- TAMBAHKAN INI
        'catatan',
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
