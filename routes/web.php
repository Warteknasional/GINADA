<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Import Controller Customer
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\PesananController;
use App\Http\Controllers\Customer\PembayaranController;
use App\Http\Controllers\Customer\KeranjangController;

// Import Controller Admin
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\PesananController as AdminPesananController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;
use App\Http\Controllers\Admin\PenjadwalanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// === PERBAIKAN LOGIC HALAMAN UTAMA ===
// Saat buka website, langsung lempar ke halaman Login
Route::get('/', function () {
    return redirect()->route('login'); 
});

// Dashboard (Halaman setelah login)
Route::get('/dashboard', function () {
    return view('customer.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route Profile (Bawaan Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| GROUP ROUTE CUSTOMER (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    
    // Produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

    // Kontak
    Route::get('/kontak', function () {
        return view('customer.contact.index');
    })->name('contact');

    // Keranjang
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
    Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
    Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');

    // Pembayaran
    Route::get('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'create'])->name('pembayaran.create');
    Route::post('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'store'])->name('pembayaran.store');
});


/*
|--------------------------------------------------------------------------
| GROUP ROUTE ADMIN (Khusus Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
        
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::resource('products', AdminProductController::class);

    // Kategori
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);

    // Area Ongkir
    Route::resource('area', AreaController::class);

    // Pesanan & Laporan
    Route::get('/pesanan/export', [AdminPesananController::class, 'export'])->name('pesanan.export');
    Route::get('/pesanan/pdf', [AdminPesananController::class, 'cetakPDF'])->name('pesanan.pdf'); // Tambahan PDF
    
    Route::get('/pesanan', [AdminPesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanan/{pesanan}', [AdminPesananController::class, 'show'])->name('pesanan.show');
    Route::patch('/pesanan/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('pesanan.update-status');

    // Pembayaran
    Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])->name('pembayaran.index');
    Route::patch('/pembayaran/{pembayaran}/konfirmasi', [AdminPembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');

    // Penjadwalan (Opsional)
    Route::resource('penjadwalan', PenjadwalanController::class);
});

// Load Route Auth Breeze
require __DIR__.'/auth.php';