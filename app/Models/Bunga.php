<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bunga extends Model
{
    use HasFactory;
    
    protected $table= 'bunga';

    protected $primaryKey = 'id_bunga';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_bunga',
        'nama',
        'kategori',
        'stok',
        'harga'
    ];

    /**
     * Get the orders for the flower.
     */
    public function pesanan(): HasMany
    {
        return $this->hasMany(Pesanan::class, 'id_bunga', 'id_bunga');
    }

    /**
     * Get the schedules for the flower.
     */
    public function penjadwalan(): HasMany
    {
        return $this->hasMany(Penjadwalan::class, 'id_bunga', 'id_bunga');
    }

}
