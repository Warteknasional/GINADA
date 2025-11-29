<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\AlamatController;
use App\Http\Controllers\Customer\PesananController;
use App\Http\Controllers\Customer\PembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama (Bisa diakses siapa saja)
Route::get('/', function () {
    // Bisa diganti ke [ProductController::class, 'index'] kalau mau langsung list produk
    return view('welcome'); 
});

// Dashboard (Halaman setelah login bawaan Breeze)
Route::get('/dashboard', function () {
    return view('customer.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ROUTE CUSTOMER (TOKO ONLINE KITA) ---
Route::middleware(['auth'])->group(function () {

    Route::prefix('customer')->name('customer.')->group(function () {
    
    // Ini akan memanggil ProductController@index
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    
    // Ini akan memanggil ProductController@show
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

        // Route Kontak (Halaman Statis)
        Route::get('/kontak', function () {
            return view('customer.contact.index');
        })->name('contact');

        // Alamat (CRUD)
        Route::resource('alamat', AlamatController::class);

        // Pesanan
        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
        Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');

        // Pembayaran
        Route::get('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'store'])->name('pembayaran.store');

        // ROUTE KERANJANG BARU
        Route::get('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang', [\App\Http\Controllers\Customer\KeranjangController::class, 'store'])->name('keranjang.store');
        Route::delete('/keranjang/{id}', [\App\Http\Controllers\Customer\KeranjangController::class, 'destroy'])->name('keranjang.destroy');
    });

});

// Load Route Auth Breeze (Login, Register, dll)
require __DIR__.'/auth.php';