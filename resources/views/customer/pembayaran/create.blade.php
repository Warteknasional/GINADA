@extends('layouts.customer')

@section('title', 'Upload Bukti Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <a href="{{ route('customer.pesanan.index') }}" class="text-blue-600 hover:text-blue-800">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Pesanan
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-6">Upload Bukti Pembayaran</h2>

        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <h3 class="font-semibold mb-3">Detail Pesanan</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-600">Kode Pesanan:</span>
                    <span class="font-medium">{{ $pesanan->kode_pesanan }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Pembayaran:</span>
                    <span class="font-bold text-lg text-blue-600">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
            <h4 class="font-semibold mb-2 flex items-center">
                <i class="fas fa-info-circle mr-2 text-yellow-600"></i>
                Informasi Transfer
            </h4>
            <div class="text-sm space-y-1 text-gray-700">
                <p><strong>Bank:</strong> BCA</p>
                <p><strong>No. Rekening:</strong> 1234567890</p>
                <p><strong>Atas Nama:</strong> Toko Online</p>
            </div>
        </div>

        <form action="{{ route('customer.pembayaran.store', $pesanan) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-6">
                <label for="bukti" class="block text-sm font-medium text-gray-700 mb-2">
                    Upload Bukti Transfer *
                </label>
                <input type="file" name="bukti" id="bukti" accept="image/*" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bukti') border-red-500 @enderror" 
                       required onchange="previewImage(event)">
                @error('bukti')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG (Maks. 2MB)</p>
                
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm font-medium text-gray-700 mb-2">Preview:</p>
                    <img id="preview" src="" alt="Preview" class="max-w-xs rounded border">
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h4 class="font-semibold mb-2">Petunjuk:</h4>
                <ol class="list-decimal list-inside text-sm text-gray-700 space-y-1">
                    <li>Transfer sejumlah total pembayaran ke rekening di atas</li>
                    <li>Simpan bukti transfer dari bank</li>
                    <li>Upload foto/screenshot bukti transfer</li>
                    <li>Tunggu konfirmasi dari admin (maks. 1x24 jam)</li>
                </ol>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('customer.pesanan.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    <i class="fas fa-upload mr-2"></i>Upload Bukti
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('preview');
    const previewContainer = document.getElementById('imagePreview');
    const file = event.target.files[0];
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewContainer.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection