<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('customer.products.index', [
            'products' => Product::where('stock','>',0)->latest()->paginate(12)
        ]);
    }

    public function show(Product $product)
    {
        return view('customer.products.show', compact('product'));
    }
}
