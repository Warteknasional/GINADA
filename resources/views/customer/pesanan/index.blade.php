@extends('layouts.customer')

@section('title', 'Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Pesanan Saya</h1>

    <div class="space-y-4">
        @forelse($pesanan as $p)
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="font-bold text-lg">{{ $p->kode_pesanan }}</h3>
                    <p class="text-sm text-gray-600">{{ $p->created_at->format('d M Y H:i') }}</p>
                </div>
                <span class="px-3 py-1 rounded text-sm font-semibold
                    @if($p->status == 'selesai') bg-green-100 text-green-800
                    @elseif($p->status == 'dibatalkan') bg-red-100 text-red-800
                    @elseif($p->status == 'dikirim') bg-indigo-100 text-indigo-800
                    @elseif($p->status == 'diproses') bg-blue-100 text-blue-800
                    @else bg-yellow-100 text-yellow-800
                    @endif">
                    {{ ucfirst($p->status) }}
                </span>
            </div>

            <div class="border-t border-b py-4 mb-4">
                @foreach($p->detail as $item)
                <div class="flex justify-between items-center py-2">
                    <div class="flex items-center space-x-3">
                        @if($item->product->image)
                            <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded">
                        @else
                            <div class="h-16 w-16 bg-gray-200 rounded flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium">{{ $item->product->name }}</p>
                            <p class="text-sm text-gray-600">{{ $item->jumlah }} x Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <p class="font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                </div>
                @endforeach
            </div>

            <div class="space-y-2 mb-4">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span>Rp {{ number_format($p->detail->sum('subtotal'), 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Ongkir</span>
                    <span>Rp {{ number_format($p->ongkir, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between font-bold text-lg border-t pt-2">
                    <span>Total</span>
                    <span class="text-blue-600">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt mr-1"></i>
                    {{ Str::limit($p->alamat_kirim, 50) }}
                </div>
                
                @if($p->status == 'pending' && !$p->pembayaran)
                    <a href="{{ route('customer.pembayaran.create', $p) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        <i class="fas fa-credit-card mr-2"></i>Bayar
                    </a>
                @elseif($p->pembayaran)
                    <span class="text-sm {{ $p->pembayaran->status == 'confirmed' ? 'text-green-600' : 'text-yellow-600' }}">
                        <i class="fas fa-{{ $p->pembayaran->status == 'confirmed' ? 'check-circle' : 'clock' }} mr-1"></i>
                        Pembayaran {{ $p->pembayaran->status == 'confirmed' ? 'Dikonfirmasi' : 'Menunggu Konfirmasi' }}
                    </span>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg mb-4">Belum ada pesanan</p>
            <a href="{{ route('customer.products.index') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded">
                <i class="fas fa-shopping-cart mr-2"></i>Mulai Belanja
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection