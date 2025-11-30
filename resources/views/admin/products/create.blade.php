@extends('layouts.admin')

@section('header', 'Tambah Produk Baru')

@section('content')

<div class="max-w-4xl mx-auto">
    
    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Produk
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50">
            <h3 class="font-bold text-slate-700">Formulir Produk</h3>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: Mawar Merah Premium"
                            class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Kategori</label>
                        <select name="category_id" required class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 bg-white">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ old('price') }}" required placeholder="15000"
                                class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Stok Awal</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" required placeholder="50"
                                class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Deskripsi Produk</label>
                        <textarea name="description" rows="4" placeholder="Jelaskan detail bunga, ukuran, dan makna..."
                            class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Foto Produk</label>
                        <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:bg-slate-50 transition relative">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" onchange="previewImage(event)">
                            <div id="preview-container">
                                <i class="fas fa-cloud-upload-alt text-3xl text-slate-400 mb-2"></i>
                                <p class="text-xs text-slate-500">Klik atau geser file ke sini (JPG/PNG)</p>
                            </div>
                            <img id="preview-img" class="hidden mt-2 mx-auto h-32 object-cover rounded shadow-md">
                        </div>
                        @error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

            </div>

            <div class="mt-8 border-t border-slate-100 pt-6 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-lg flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Produk
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
            const output = document.getElementById('preview-img');
            const container = document.getElementById('preview-container');
            output.src = reader.result;
            output.classList.remove('hidden');
            container.classList.add('hidden');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

@endsection