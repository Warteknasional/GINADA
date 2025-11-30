@extends('layouts.admin')

@section('header', 'Detail Pesanan #' . $pesanan->kode_pesanan)

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 space-y-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-700">Informasi Pengiriman</h3>
                <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">
                    Jadwal: {{ $pesanan->tanggal_pengiriman ? \Carbon\Carbon::parse($pesanan->tanggal_pengiriman)->format('d M Y') : '-' }} 
                    ({{ $pesanan->waktu_pengiriman ?? '-' }})
                </span>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold mb-1">Nama Penerima / Pemesan</p>
                        <p class="text-slate-700 font-bold">{{ $pesanan->user->name }}</p>
                        <p class="text-sm text-slate-500">{{ $pesanan->user->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase font-bold mb-1">Alamat Tujuan</p>
                        <p class="text-slate-700 text-sm leading-relaxed border-l-4 border-blue-500 pl-3 bg-blue-50 py-2 rounded-r">
                            {{ $pesanan->alamat_kirim }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50">
                <h3 class="font-bold text-slate-700">Barang yang Dipesan</h3>
            </div>
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-white border-b border-slate-100 text-slate-400 font-bold uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3">Produk</th>
                        <th class="px-6 py-3 text-center">Harga</th>
                        <th class="px-6 py-3 text-center">Qty</th>
                        <th class="px-6 py-3 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($pesanan->detail as $item)
                        <tr>
                            <td class="px-6 py-4 flex items-center gap-4">
                                <div class="w-12 h-12 rounded overflow-hidden bg-slate-100 flex-shrink-0">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-300"><i class="fas fa-image"></i></div>
                                    @endif
                                </div>
                                <span class="font-bold text-slate-700">{{ $item->product->name ?? 'Produk Dihapus' }}</span>
                            </td>
                            <td class="px-6 py-4 text-center">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-center font-bold">{{ $item->jumlah }}</td>
                            <td class="px-6 py-4 text-right font-bold text-slate-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="lg:col-span-1 space-y-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-slate-700 mb-4">Update Status Pesanan</h3>
            
            <form action="{{ route('admin.pesanan.update-status', $pesanan->id) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-2">Status Saat Ini</label>
                    <select name="status" class="w-full border border-slate-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-blue-500">
                        <option value="pending" {{ $pesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="dibayar" {{ $pesanan->status == 'dibayar' ? 'selected' : '' }}>Sudah Dibayar</option>
                        <option value="diproses" {{ $pesanan->status == 'diproses' ? 'selected' : '' }}>Sedang Diproses (Dirangkai)</option>
                        <option value="dikirim" {{ $pesanan->status == 'dikirim' ? 'selected' : '' }}>Sedang Dikirim</option>
                        <option value="selesai" {{ $pesanan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $pesanan->status == 'dibatalkan' ? 'selected' : '' }}>Batalkan</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 rounded-lg text-sm transition">
                    Update Status
                </button>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="font-bold text-slate-700 mb-4">Rincian Pembayaran</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between text-slate-500">
                    <span>Subtotal Produk</span>
                    <span>Rp {{ number_format($pesanan->total_harga - $pesanan->ongkir, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-slate-500">
                    <span>Ongkos Kirim</span>
                    <span>Rp {{ number_format($pesanan->ongkir, 0, ',', '.') }}</span>
                </div>
                <div class="border-t border-slate-100 pt-3 flex justify-between items-center">
                    <span class="font-bold text-slate-800">Total Akhir</span>
                    <span class="font-bold text-green-600 text-lg">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 rounded-xl border border-slate-200 p-6 text-center">
            <p class="text-xs text-slate-500 mb-3">Siap dikirim? Cetak label alamat untuk ditempel di paket.</p>
            <button onclick="window.print()" class="w-full bg-white border border-slate-300 text-slate-700 font-bold py-2 rounded-lg text-sm hover:bg-slate-100 transition flex items-center justify-center gap-2">
                <i class="fas fa-print"></i> Cetak Label / Invoice
            </button>
        </div>

    </div>
</div>

@endsection