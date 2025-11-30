<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// --- IMPORT CONTROLLER CUSTOMER (Singkat) ---
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\PesananController;
use App\Http\Controllers\Customer\PembayaranController;
use App\Http\Controllers\Customer\KeranjangController;

// Catatan: Controller Admin tidak di-import di sini agar tidak bentrok nama.
// Kita panggil Controller Admin menggunakan nama lengkap (Full Path) di bawah.

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Utama (Bisa diakses siapa saja)
Route::get('/', function () {
    return view('welcome'); 
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
| GROUP ROUTE (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // ====================================================
    // 1. ROUTE CUSTOMER (Toko Online)
    // ====================================================
    Route::prefix('customer')->name('customer.')->group(function () {
        
        // Produk (Katalog & Detail)
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

        // Kontak
        Route::get('/kontak', function () {
            return view('customer.contact.index');
        })->name('contact');

        // Keranjang Belanja
        Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
        Route::delete('/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

        // Pesanan Saya
        Route::get('/pesanan', [PesananController::class, 'index'])->name('pesanan.index');
        Route::post('/pesanan', [PesananController::class, 'store'])->name('pesanan.store');
        Route::get('/pesanan/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');

        // Pembayaran
        Route::get('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'create'])->name('pembayaran.create');
        Route::post('/pesanan/{pesanan}/bayar', [PembayaranController::class, 'store'])->name('pembayaran.store');
    });


    // ====================================================
    // 2. ROUTE ADMIN (Panel Pengelola)
    // ====================================================
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
            
        // Dashboard Admin
        Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

        // Produk (CRUD Lengkap)
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);

        // Kategori
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['create', 'edit', 'show']);

        // Area Ongkir
        Route::resource('area', \App\Http\Controllers\Admin\AreaController::class);

        // Pesanan (Kelola Order)
        Route::get('/pesanan', [\App\Http\Controllers\Admin\PesananController::class, 'index'])->name('pesanan.index');
        Route::get('/pesanan/{pesanan}', [\App\Http\Controllers\Admin\PesananController::class, 'show'])->name('pesanan.show');
        Route::patch('/pesanan/{pesanan}/status', [\App\Http\Controllers\Admin\PesananController::class, 'updateStatus'])->name('pesanan.update-status');

        // Pembayaran (Konfirmasi Transfer)
        Route::get('/pembayaran', [\App\Http\Controllers\Admin\PembayaranController::class, 'index'])->name('pembayaran.index');
        Route::patch('/pembayaran/{pembayaran}/konfirmasi', [\App\Http\Controllers\Admin\PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');

        // Penjadwalan
        Route::resource('penjadwalan', \App\Http\Controllers\Admin\PenjadwalanController::class);

        Route::get('/pesanan/export', [\App\Http\Controllers\Admin\PesananController::class, 'export'])->name('pesanan.export');
        Route::get('/pesanan', [\App\Http\Controllers\Admin\PesananController::class, 'index'])->name('pesanan.index');

        // CETAK PDF (BARU)
        Route::get('/pesanan/pdf', [\App\Http\Controllers\Admin\PesananController::class, 'cetakPDF'])->name('pesanan.pdf');
    });

});

// Load Route Auth Breeze (Login, Register, dll)
require __DIR__.'/auth.php';