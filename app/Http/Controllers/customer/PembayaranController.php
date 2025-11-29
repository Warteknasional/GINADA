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
        // Ambil semua data wilayah dan harganya dari database
        // Ambil semua kota, urutkan abjad, dan sertakan info areanya
        $cities = \App\Models\City::with('area')->orderBy('name')->get();
        
        return view('customer.pembayaran.create', compact('pesanan', 'cities'));
    }

    public function store(Request $request, Pesanan $pesanan)
    {
        // 1. VALIDASI (Sesuaikan nama dengan form di create.blade.php)
        $request->validate([
            'city_id'       => 'required|exists:cities,id', // Tangkap ID Kota
            'alamat_detail' => 'required|string|min:5',     // Tangkap Alamat Detail
            'bukti'         => 'required|image|max:10240'   // Maks 10MB
        ]);

        // 2. AMBIL DATA KOTA & AREA
        // Kita cari kota yang dipilih user, lalu ambil harga ongkir dari areanya
        $city = \App\Models\City::with('area')->findOrFail($request->city_id);
        
        $ongkir = $city->area->ongkir; // Ambil harga ongkir
        
        // 3. GABUNGKAN ALAMAT (Untuk disimpan di database)
        // Format: "Jalan Mawar No 12, Kec. Batu (Area Dekat)"
        $alamatLengkap = $request->alamat_detail . ', ' . $city->name . ' (' . $city->area->nama_area . ')';

        // 4. HITUNG TOTAL AKHIR
        $subtotalProduk = $pesanan->detail->sum('subtotal');
        $grandTotal = $subtotalProduk + $ongkir;

        // 5. SIMPAN BUKTI TRANSFER
        $path = $request->file('bukti')->store('bukti_pembayaran', 'public');

        // 6. UPDATE PESANAN
        // Kita simpan alamat lengkap yang sudah digabung tadi ke kolom 'alamat_kirim'
        $pesanan->update([
            'alamat_kirim' => $alamatLengkap, 
            'ongkir'       => $ongkir,
            'total_harga'  => $grandTotal,
            'status'       => 'dibayar'
        ]);

        // 7. BUAT DATA PEMBAYARAN
        Pembayaran::create([
            'pesanan_id'   => $pesanan->id,
            'jumlah_bayar' => $grandTotal,
            'metode'       => 'transfer',
            'status'       => 'pending',
            'bukti_bayar'  => $path
        ]);

        return redirect()->route('customer.pesanan.index')
                         ->with('success', 'Pembayaran berhasil dikirim! Mohon tunggu konfirmasi admin.');
    }
}
