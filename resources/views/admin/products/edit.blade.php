@extends('layouts.admin')

@section('header', 'Edit Produk')

@section('content')

<div class="max-w-4xl mx-auto">
    
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition">
        <i class="fas fa-arrow-left mr-2"></i> Batal Edit
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50">
            <h3 class="font-bold text-slate-700">Edit: {{ $product->name }}</h3>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf
            @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                            class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kategori</label>
                        <select name="category_id" required class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Harga</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" required
                                class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Stok</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required
                                class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Ganti Foto (Opsional)</label>
                        <div class="flex gap-4 items-start">
                            @if($product->image)
                                <div class="w-24 h-24 rounded-lg overflow-hidden border border-slate-200 flex-shrink-0">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                                </div>
                            @endif
                            
                            <div class="flex-grow">
                                <input type="file" name="image" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                <p class="text-[10px] text-slate-400 mt-2">Biarkan kosong jika tidak ingin mengubah foto.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 border-t border-slate-100 pt-6 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-lg flex items-center gap-2">
                    <i class="fas fa-sync-alt"></i> Update Produk
                </button>
            </div>

        </form>
    </div>
</div>

@endsection