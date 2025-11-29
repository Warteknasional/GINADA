@extends('layouts.customer')

@section('title', $product->name . ' - Ginada Florist')

@section('content')

<div class="bg-cream min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <a href="{{ route('customer.products.index') }}" class="inline-flex items-center gap-2 text-taupe hover:text-coral transition font-bold text-xs uppercase tracking-widest group">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali ke Katalog</span>
            </a>
        </div>

        <div class="bg-surface border border-sand/20 shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2">
                
                <div class="relative h-[400px] md:h-[600px] bg-white flex items-center justify-center overflow-hidden border-b md:border-b-0 md:border-r border-sand/20 group">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-1000">
                    @else
                        <div class="text-sand flex flex-col items-center">
                            <i class="fas fa-image fa-4x mb-2 opacity-50"></i>
                            <span class="text-xs uppercase tracking-widest">No Image</span>
                        </div>
                    @endif

                    @if($product->stock < 5)
                        <span class="absolute top-6 left-6 bg-coral text-white text-xs font-bold px-3 py-1 uppercase tracking-widest shadow-md">
                            Stok Terbatas: {{ $product->stock }}
                        </span>
                    @endif
                </div>

                <div class="p-8 md:p-12 flex flex-col justify-center">
                    
                    <div class="mb-4">
                        <span class="inline-block bg-leaf/20 text-olive px-3 py-1 text-[10px] font-bold uppercase tracking-[0.2em] rounded-sm">
                            {{ $product->category->name ?? 'FLORAL' }}
                        </span>
                    </div>

                    <h1 class="font-heading text-4xl md:text-5xl font-bold text-olive mb-4 leading-tight">
                        {{ $product->name }}
                    </h1>

                    <p class="text-3xl text-coral font-bold mb-6 font-heading">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>

                    <div class="prose prose-sm text-taupe mb-8 leading-relaxed border-l-2 border-sand/30 pl-4">
                        <p>{{ $product->description }}</p>
                    </div>

                    <form action="{{ route('customer.keranjang.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    
                    <div class="mb-8">
                        <label for="qty" class="block text-xs font-bold text-olive uppercase tracking-widest mb-3">
                            Jumlah
                        </label>
                        <div class="flex items-center w-32 border border-sand">
                            <input type="number" name="qty" id="qty" value="1" min="1" max="{{ $product->stock }}" 
                                class="w-full text-center py-3 bg-cream text-olive font-bold focus:outline-none focus:bg-white transition">
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-olive text-white py-4 font-bold uppercase tracking-[0.2em] text-sm hover:bg-coral transition duration-300 shadow-lg flex items-center justify-center gap-3">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Masukkan Keranjang</span>
                    </button>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection