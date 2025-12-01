@extends('layouts.customer')

@section('title', request('category') ? ucfirst(request('category')) . ' - Ginada Florist' : 'Katalog - Ginada Florist')

@section('content')

{{-- ================================================================= --}}
{{-- 1. TAMPILAN DETAIL KATEGORI (JIKA USER MEMILIH KATEGORI)          --}}
{{-- ================================================================= --}}
@if(request('category'))
    
    <div class="relative w-full h-[350px] overflow-hidden bg-olive">
        <div class="absolute inset-0 opacity-60">
            @php
                $catSlug = request('category');
                // Cari data kategori berdasarkan slug dari koleksi $categories yang dikirim controller
                // (Ini opsional agar banner atas juga dinamis)
                $currentCat = $categories->where('slug', $catSlug)->first();
            @endphp

            @if($currentCat && $currentCat->image)
                <img src="{{ asset('storage/' . $currentCat->image) }}" alt="{{ $catSlug }}" class="w-full h-full object-cover">
            @else
                @php
                    $bgImage = 'https://images.unsplash.com/photo-1606822363068-154cb438e886?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';
                    if(stripos($catSlug, 'flower') !== false || stripos($catSlug, 'bunga') !== false) {
                        $bgImage = 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';
                    } elseif(stripos($catSlug, 'leaf') !== false || stripos($catSlug, 'daun') !== false) {
                        $bgImage = 'https://images.unsplash.com/photo-1470058869958-2a77ade41c02?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80';
                    }
                @endphp
                <img src="{{ $bgImage }}" class="w-full h-full object-cover" alt="{{ $catSlug }}">
            @endif
        </div>
        
        <div class="absolute inset-0 bg-black/20"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="text-white/80 font-bold tracking-[0.2em] text-xs uppercase mb-2">Kategori</span>
            <h1 class="text-white font-heading text-5xl md:text-6xl font-bold tracking-[0.2em] uppercase drop-shadow-md">
                {{ isset($currentCat) ? $currentCat->name : $catSlug }}
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <a href="{{ route('customer.products.index') }}" class="text-xs font-bold uppercase tracking-widest text-olive hover:text-coral transition flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Semua Produk
            </a>
            <div class="text-taupe text-sm italic font-body">
                Showing 1–{{ $products->count() }} of {{ $products->total() }} results
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        @if($products->isEmpty())
            <div class="text-center py-20 border-2 border-dashed border-sand/30 rounded-lg">
                <i class="fas fa-search text-sand text-4xl mb-4 opacity-50"></i>
                <p class="text-olive font-heading text-lg italic">Maaf, belum ada produk di kategori ini.</p>
                <a href="{{ route('customer.products.index') }}" class="text-coral text-sm font-bold uppercase mt-4 inline-block hover:underline">Lihat Semua Produk</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-12 gap-x-8">
                @foreach($products as $product)
                    <div class="group flex flex-col">
                        <div class="relative aspect-square overflow-hidden bg-surface mb-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-sand/10 text-sand"><i class="fas fa-image fa-2x opacity-50"></i></div>
                            @endif

                            @if($product->stock < 5)
                                <span class="absolute top-2 left-2 bg-coral text-white text-[10px] font-bold px-2 py-1 uppercase tracking-widest">Limited</span>
                            @endif
                            
                            <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                <a href="{{ route('customer.products.show', $product) }}" class="block w-full bg-white/90 backdrop-blur text-olive text-center py-3 text-xs font-bold uppercase tracking-widest hover:bg-olive hover:text-white transition">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-heading text-lg text-olive mb-1 group-hover:text-coral transition cursor-pointer">
                                <a href="{{ route('customer.products.show', $product) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-taupe text-sm mb-2 font-bold">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-20 flex justify-center">
                {{ $products->appends(['category' => request('category')])->links() }}
            </div>
        @endif
    </div>

@else

    {{-- ================================================================= --}}
    {{-- 2. TAMPILAN UTAMA SHOP (GRID KATEGORI + SEMUA PRODUK)             --}}
    {{-- ================================================================= --}}

    <div class="bg-cream min-h-screen pb-20">
        
        <div class="pt-20 pb-12 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-olive tracking-[0.3em] uppercase">
                S H O P
            </h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(isset($categories) && count($categories) > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24 border-b border-sand/20 pb-16">
                    @foreach($categories as $category)
                        <a href="{{ route('customer.products.index', ['category' => $category->slug]) }}" class="group block text-center cursor-pointer">
                            <div class="relative overflow-hidden aspect-[3/4] bg-surface mb-6">
                                
                                {{-- LOGIKA GAMBAR KATEGORI --}}
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" 
                                         alt="{{ $category->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-in-out grayscale-[20%] group-hover:grayscale-0">
                                @else
                                    @php
                                        $imgUrl = 'https://images.unsplash.com/photo-1606822363068-154cb438e886?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                                        
                                        if(stripos($category->slug, 'flower') !== false || stripos($category->slug, 'bunga') !== false) {
                                            $imgUrl = 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                                        } elseif(stripos($category->slug, 'leaf') !== false || stripos($category->slug, 'daun') !== false) {
                                            $imgUrl = 'https://images.unsplash.com/photo-1470058869958-2a77ade41c02?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80';
                                        }
                                    @endphp

                                    <img src="{{ $imgUrl }}" 
                                         alt="{{ $category->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-in-out grayscale-[20%] group-hover:grayscale-0">
                                @endif

                            </div>
                            <h3 class="font-heading text-xl text-olive uppercase tracking-[0.2em] group-hover:text-coral transition">
                                {{ $category->name }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            @endif

            <div class="mb-12">
                <span class="text-coral font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Katalog</span>
                <h2 class="font-heading text-3xl font-bold text-olive">Produk Terbaru</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-12 gap-x-8">
                @foreach($products as $product)
                    <div class="group flex flex-col">
                        <div class="relative aspect-square overflow-hidden bg-surface mb-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-sand/10 text-sand"><i class="fas fa-image fa-2x opacity-50"></i></div>
                            @endif
                            <div class="absolute inset-x-0 bottom-0 p-4 opacity-0 group-hover:opacity-100 transition duration-300">
                                <a href="{{ route('customer.products.show', $product) }}" class="block w-full bg-white/90 backdrop-blur text-olive text-center py-3 text-xs font-bold uppercase tracking-widest hover:bg-olive hover:text-white transition">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="text-center">
                            <h3 class="font-heading text-lg text-olive mb-1 group-hover:text-coral transition"><a href="{{ route('customer.products.show', $product) }}">{{ $product->name }}</a></h3>
                            <p class="text-taupe text-sm mb-2 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-20 flex justify-center">{{ $products->links() }}</div>

        </div>
    </div>

@endif

@endsection