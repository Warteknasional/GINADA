@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg p-8 mb-8 text-white">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
        <p class="text-blue-100">Temukan produk terbaik untuk kebutuhan Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Total Pesanan</p>
                    <p class="text-2xl font-bold text-blue-600">{{ auth()->user()->pesanan()->count() }}</p>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Pesanan Aktif</p>
                    <p class="text-2xl font-bold text-green-600">{{ auth()->user()->pesanan()->whereNotIn('status', ['selesai', 'dibatalkan'])->count() }}</p>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-clock text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm mb-1">Alamat Tersimpan</p>
                    <p class="text-2xl font-bold text-purple-600">{{ auth()->user()->alamat()->count() }}</p>
                </div>
                <div class="bg-purple-100 rounded-full p-3">
                    <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Terbaru -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-900">Produk Terbaru</h2>
            <a href="{{ route('customer.products.index') }}" class="text-blue-600 hover:text-blue-800">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @foreach(\App\Models\Product::where('stock', '>', 0)->latest()->take(4)->get() as $product)
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
                    <p class="text-blue-600 font-bold text-xl mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <a href="{{ route('customer.products.show', $product) }}" class="block w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-2 rounded transition duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Pesanan Terbaru -->
    @if(auth()->user()->pesanan()->exists())
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900">Pesanan Terbaru</h2>
            <a href="{{ route('customer.pesanan.index') }}" class="text-blue-600 hover:text-blue-800">
                Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="space-y-3">
            @foreach(auth()->user()->pesanan()->latest()->take(3)->get() as $pesanan)
            <div class="flex justify-between items-center border-b pb-3 last:border-b-0">
                <div>
                    <p class="font-medium">{{ $pesanan->kode_pesanan }}</p>
                    <p class="text-sm text-gray-600">{{ $pesanan->created_at->format('d M Y') }}</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-blue-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
                    <span class="text-xs px-2 py-1 rounded 
                        @if($pesanan->status == 'selesai') bg-green-100 text-green-800
                        @elseif($pesanan->status == 'dibatalkan') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800
                        @endif">
                        {{ ucfirst($pesanan->status) }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection