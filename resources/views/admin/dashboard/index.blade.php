@extends('layouts.admin')

@section('header', 'Dashboard Ringkasan')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    
    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="flex justify-between items-start z-10 relative">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Pendapatan</p>
                <h3 class="text-2xl font-bold text-slate-800">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
            </div>
            <div class="p-3 bg-green-100 text-green-600 rounded-lg group-hover:bg-green-600 group-hover:text-white transition duration-300">
                <i class="fas fa-wallet text-xl"></i>
            </div>
        </div>
        <div class="absolute -bottom-4 -right-4 text-green-50 opacity-20 group-hover:opacity-10 transition duration-500">
            <i class="fas fa-wallet text-8xl"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="flex justify-between items-start z-10 relative">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Perlu Diproses</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $pesananBaru }} <span class="text-sm font-normal text-slate-500">Pesanan</span></h3>
            </div>
            <div class="p-3 bg-blue-100 text-blue-600 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                <i class="fas fa-shopping-bag text-xl"></i>
            </div>
        </div>
        <div class="absolute -bottom-4 -right-4 text-blue-50 opacity-20 group-hover:opacity-10 transition duration-500">
            <i class="fas fa-shopping-bag text-8xl"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="flex justify-between items-start z-10 relative">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Total Bunga</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $totalProduk }} <span class="text-sm font-normal text-slate-500">Item</span></h3>
            </div>
            <div class="p-3 bg-purple-100 text-purple-600 rounded-lg group-hover:bg-purple-600 group-hover:text-white transition duration-300">
                <i class="fas fa-box text-xl"></i>
            </div>
        </div>
        <div class="absolute -bottom-4 -right-4 text-purple-50 opacity-20 group-hover:opacity-10 transition duration-500">
            <i class="fas fa-box text-8xl"></i>
        </div>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100 relative overflow-hidden group">
        <div class="flex justify-between items-start z-10 relative">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-1">Pelanggan</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $totalUser }} <span class="text-sm font-normal text-slate-500">Orang</span></h3>
            </div>
            <div class="p-3 bg-orange-100 text-orange-600 rounded-lg group-hover:bg-orange-600 group-hover:text-white transition duration-300">
                <i class="fas fa-users text-xl"></i>
            </div>
        </div>
        <div class="absolute -bottom-4 -right-4 text-orange-50 opacity-20 group-hover:opacity-10 transition duration-500">
            <i class="fas fa-users text-8xl"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
        <h3 class="font-bold text-slate-700 text-lg">Pesanan Terbaru Masuk</h3>
        <a href="{{ route('admin.pesanan.index') }}" class="text-sm text-blue-600 font-bold hover:text-blue-800 hover:underline transition">Lihat Semua Pesanan &rarr;</a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-100 text-slate-500 font-bold uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-4">ID Pesanan</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Total Bayar</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($latestOrders as $order)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="px-6 py-4 font-bold text-slate-700">#{{ $order->kode_pesanan }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold text-slate-600">
                                    {{ substr($order->user->name, 0, 1) }}
                                </div>
                                {{ $order->user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-slate-700">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($order->status == 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-600 border border-orange-200">Pending</span>
                            @elseif($order->status == 'dibayar')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-600 border border-blue-200">Dibayar</span>
                            @elseif($order->status == 'diproses')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">Diproses</span>
                            @elseif($order->status == 'dikirim')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-purple-100 text-purple-600 border border-purple-200">Dikirim</span>
                            @elseif($order->status == 'selesai')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600 border border-green-200">Selesai</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-600 border border-red-200">Batal</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-500">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.pesanan.show', $order->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded bg-white border border-slate-300 text-slate-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                            <i class="fas fa-inbox text-4xl mb-3 block opacity-30"></i>
                            Belum ada pesanan masuk hari ini.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection