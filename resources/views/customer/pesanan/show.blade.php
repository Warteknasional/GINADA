@extends('layouts.customer')

@section('title', 'Detail Pesanan #' . $pesanan->kode_pesanan)

@section('content')

<div class="bg-cream min-h-screen py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-between mb-8">
            <a href="{{ route('customer.pesanan.index') }}" class="group inline-flex items-center gap-2 text-taupe hover:text-coral transition font-bold text-xs uppercase tracking-widest">
                <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span>Kembali</span>
            </a>
            <h1 class="font-heading text-2xl md:text-3xl font-bold text-olive">Detail Pesanan</h1>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-6">
                
                <div class="bg-white p-6 border border-sand/20 shadow-sm relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full 
                        {{ $pesanan->status == 'pending' ? 'bg-orange-400' : '' }}
                        {{ $pesanan->status == 'dibayar' ? 'bg-blue-500' : '' }}
                        {{ $pesanan->status == 'dikirim' ? 'bg-purple-500' : '' }}
                        {{ $pesanan->status == 'selesai' ? 'bg-green-500' : '' }}
                    "></div>
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-xs text-taupe uppercase tracking-wider mb-1">No. Pesanan</p>
                            <p class="font-heading text-xl font-bold text-olive">#{{ $pesanan->kode_pesanan }}</p>
                            <p class="text-xs text-taupe mt-1">{{ $pesanan->created_at->format('d F Y, H:i') }} WIB</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-taupe uppercase tracking-wider mb-1">Status</p>
                            <span class="inline-block px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-sm
                                {{ $pesanan->status == 'pending' ? 'bg-orange-100 text-orange-600' : '' }}
                                {{ $pesanan->status == 'dibayar' ? 'bg-blue-100 text-blue-600' : '' }}
                                {{ $pesanan->status == 'dikirim' ? 'bg-purple-100 text-purple-600' : '' }}
                                {{ $pesanan->status == 'selesai' ? 'bg-green-100 text-green-600' : '' }}
                            ">
                                {{ $pesanan->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-sand/20 shadow-sm overflow-hidden">
                    <div class="bg-surface px-6 py-4 border-b border-sand/10">
                        <h3 class="font-bold text-olive text-sm uppercase tracking-wider">Item Produk</h3>
                    </div>
                    <div class="divide-y divide-sand/10">
                        @foreach($pesanan->detail as $item)
                            <div class="p-6 flex items-start gap-4">
                                <div class="w-20 h-20 bg-cream flex-shrink-0 border border-sand/20 overflow-hidden">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-sand">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex-grow">
                                    <h4 class="font-bold text-olive text-sm mb-1">{{ $item->product->name ?? 'Produk Dihapus' }}</h4>
                                    <p class="text-xs text-taupe mb-2">Harga Satuan: Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                                    <span class="inline-block bg-cream px-2 py-1 text-[10px] font-bold text-olive border border-sand/20">
                                        Qty: {{ $item->jumlah }}
                                    </span>
                                </div>

                                <div class="text-right">
                                    <p class="font-bold text-olive text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="lg:col-span-1 space-y-6">
                
                <div class="bg-white p-6 border border-sand/20 shadow-sm">
                    <h3 class="font-bold text-olive text-sm uppercase tracking-wider mb-4 border-b border-sand/10 pb-2">
                        Info Pengiriman
                    </h3>
                    <div class="flex items-start gap-3">
                        <i class="fas fa-map-marker-alt text-coral mt-1"></i>
                        <div>
                            <p class="text-sm text-olive font-bold mb-1">Alamat Tujuan:</p>
                            <p class="text-sm text-taupe leading-relaxed">
                                {{ $pesanan->alamat_kirim }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 border border-sand/20 shadow-sm">
                    <h3 class="font-bold text-olive text-sm uppercase tracking-wider mb-4 border-b border-sand/10 pb-2">
                        Rincian Pembayaran
                    </h3>
                    
                    <div class="space-y-2 text-sm mb-4">
                        <div class="flex justify-between text-taupe">
                            <span>Subtotal Produk</span>
                            <span>Rp {{ number_format($pesanan->total_harga - $pesanan->ongkir, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-taupe">
                            <span>Ongkos Kirim</span>
                            <span>Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="border-t border-sand/10 pt-3 flex justify-between items-center">
                        <span class="font-bold text-olive">Total Bayar</span>
                        <span class="font-heading font-bold text-xl text-coral">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($pesanan->pembayaran)
                    <div class="bg-white p-6 border border-sand/20 shadow-sm">
                        <h3 class="font-bold text-olive text-sm uppercase tracking-wider mb-4 border-b border-sand/10 pb-2">
                            Bukti Transfer
                        </h3>
                        <div class="relative group cursor-pointer" onclick="window.open('{{ asset('storage/' . $pesanan->pembayaran->bukti_bayar) }}', '_blank')">
                            <img src="{{ asset('storage/' . $pesanan->pembayaran->bukti_bayar) }}" class="w-full h-32 object-cover rounded-sm border border-sand/20">
                            <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xs font-bold uppercase tracking-widest">
                                <i class="fas fa-search-plus mr-2"></i> Perbesar
                            </div>
                        </div>
                        <p class="text-[10px] text-taupe mt-2 text-center">Dikirim: {{ $pesanan->pembayaran->created_at->format('d M Y H:i') }}</p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</div>

@endsection