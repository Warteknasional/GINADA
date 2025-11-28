@extends('layouts.customer')

@section('title', 'Alamat Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Alamat Saya</h1>
        <a href="{{ route('customer.alamat.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            <i class="fas fa-plus mr-2"></i>Tambah Alamat
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($alamat as $a)
        <div class="bg-white rounded-lg shadow-md p-6 {{ $a->is_default ? 'border-2 border-blue-500' : '' }}">
            @if($a->is_default)
                <span class="inline-block bg-blue-500 text-white text-xs px-2 py-1 rounded mb-3">Alamat Utama</span>
            @endif
            
            @if($a->judul)
                <h3 class="font-semibold text-lg mb-2">{{ $a->judul }}</h3>
            @endif
            
            <div class="space-y-2 mb-4">
                <p class="text-gray-900 font-medium">{{ $a->penerima }}</p>
                <p class="text-gray-600 text-sm">{{ $a->no_hp }}</p>
                <p class="text-gray-700">{{ $a->alamat_lengkap }}</p>
                <p class="text-gray-600 text-sm">{{ $a->kota }}, {{ $a->provinsi }}</p>
                @if($a->kode_pos)
                    <p class="text-gray-600 text-sm">{{ $a->kode_pos }}</p>
                @endif
            </div>

            <div class="flex space-x-2 border-t pt-4">
                <a href="{{ route('customer.alamat.edit', $a) }}" class="flex-1 text-center bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded text-sm">
                    <i class="fas fa-edit mr-1"></i>Edit
                </a>
                <form action="{{ route('customer.alamat.destroy', $a) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded text-sm">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <i class="fas fa-map-marker-alt text-6xl text-gray-300 mb-4"></i>
            <p class="text-gray-500 text-lg mb-4">Belum ada alamat tersimpan</p>
            <a href="{{ route('customer.alamat.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded">
                <i class="fas fa-plus mr-2"></i>Tambah Alamat Pertama
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection