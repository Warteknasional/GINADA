@extends('layouts.customer')

@section('title', 'Beranda - Ginada Florist')

@section('content')

<div class="relative w-full h-[600px] bg-olive/10 overflow-hidden">
    
    <div class="absolute inset-0">
        <img src="{{ asset('img/hero-bunga.jpg') }}" class="w-full h-full object-cover" alt="Hero Banner">
        <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
        <h1 class="font-heading text-4xl md:text-6xl font-bold text-white drop-shadow-md mb-6 leading-tight">
            Supporting Creativity, <br> Endless Possibilities.
        </h1>
        
        <a href="{{ route('customer.products.index') }}" class="bg-white text-olive px-8 py-4 text-sm font-bold tracking-widest uppercase hover:bg-cream transition duration-300 shadow-lg">
            Mulai Belanja
        </a>
    </div>
</div>

<div class="bg-cream py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        
        <h2 class="font-heading text-3xl md:text-4xl text-olive uppercase tracking-wide mb-4">
            Our Best Seller Products
        </h2>
        <div class="w-24 h-0.5 bg-olive/30 mx-auto mb-12"></div>

        <div class="min-h-[200px] flex items-center justify-center border-2 border-dashed border-sand/30 bg-surface/50 rounded-lg">
            <p class="text-taupe italic font-body">
                -- Koleksi produk terbaik akan segera hadir di sini --
            </p>
        </div>

    </div>
</div>

<div class="bg-surface py-20 border-t border-sand/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            
            <div class="relative h-[500px] bg-cream overflow-hidden shadow-xl">
                <img src="https://images.unsplash.com/photo-1582794543139-8ac92a900275?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Dekorasi Bunga" class="w-full h-full object-cover">
            </div>

            <div class="pl-0 md:pl-10">
                <h2 class="font-heading text-4xl md:text-5xl text-olive mb-6 leading-tight">
                    Dari Ginada Untuk <br> Kawan Florist
                </h2>

                <div class="space-y-6 text-taupe font-body leading-relaxed text-sm md:text-base">
                    <p>
                        Di Ginada Florist, kami percaya bahwa setiap karya bunga punya cerita. 
                        Dari pemilihan tangkai terbaik hingga perangkaian penuh cinta, Ginada hadir 
                        untuk mendukung setiap momen spesial Anda.
                    </p>
                    <p>
                        Kami memahami betapa pentingnya setiap detail dalam merangkai bunga. 
                        Hal ini menjadi alasan kami hadir dengan koleksi bunga segar yang lengkap 
                        dan berkualitas premium.
                    </p>
                    <p>
                        Kami ingin menjadi lebih dari sekadar toko bunga, kami ingin menjadi 
                        teman berbagi kebahagiaan Kawan Florist.
                    </p>
                    <p>
                        Dari Ginada, kami berharap bisa mendampingi setiap langkah 
                        menyampaikan perasaan Anda di mana pun dan kapan pun.
                    </p>
                </div>

                <div class="mt-10">
                    <a href="{{ route('customer.products.index') }}" class="inline-block bg-leaf text-white px-10 py-4 text-xs font-bold uppercase tracking-widest hover:bg-olive transition duration-300 shadow-md">
                        Belanja Sekarang
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection