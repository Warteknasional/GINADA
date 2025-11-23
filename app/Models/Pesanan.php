<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'area_id',
        'kode_pesanan',
        'total_harga',
        'ongkir',
        'status',
        'catatan',
        'alamat_kirim',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailPemesanan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class);
    }
}
