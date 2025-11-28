@extends('layouts.customer')

@section('title', 'Daftar Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Produk Kami</h1>
        <p class="text-gray-600 mt-2">Temukan produk terbaik untuk Anda</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
            <div class="h-48 bg-gray-200 flex items-center justify-center">
                @if($product->image)
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                @else
                    <i class="fas fa-image text-gray-400 text-4xl"></i>
                @endif
            </div>
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2 truncate">{{ $product->name }}</h3>
                <p class="text-gray-600 text-sm mb-2">{{ $product->category->name }}</p>
                <div class="flex justify-between items-center mb-3">
                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                </div>
                <a href="{{ route('customer.products.show', $product) }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded transition duration-300">
                    <i class="fas fa-eye mr-2"></i>Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg">Belum ada produk tersedia</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection