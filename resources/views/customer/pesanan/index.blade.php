@extends('layouts.customer')

@section('title', 'Riwayat Pesanan - Ginada Florist')

@section('content')

<div class="bg-cream min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <span class="text-coral font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Aktivitas Belanja</span>
                <h1 class="font-heading text-3xl md:text-4xl font-bold text-olive">Riwayat Pesanan</h1>
            </div>
            
            <a href="{{ route('customer.products.index') }}" class="inline-flex items-center gap-2 text-taupe hover:text-coral transition font-bold text-xs uppercase tracking-widest group">
                <i class="fas fa-plus group-hover:rotate-90 transition-transform"></i>
                <span>Pesanan Baru</span>
            </a>
        </div>

        @if($pesanan->isEmpty())
            <div class="bg-surface border border-dashed border-sand/30 rounded-lg p-16 text-center">
                <div class="w-20 h-20 bg-cream rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-bag text-3xl text-sand"></i>
                </div>
                <h3 class="font-heading text-xl text-olive mb-2">Belum ada pesanan</h3>
                <p class="text-taupe text-sm mb-6">Anda belum pernah melakukan pemesanan bunga.</p>
                <a href="{{ route('customer.products.index') }}" class="bg-olive text-white px-8 py-3 rounded-full font-bold uppercase text-xs tracking-widest hover:bg-coral transition shadow-lg">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($pesanan as $item)
                    <div class="bg-surface border border-sand/20 hover:border-coral/30 hover:shadow-lg transition duration-300 overflow-hidden rounded-none relative group">
                        
                        <div class="bg-white/50 border-b border-sand/10 p-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center text-olive font-bold border border-sand/20">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div>
                                    <span class="block text-xs font-bold text-taupe uppercase tracking-wider">No. Pesanan</span>
                                    <span class="font-heading text-lg font-bold text-olive">#{{ $item->kode_pesanan }}</span>
                                </div>
                            </div>
                            
                            @php
                                $statusColor = 'bg-gray-100 text-gray-600'; // Default
                                if($item->status == 'pending') $statusColor = 'bg-orange-100 text-orange-600';
                                elseif($item->status == 'dibayar') $statusColor = 'bg-blue-100 text-blue-600';
                                elseif($item->status == 'dikirim') $statusColor = 'bg-purple-100 text-purple-600';
                                elseif($item->status == 'selesai') $statusColor = 'bg-green-100 text-green-600';
                                elseif($item->status == 'batal') $statusColor = 'bg-red-100 text-red-600';
                            @endphp
                            <span class="{{ $statusColor }} px-4 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest border border-current/20">
                                {{ $item->status }}
                            </span>
                        </div>

                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                                
                                <div>
                                    <p class="text-xs text-taupe uppercase tracking-wider mb-1">Tanggal</p>
                                    <p class="text-olive font-bold text-sm mb-4">{{ $item->created_at->format('d M Y') }}</p>
                                    
                                    <p class="text-xs text-taupe uppercase tracking-wider mb-1">Total Belanja</p>
                                    <p class="text-coral font-heading font-bold text-lg">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</p>
                                </div>

                                <div class="md:col-span-2">
                                    <p class="text-xs text-taupe uppercase tracking-wider mb-2">Item Produk</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($item->detail as $detail)
                                            <div class="flex items-center gap-2 bg-cream border border-sand/10 px-3 py-2 rounded-sm">
                                                <div class="w-8 h-8 bg-white overflow-hidden rounded-full border border-sand/20">
                                                    @if($detail->product && $detail->product->image)
                                                        <img src="{{ asset('storage/' . $detail->product->image) }}" class="w-full h-full object-cover">
                                                    @else
                                                        <div class="w-full h-full bg-sand/20"></div>
                                                    @endif
                                                </div>
                                                <div class="text-xs">
                                                    <span class="block text-olive font-bold">{{ $detail->product->name ?? 'Produk Dihapus' }}</span>
                                                    <span class="text-taupe">{{ $detail->jumlah }} x</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div>
                                    <p class="text-xs text-taupe uppercase tracking-wider mb-1">Dikirim ke</p>
                                    <div class="flex items-start gap-2">
                                        <i class="fas fa-map-marker-alt text-coral mt-1 text-xs"></i>
                                        <p class="text-olive text-sm font-medium leading-relaxed">
                                            {{ $item->alamat_kirim ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="bg-cream/50 p-4 flex justify-end gap-3 border-t border-sand/10">
                            @if($item->status == 'pending')
                                <a href="{{ route('customer.pembayaran.create', $item->id) }}" class="bg-coral text-white px-6 py-2 text-xs font-bold uppercase tracking-widest hover:bg-olive transition shadow-sm">
                                    Bayar Sekarang
                                </a>
                            @else
                                <a href="{{ route('customer.pesanan.show', $item->id) }}" class="bg-white text-olive border border-sand px-6 py-2 text-xs font-bold uppercase tracking-widest hover:bg-olive hover:text-white transition">
                                    Lihat Detail
                                </a>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>

@endsection