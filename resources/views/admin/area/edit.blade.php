@extends('layouts.admin')

@section('header', 'Edit Area')

@section('content')

<div class="max-w-2xl mx-auto">
    <a href="{{ route('admin.area.index') }}" class="inline-flex items-center text-sm text-slate-500 hover:text-blue-600 mb-6 transition">
        <i class="fas fa-arrow-left mr-2"></i> Batal Edit
    </a>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8">
        <h3 class="font-bold text-slate-800 text-lg mb-6">Update Harga Area</h3>

        <form action="{{ route('admin.area.update', $area->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Area</label>
                    <input type="text" name="nama_area" value="{{ old('nama_area', $area->nama_area) }}" required
                        class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Biaya Ongkir (Rp)</label>
                    <input type="number" name="ongkir" value="{{ old('ongkir', $area->ongkir) }}" required
                        class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Estimasi Sampai</label>
                    <input type="text" name="estimasi" value="{{ old('estimasi', $area->estimasi) }}" required
                        class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Catatan</label>
                    <textarea name="catatan" rows="3" class="w-full border border-slate-300 px-4 py-3 rounded-lg text-sm focus:outline-none focus:border-blue-500">{{ old('catatan', $area->catatan) }}</textarea>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-bold text-sm hover:bg-blue-700 transition shadow-lg">
                    Update Harga
                </button>
            </div>
        </form>
    </div>
</div>

@endsection