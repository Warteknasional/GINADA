<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\DetailPemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with('detail.product','pembayaran')->where('user_id', auth()->id())->latest()->get();
        return view('customer.pesanan.index', compact('pesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat_kirim' => 'required|string',
            'produk_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $pesanan = Pesanan::create([
            'user_id' => auth()->id(),
            'kode_pesanan' => 'ORD-' . Str::upper(Str::random(6)),
            'alamat_kirim' => $request->alamat_kirim,
            'status' => 'pending',
            'total_harga' => 0,
            'ongkir' => 0
        ]);

        $product = Product::findOrFail($request->produk_id);

        DetailPemesanan::create([
            'pesanan_id' => $pesanan->id,
            'product_id' => $product->id,
            'jumlah' => $request->qty,
            'harga_satuan' => $product->price,
            'subtotal' => $product->price * $request->qty
        ]);

        $pesanan->update(['total_harga' => $pesanan->detail->sum('subtotal')]);

        return redirect()->route('customer.pesanan.index')->with('success','Pesanan berhasil dibuat');
    }
}
