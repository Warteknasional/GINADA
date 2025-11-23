<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
        'pesanan_id',
        'jumlah_bayar',
        'metode',
        'status',
        'bukti_bayar',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
