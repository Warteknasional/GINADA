<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function create(Pesanan $pesanan)
    {
        return view('customer.pembayaran.create', compact('pesanan'));
    }

    public function store(Request $request, Pesanan $pesanan)
    {
        $request->validate([
            'bukti' => 'required|image|max:2048'
        ]);

        $path = $request->file('bukti')->store('bukti_pembayaran','public');

        Pembayaran::create([
            'pesanan_id' => $pesanan->id,
            'jumlah_bayar' => $pesanan->total_harga,
            'metode' => 'transfer',
            'status' => 'pending',
            'bukti_bayar' => $path
        ]);

        return redirect()->route('customer.pesanan.index')->with('success','Pembayaran terkirim');
    }
}
