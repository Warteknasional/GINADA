<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    // Agar bisa diisi massal
    protected $guarded = [];

    // Relasi: Kota milik Area
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
}