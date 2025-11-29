@extends('layouts.customer')

@section('title', 'Keranjang Belanja - Ginada Florist')

@section('content')

<div class="bg-cream min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h1 class="font-heading text-3xl md:text-4xl font-bold text-olive mb-8">Keranjang Belanja</h1>

        @if($cartItems->isEmpty())
            <div class="bg-surface border border-dashed border-sand/30 rounded-lg p-16 text-center">
                <i class="fas fa-shopping-basket text-4xl text-sand mb-4"></i>
                <p class="text-taupe text-lg mb-6">Keranjang Anda masih kosong.</p>
                <a href="{{ route('customer.products.index') }}" class="inline-block bg-coral text-white px-8 py-3 rounded-full font-bold uppercase text-xs tracking-widest hover:bg-olive transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                
                <div class="lg:col-span-2 space-y-6">
                    @foreach($cartItems as $item)
                        <div class="bg-surface border border-sand/20 p-4 flex gap-4 items-center shadow-sm relative group">
                            <div class="w-24 h-24 bg-white flex-shrink-0 overflow-hidden">
                                <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                            </div>
                            
                            <div class="flex-grow">
                                <h3 class="font-heading text-lg text-olive font-bold">{{ $item->product->name }}</h3>
                                <p class="text-taupe text-sm mb-2">Harga: Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                
                                <div class="flex items-center gap-4">
                                    <span class="text-xs font-bold uppercase text-sand tracking-widest">Qty: {{ $item->qty }}</span>
                                    <span class="text-olive font-bold">Total: Rp {{ number_format($item->product->price * $item->qty, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <form action="{{ route('customer.keranjang.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sand hover:text-coral transition p-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white p-8 border border-sand/20 sticky top-28 shadow-lg">
                        <h3 class="font-heading text-xl font-bold text-olive mb-6">Ringkasan Pesanan</h3>
                        
                        <div class="flex justify-between items-center mb-4 text-taupe">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-6 text-taupe">
                            <span>Ongkir</span>
                            <span class="text-xs italic">(Dihitung selanjutnya)</span>
                        </div>
                        
                        <div class="border-t border-sand/20 pt-4 flex justify-between items-center mb-8">
                            <span class="font-bold text-olive text-lg">Total</span>
                            <span class="font-bold text-coral text-xl">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('customer.pesanan.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="from_cart" value="true">
                            <button type="submit" class="w-full bg-olive text-white py-4 font-bold uppercase tracking-widest text-xs hover:bg-coral transition shadow-md">
                                Checkout Sekarang
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @endif
    </div>
</div>

@endsection