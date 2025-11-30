@extends('layouts.admin')

@section('header', 'Kelola Wilayah & Ongkir')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="p-6 border-b border-slate-100 flex justify-between items-center">
        <h3 class="font-bold text-slate-700">Daftar Area Pengiriman</h3>
        <a href="{{ route('admin.area.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm">
            <i class="fas fa-plus"></i> Tambah Area Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Nama Area</th>
                    <th class="px-6 py-4">Ongkos Kirim</th>
                    <th class="px-6 py-4">Estimasi</th>
                    <th class="px-6 py-4">Cakupan Kota/Kecamatan</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($areas as $area)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4 font-bold text-slate-800">
                            {{ $area->nama_area }}
                        </td>
                        <td class="px-6 py-4 text-green-600 font-bold">
                            Rp {{ number_format($area->ongkir, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $area->estimasi ?? '-' }}
                        </td>
                        <td class="px-6 py-4">
                            @if($area->cities && $area->cities->count() > 0)
                                <div class="flex flex-wrap gap-1">
                                    @foreach($area->cities as $city)
                                        <span class="bg-slate-100 text-slate-500 text-[10px] px-2 py-1 rounded border border-slate-200">
                                            {{ $city->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-slate-400 italic text-xs">Belum ada kota terdaftar</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.area.edit', $area->id) }}" class="w-8 h-8 rounded bg-yellow-100 text-yellow-600 flex items-center justify-center hover:bg-yellow-200 transition" title="Edit Harga">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <form action="{{ route('admin.area.destroy', $area->id) }}" method="POST" onsubmit="return confirm('Hapus area ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded bg-red-100 text-red-600 flex items-center justify-center hover:bg-red-200 transition" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                            Belum ada data area ongkir.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="p-4 border-t border-slate-100">
        {{ $areas->links() }}
    </div>
</div>

@endsection