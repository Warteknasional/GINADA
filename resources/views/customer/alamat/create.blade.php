@extends('layouts.customer')

@section('title', 'Tambah Alamat')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('customer.alamat.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Tambah Alamat Baru</h2>
        
        <form action="{{ route('customer.alamat.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Label Alamat</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" 
                       placeholder="Contoh: Rumah, Kantor, dll"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-4">
                <label for="penerima" class="block text-sm font-medium text-gray-700 mb-2">Nama Penerima *</label>
                <input type="text" name="penerima" id="penerima" value="{{ old('penerima') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('penerima') border-red-500 @enderror" required>
                @error('penerima')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp') }}" 
                       placeholder="08xxxxxxxxxx"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('no_hp') border-red-500 @enderror" required>
                @error('no_hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                <textarea name="alamat_lengkap" id="alamat_lengkap" rows="3" 
                          placeholder="Nama jalan, nomor rumah, RT/RW, dll"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('alamat_lengkap') border-red-500 @enderror" required>{{ old('alamat_lengkap') }}</textarea>
                @error('alamat_lengkap')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="kota" class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                    <input type="text" name="kota" id="kota" value="{{ old('kota') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kota') border-red-500 @enderror" required>
                    @error('kota')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                    <input type="text" name="provinsi" id="provinsi" value="{{ old('provinsi') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('provinsi') border-red-500 @enderror" required>
                    @error('provinsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                <input type="text" name="kode_pos" id="kode_pos" value="{{ old('kode_pos') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_default" value="1" {{ old('is_default') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Jadikan alamat utama</span>
                </label>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('customer.alamat.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection