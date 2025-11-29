@extends('layouts.customer')

@section('title', request('category') ? ucfirst(request('category')) . ' - Ginada Florist' : 'Katalog - Ginada Florist')

@section('content')

{{-- LOGIKA TAMPILAN: CEK APAKAH SEDANG MEMILIH KATEGORI? --}}
@if(request('category'))
    
    {{-- ================================================================= --}}
    {{-- TAMPILAN KHUSUS KATEGORI (SEPERTI REFERENSI GAMBAR KE-2)          --}}
    {{-- ================================================================= --}}

    <div class="relative w-full h-[350px] overflow-hidden bg-olive">
        <div class="absolute inset-0 opacity-60">
            @if(request('category') == 'flowers')
                <img src="https://images.unsplash.com/photo-1561181286-d3fee7d55364?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover" alt="Flowers">
            @elseif(request('category') == 'leaf')
                <img src="https://images.unsplash.com/photo-1470058869958-2a77ade41c02?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover" alt="Leaf">
            @else
                {{-- Default Image (Paper/Other) --}}
                <img src="https://images.unsplash.com/photo-1606822363068-154cb438e886?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80" class="w-full h-full object-cover" alt="Other">
            @endif
        </div>
        
        <div class="absolute inset-0 bg-black/10"></div>

        <div class="absolute inset-0 flex flex-col items-center justify-center">
            <span class="text-white/80 font-bold tracking-[0.2em] text-xs uppercase mb-2">Kategori</span>
            <h1 class="text-white font-heading text-5xl md:text-6xl font-bold tracking-[0.2em] uppercase drop-shadow-md">
                {{ request('category') }}
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            
            <div class="border border-sand px-6 py-3 text-xs font-bold uppercase tracking-widest text-olive cursor-pointer hover:bg-surface transition flex items-center gap-8 bg-white">
                <span>Default Sorting</span>
                <i class="fas fa-chevron-down text-[10px]"></i>
            </div>

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
                <a href="{{ route('customer.products.index') }}" class="text-coral text-sm font-bold uppercase mt-4 inline-block hover:underline">Kembali ke Shop</a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-y-12 gap-x-8">
                @foreach($products as $product)
                    <div class="group flex flex-col">
                        <div class="relative aspect-square overflow-hidden bg-surface mb-4">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-sand/10 text-sand">
                                    <i class="fas fa-image fa-2x opacity-50"></i>
                                </div>
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
    {{-- TAMPILAN UTAMA SHOP (JIKA BELUM PILIH KATEGORI)                   --}}
    {{-- ================================================================= --}}

    <div class="bg-cream min-h-screen pb-20">
        
        <div class="pt-20 pb-12 text-center">
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-olive tracking-[0.3em] uppercase">
                S H O P
            </h1>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24 border-b border-sand/20 pb-16">
                <a href="{{ route('customer.products.index', ['category' => 'flowers']) }}" class="group block text-center cursor-pointer">
                    <div class="relative overflow-hidden aspect-[3/4] bg-surface mb-6">
                        <img src="https://images.unsplash.com/photo-1561181286-d3fee7d55364?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Flowers" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-in-out grayscale-[20%] group-hover:grayscale-0">
                    </div>
                    <h3 class="font-heading text-xl text-olive uppercase tracking-[0.2em] group-hover:text-coral transition">Flowers</h3>
                </a>
                <a href="{{ route('customer.products.index', ['category' => 'leaf']) }}" class="group block text-center cursor-pointer">
                    <div class="relative overflow-hidden aspect-[3/4] bg-surface mb-6">
                        <img src="https://images.unsplash.com/photo-1470058869958-2a77ade41c02?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Leaf" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-in-out grayscale-[20%] group-hover:grayscale-0">
                    </div>
                    <h3 class="font-heading text-xl text-olive uppercase tracking-[0.2em] group-hover:text-coral transition">Leaf</h3>
                </a>
                <a href="{{ route('customer.products.index', ['category' => 'other']) }}" class="group block text-center cursor-pointer">
                    <div class="relative overflow-hidden aspect-[3/4] bg-surface mb-6">
                        <img src="https://images.unsplash.com/photo-1606822363068-154cb438e886?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Other" class="w-full h-full object-cover group-hover:scale-105 transition duration-700 ease-in-out grayscale-[20%] group-hover:grayscale-0">
                    </div>
                    <h3 class="font-heading text-xl text-olive uppercase tracking-[0.2em] group-hover:text-coral transition">Other</h3>
                </a>
            </div>

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