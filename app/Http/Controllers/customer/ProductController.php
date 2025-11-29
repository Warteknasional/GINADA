<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
// BARIS INI YANG TADI KURANG:
use Illuminate\Http\Request; 

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar: hanya tampilkan yang stoknya ada
        $query = Product::where('stock', '>', 0);

        // 1. Logika Search (Pencarian Nama)
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // 2. Logika Filter Kategori
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Ambil data (12 per halaman)
        $products = $query->latest()->paginate(12);
        
        return view('customer.products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('customer.products.show', compact('product'));
    }
}