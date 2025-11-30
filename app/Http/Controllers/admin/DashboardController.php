<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung Total Pendapatan (Status selesai/dikirim/diproses/dibayar)
        // Kita anggap uang masuk kalau statusnya bukan 'pending' atau 'batal'
        $totalPendapatan = Pesanan::whereNotIn('status', ['pending', 'dibatalkan'])->sum('total_harga');

        // 2. Hitung Pesanan Baru (Yang perlu diproses admin)
        $pesananBaru = Pesanan::where('status', 'dibayar')->count();

        // 3. Hitung Total Produk Bunga
        $totalProduk = Product::count();

        // 4. Hitung Total Pelanggan (User dengan role customer)
        $totalUser = User::where('role', 'customer')->count();

        // 5. Ambil 5 Pesanan Terbaru untuk ditampilkan di tabel
        $latestOrders = Pesanan::with('user')->latest()->take(5)->get();

        return view('admin.dashboard.index', compact('totalPendapatan', 'pesananBaru', 'totalProduk', 'totalUser', 'latestOrders'));
    }
}