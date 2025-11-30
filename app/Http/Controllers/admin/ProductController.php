<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::with('category')->latest()->paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.products.create', ['categories' => Category::all()]);
    }

    // === PERBAIKAN UTAMA DI SINI (STORE) ===
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            // GANTI 'string' JADI 'image'
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        $data = $request->all();

        // LOGIKA UPLOAD GAMBAR
        if ($request->hasFile('image')) {
            // Simpan gambar ke folder 'public/flowers'
            $path = $request->file('image')->store('flowers', 'public');
            // Simpan alamatnya (path) ke database
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    // === PERBAIKAN DI SINI JUGA (UPDATE) ===
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $data = $request->all();

        // Cek jika user mengupload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama agar tidak menuh-menuhin server
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload gambar baru
            $path = $request->file('image')->store('flowers', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success','Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        // Hapus gambar saat produk dihapus
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();
        return back()->with('success','Produk berhasil dihapus');
    }
}