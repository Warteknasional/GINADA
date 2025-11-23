<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return view('admin.pesanan.index', [
            'pesanan' => Pesanan::with('user', 'area')->latest()->paginate(10)
        ]);
    }

    public function show(Pesanan $pesanan)
    {
        return view('admin.pesanan.show', [
            'pesanan' => $pesanan->load('detail.product', 'pembayaran', 'penjadwalan')
        ]);
    }

    public function updateStatus(Request $request, Pesanan $pesanan)
    {
        $request->validate(['status' => 'required|in:pending,diproses,siap,dikirim,selesai,dibatalkan']);
        $pesanan->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan diperbarui');
    }
}
