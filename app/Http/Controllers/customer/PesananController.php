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
        $user = auth()->user();

        // 1. Ambil data keranjang user
        $cartItems = \App\Models\Keranjang::where('user_id', $user->id)->get();

        if($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang Anda kosong!');
        }

        // 2. Buat Pesanan (Headernya dulu)
        $kode_pesanan = 'ORD-' . strtoupper(\Illuminate\Support\Str::random(6));

        $pesanan = \App\Models\Pesanan::create([
            'user_id' => $user->id,
            'kode_pesanan' => $kode_pesanan,
            'alamat_kirim' => '-', // Nanti diisi di halaman bayar
            'status' => 'pending',
            'total_harga' => 0, // Nanti diupdate
            'ongkir' => 0
        ]);

        $totalBelanja = 0;

        // 3. Pindahkan setiap item keranjang ke DetailPemesanan & KURANGI STOK
        foreach($cartItems as $item) {
            
            // Ambil data produk terbaru
            $product = $item->product;

            // CEK STOK DULU (Penting!)
            if($product->stock < $item->qty) {
                // Batalkan pesanan jika salah satu barang habis
                $pesanan->delete(); 
                return back()->with('error', 'Stok produk ' . $product->name . ' tidak mencukupi.');
            }

            // Simpan ke Detail Pesanan
            \App\Models\DetailPemesanan::create([
                'pesanan_id' => $pesanan->id,
                'product_id' => $item->product_id,
                'jumlah' => $item->qty,
                'harga_satuan' => $item->product->price,
                'subtotal' => $item->product->price * $item->qty
            ]);

            // KURANGI STOK PRODUK
            $product->decrement('stock', $item->qty);

            $totalBelanja += ($item->product->price * $item->qty);
        }

        // 4. Update Total Harga di Pesanan
        $pesanan->update(['total_harga' => $totalBelanja]);

        // 5. HAPUS ISI KERANJANG (Karena sudah jadi pesanan)
        \App\Models\Keranjang::where('user_id', $user->id)->delete();

        // 6. Lanjut ke Pembayaran
        return redirect()->route('customer.pembayaran.create', $pesanan->id)
                         ->with('success', 'Pesanan dibuat dari keranjang!');
    }

    public function show(Pesanan $pesanan)
    {
        // KEAMANAN: Pastikan user hanya bisa melihat pesanannya sendiri
        if ($pesanan->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak melihat pesanan ini.');
        }

        return view('customer.pesanan.show', compact('pesanan'));
    }
}
