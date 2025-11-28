@extends('layouts.customer')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('customer.products.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Produk
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2 bg-gray-200 flex items-center justify-center p-8">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-h-96 object-contain">
                @else
                    <i class="fas fa-image text-gray-400 text-9xl"></i>
                @endif
            </div>
            <div class="md:w-1/2 p-8">
                <div class="mb-4">
                    <span class="inline-block bg-blue-100 text-blue-800 text-sm px-3 py-1 rounded">
                        {{ $product->category->name }}
                    </span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $product->name }}</h1>
                <div class="mb-6">
                    <span class="text-4xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div class="mb-6">
                    <p class="text-gray-600 mb-2">Stok Tersedia: 
                        <span class="font-semibold {{ $product->stock > 10 ? 'text-green-600' : ($product->stock > 0 ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $product->stock }}
                        </span>
                    </p>
                </div>

                @if($product->description)
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-2">Deskripsi</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                </div>
                @endif

                @if($product->stock > 0)
                <form action="{{ route('customer.pesanan.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $product->id }}">
                    
                    <div>
                        <label for="qty" class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                        <input type="number" name="qty" id="qty" value="1" min="1" max="{{ $product->stock }}" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label for="alamat_kirim" class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman</label>
                        <textarea name="alamat_kirim" id="alamat_kirim" rows="3" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 rounded-md transition duration-300">
                        <i class="fas fa-shopping-cart mr-2"></i>Buat Pesanan
                    </button>
                </form>
                @else
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
                    <i class="fas fa-exclamation-circle mr-2"></i>Produk ini sedang habis
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection