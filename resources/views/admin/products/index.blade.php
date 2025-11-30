@extends('layouts.admin')

@section('header', 'Kelola Produk')

@section('content')

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <h3 class="font-bold text-slate-700 text-lg">Daftar Bunga</h3>
        
        <a href="{{ route('admin.products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-bold flex items-center gap-2 transition shadow-sm">
            <i class="fas fa-plus"></i> Tambah Produk
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">Gambar</th>
                    <th class="px-6 py-4">Nama Produk</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4 text-center">Stok</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($products as $product)
                    <tr class="hover:bg-slate-50 transition duration-150">
                        <td class="px-6 py-4">
                            <div class="w-16 h-16 rounded-lg overflow-hidden border border-slate-200 bg-slate-100">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-800 text-base">{{ $product->name }}</span>
                            <p class="text-xs text-slate-400 mt-1 truncate w-48">{{ $product->description }}</p>
                        </td>

                        <td class="px-6 py-4">
                            <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold border border-slate-200">
                                {{ $product->category->name ?? 'Tanpa Kategori' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 font-bold text-slate-700">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($product->stock <= 5)
                                <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $product->stock }} (Kritis)
                                </span>
                            @else
                                <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $product->stock }}
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="w-8 h-8 rounded bg-yellow-100 text-yellow-600 flex items-center justify-center hover:bg-yellow-200 transition" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
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
                        <td colspan="6" class="px-6 py-16 text-center text-slate-400">
                            <i class="fas fa-box-open text-4xl mb-3 opacity-30"></i>
                            <p>Belum ada produk yang ditambahkan.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="p-4 border-t border-slate-100 bg-slate-50">
        {{ $products->links() }}
    </div>
</div>

@endsection