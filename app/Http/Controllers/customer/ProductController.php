<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category; // <--- 1. Tambahkan Import ini
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // ... (Query produk yang sudah ada biarkan saja) ...
        $query = Product::where('stock', '>', 0);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $products = $query->latest()->paginate(12);

        // 2. AMBIL SEMUA KATEGORI DARI DATABASE
        $categories = Category::all();
        
        // 3. Kirim variabel $categories ke view
        return view('customer.products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        return view('customer.products.show', compact('product'));
    }
}