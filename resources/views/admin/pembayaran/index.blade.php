@extends('layouts.admin')

@section('header', 'Konfirmasi Pembayaran')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-bold text-slate-700">Daftar Pembayaran Masuk</h3>
        <span class="text-xs text-slate-500 bg-slate-100 px-3 py-1 rounded-full">
            Total: {{ $pembayaran->total() }} Transaksi
        </span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">ID Pesanan</th>
                    <th class="px-6 py-4">Pelanggan</th>
                    <th class="px-6 py-4">Jumlah Bayar</th>
                    <th class="px-6 py-4">Bukti Transfer</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Tanggal Upload</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pembayaran as $item)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.pesanan.show', $item->pesanan_id) }}" class="font-bold text-blue-600 hover:underline">
                                #{{ $item->pesanan->kode_pesanan ?? '-' }}
                            </a>
                        </td>

                        <td class="px-6 py-4 font-medium text-slate-800">
                            {{ $item->pesanan->user->name ?? 'User Dihapus' }}
                        </td>

                        <td class="px-6 py-4 font-bold text-slate-700">
                            Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">
                            <a href="{{ asset('storage/' . $item->bukti_bayar) }}" target="_blank" class="group relative block w-16 h-16 rounded overflow-hidden border border-slate-200">
                                <img src="{{ asset('storage/' . $item->bukti_bayar) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs transition">
                                    <i class="fas fa-search"></i>
                                </div>
                            </a>
                        </td>

                        <td class="px-6 py-4">
                            @if($item->status == 'pending')
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-600 border border-orange-200 flex items-center gap-1 w-fit">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                                    Perlu Cek
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-600 border border-green-200 flex items-center gap-1 w-fit">
                                    <i class="fas fa-check-circle"></i>
                                    Valid
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-xs text-slate-500">
                            {{ $item->created_at->format('d M Y') }} <br>
                            {{ $item->created_at->format('H:i') }} WIB
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($item->status == 'pending')
                                <form action="{{ route('admin.pembayaran.konfirmasi', $item->id) }}" method="POST" onsubmit="return confirm('Apakah bukti transfer valid? Status pesanan akan berubah menjadi DIPROSES.');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-blue-700 transition shadow-sm flex items-center gap-2 mx-auto">
                                        <i class="fas fa-check"></i> Terima
                                    </button>
                                </form>
                            @else
                                <span class="text-slate-400 text-xs italic">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-16 text-center text-slate-400 bg-slate-50">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-file-invoice-dollar text-4xl mb-3 opacity-30"></i>
                                <p>Belum ada konfirmasi pembayaran masuk.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100 bg-slate-50">
        {{ $pembayaran->links() }}
    </div>
</div>

@endsection