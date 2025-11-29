<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Keranjang;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // 1. TAMPILKAN ISI KERANJANG
    public function index()
    {
        $cartItems = Keranjang::with('product')->where('user_id', Auth::id())->get();

        // Hitung total belanja
        $total = 0;
        foreach($cartItems as $item) {
            $total += $item->product->price * $item->qty;
        }

        return view('customer.keranjang.index', compact('cartItems', 'total'));
    }

    // 2. TAMBAH KE KERANJANG
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek apakah produk sudah ada di keranjang user ini?
        $existingItem = Keranjang::where('user_id', Auth::id())
                                ->where('product_id', $product->id)
                                ->first();

        if ($existingItem) {
            // Jika sudah ada, tambahkan jumlahnya saja
            $existingItem->qty += $request->qty;
            $existingItem->save();
        } else {
            // Jika belum ada, buat baru
            Keranjang::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'qty' => $request->qty
            ]);
        }

        return redirect()->route('customer.keranjang.index')->with('success', 'Produk masuk keranjang!');
    }

    // 3. HAPUS ITEM DARI KERANJANG
    public function destroy($id)
    {
        $item = Keranjang::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $item->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }
}