<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;

class PembayaranController extends Controller
{
    public function index()
    {
        return view('admin.pembayaran.index', [
            'pembayaran' => Pembayaran::with('pesanan.user')->latest()->paginate(10)
        ]);
    }

    public function konfirmasi(Pembayaran $pembayaran)
    {
        $pembayaran->update(['status' => 'confirmed']);
        return back()->with('success', 'Pembayaran dikonfirmasi');
    }
}
