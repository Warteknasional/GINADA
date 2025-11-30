<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pesanan extends Model
{
    use HasFactory;

    // WAJIB ADA: Karena nama tabel di migrasi adalah 'pesanan' (bukan pesanans)
    protected $table = 'pesanan';

    protected $fillable = [
        'user_id',
        'kode_pesanan',
        'total_harga',
        'ongkir',
        'status',
        'alamat_kirim',
        'tanggal_pengiriman', // <--- Tambah
        'waktu_pengiriman',   // <--- Tambah
        'catatan',
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

}