@extends('layouts.admin')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Daftar Pesanan Masuk</h1>
    
    <div class="flex gap-2">
        <a href="{{ route('admin.pesanan.export') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-sm text-sm">
            <i class="fas fa-file-excel"></i> Excel
        </a>

        <a href="{{ route('admin.pesanan.pdf') }}" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition shadow-sm text-sm">
            <i class="fas fa-file-pdf"></i> PDF
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="w-full text-left text-sm text-gray-600">
        <thead class="bg-gray-50 text-gray-800 font-bold uppercase text-xs">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Pelanggan</th>
                <th class="px-6 py-3">Total</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @foreach($pesanan as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-bold">#{{ $item->kode_pesanan }}</td>
                    <td class="px-6 py-4">{{ $item->user->name }}</td>
                    <td class="px-6 py-4">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600">
                            {{ $item->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.pesanan.show', $item->id) }}" class="text-blue-600 font-bold hover:underline">Lihat</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="p-4">
        {{ $pesanan->links() }}
    </div>
</div>

@endsection