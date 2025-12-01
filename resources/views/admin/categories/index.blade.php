@extends('layouts.admin')

@section('header', 'Kelola Kategori')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    
    <div class="md:col-span-1">
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-6 sticky top-24">
            <h3 class="font-bold text-slate-800 text-lg mb-4">Tambah Kategori</h3>
            
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Kategori</label>
                    <input type="text" name="name" required placeholder="Contoh: Bunga Papan" 
                        class="w-full border border-slate-300 px-4 py-2 rounded-lg text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500">
                </div>

                <div class="mb-4">
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Gambar Sampul</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-slate-300 rounded-lg text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                    <p class="text-[10px] text-slate-400 mt-1">Format JPG/PNG, Max 2MB.</p>
                </div>

                <button type="submit" class="w-full bg-slate-800 text-white py-2 rounded-lg text-sm font-bold hover:bg-slate-900 transition">
                    <i class="fas fa-plus mr-2"></i> Simpan
                </button>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-500 font-bold uppercase text-xs">
                    <tr>
                        <th class="px-6 py-4">Gambar</th>
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4 text-center">Jumlah Produk</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $category)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4">
                                <div class="w-12 h-12 rounded overflow-hidden bg-slate-100 border border-slate-200">
                                    @if($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-slate-400">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-700">
                                {{ $category->name }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="bg-slate-100 text-slate-600 px-3 py-1 rounded-full text-xs font-bold">
                                    {{ $category->products_count }} Item
                                </span>
                            </td>
                            <td class="px-6 py-4 flex justify-center gap-2 items-center h-full pt-6">
                                <button onclick="openEditModal('{{ $category->id }}', '{{ $category->name }}')" 
                                    class="bg-yellow-100 text-yellow-700 w-8 h-8 rounded flex items-center justify-center hover:bg-yellow-200 transition">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-100 text-red-700 w-8 h-8 rounded flex items-center justify-center hover:bg-red-200 transition">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-slate-400">
                                Belum ada kategori dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="p-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</div>

<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md overflow-hidden transform transition-all scale-95 opacity-0 duration-300" id="modalContent">
        
        <div class="bg-slate-50 px-6 py-4 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Edit Kategori</h3>
            <button onclick="closeEditModal()" class="text-slate-400 hover:text-red-500">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="editName" required 
                        class="w-full border border-slate-300 px-4 py-2 rounded-lg text-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Ganti Gambar (Opsional)</label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full border border-slate-300 rounded-lg text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-l-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-sm font-bold text-slate-500 hover:text-slate-700">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, name) {
        const modal = document.getElementById('editModal');
        const content = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);

        document.getElementById('editName').value = name;
        const form = document.getElementById('editForm');
        form.action = "{{ url('admin/categories') }}/" + id;
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        const content = document.getElementById('modalContent');
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>

@endsection