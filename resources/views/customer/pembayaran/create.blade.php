@extends('layouts.customer')

@section('title', 'Pembayaran - Ginada Florist')

@section('content')

<div class="bg-cream min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-10">
            <span class="text-coral font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Checkout</span>
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-olive">Konfirmasi & Bayar</h1>
        </div>
                @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Ups! Ada kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('customer.pembayaran.store', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf  
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="md:col-span-1">
                    <div class="bg-white p-6 border border-sand/20 sticky top-24 shadow-lg rounded-sm">
                        <h3 class="font-heading font-bold text-olive mb-4 border-b border-sand/10 pb-2">Rincian Pesanan</h3>
                        
                        <div class="text-xs text-taupe mb-4 space-y-1">
                            <p>No. Order: <span class="font-bold text-olive">#{{ $pesanan->kode_pesanan }}</span></p>
                            <p>Tanggal: {{ $pesanan->created_at->format('d M Y') }}</p>
                        </div>

                        <div class="space-y-3 mb-4 text-sm max-h-60 overflow-y-auto custom-scrollbar pr-2">
                            @php $subtotal = 0; @endphp
                            @foreach($pesanan->detail as $item)
                                @php $subtotal += $item->subtotal; @endphp
                                <div class="flex justify-between items-start border-b border-sand/10 pb-2 last:border-0">
                                    <div class="pr-2">
                                        <span class="block text-olive font-bold text-xs">{{ $item->product->name }}</span>
                                        <span class="text-taupe text-[10px]">Qty: {{ $item->jumlah }}</span>
                                    </div>
                                    <span class="text-olive font-bold text-xs whitespace-nowrap">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="bg-surface p-4 rounded border border-sand/10 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-taupe">Subtotal</span>
                                <span class="text-olive font-bold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-taupe">Ongkir</span>
                                <span id="display-ongkir" class="text-coral font-bold">Rp 0</span>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-sand/20 flex justify-between items-center">
                            <span class="font-heading font-bold text-lg text-olive">Total Bayar</span>
                            <span id="display-total" class="font-bold text-xl text-coral">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 space-y-8">
                    
                    <div class="bg-white p-8 border border-sand/20 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-olive"></div>
                        <h3 class="font-heading text-xl text-olive font-bold mb-6 flex items-center gap-3">
                            <span class="bg-olive text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow-md">1</span>
                            Tujuan Pengiriman
                        </h3>
                        
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-taupe uppercase tracking-wider mb-2">Kecamatan / Kota</label>
                            <div class="relative">
                                <select name="city_id" id="city_select" required 
                                    class="w-full bg-surface border border-sand px-4 py-3 text-olive font-medium focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition appearance-none cursor-pointer">
                                    <option value="" data-ongkir="0">-- Pilih Lokasi Anda --</option>
                                    
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}" data-ongkir="{{ $city->area->ongkir }}">
                                            {{ $city->name }} (Ongkir: Rp {{ number_format($city->area->ongkir, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-olive">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-taupe uppercase tracking-wider mb-2">Detail Alamat Lengkap</label>
                            <textarea name="alamat_detail" rows="3" required placeholder="Nama Jalan, Nomor Rumah, RT/RW, Patokan (Pagar Hitam/Depan Masjid)" 
                                class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition placeholder-taupe/50"></textarea>
                        </div>
                    </div>

                    <div class="bg-white p-8 border border-sand/20 shadow-sm relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-1 h-full bg-coral"></div>
                        <h3 class="font-heading text-xl text-olive font-bold mb-6 flex items-center gap-3">
                            <span class="bg-coral text-white w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold shadow-md">2</span>
                            Metode Pembayaran
                        </h3>

                        <div class="bg-cream border border-sand/30 p-5 rounded-lg flex items-center gap-5 mb-6">
                            <div class="w-14 h-14 bg-white flex items-center justify-center rounded-full border border-sand/10 shadow-sm flex-shrink-0">
                                <i class="fas fa-university text-2xl text-olive"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold uppercase text-taupe tracking-widest mb-1">Transfer Bank</p>
                                <p class="text-xl font-heading font-bold text-olive tracking-wider">123-456-7890</p>
                                <p class="text-sm font-bold text-coral">BCA a.n Ginada Florist</p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-taupe uppercase tracking-wider mb-2">Upload Bukti Transfer</label>
                            <div class="relative">
                                <input type="file" name="bukti" required accept="image/*" 
                                    class="block w-full text-sm text-taupe
                                    file:mr-4 file:py-3 file:px-6
                                    file:rounded-none file:border-0
                                    file:text-xs file:font-bold file:uppercase file:tracking-widest
                                    file:bg-olive file:text-white
                                    file:cursor-pointer hover:file:bg-coral
                                    border border-sand bg-surface cursor-pointer
                                    transition duration-300
                                  "/>
                            </div>
                            <p class="text-[10px] text-taupe mt-3 italic">
                                * Pastikan nominal transfer sesuai dengan <b>Total Bayar</b>. Pesanan akan diproses setelah pembayaran diverifikasi admin.
                            </p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-coral text-white py-4 font-bold uppercase tracking-[0.2em] text-sm hover:bg-olive transition duration-300 shadow-xl transform hover:-translate-y-1 flex justify-center items-center gap-3">
                        <i class="fas fa-paper-plane"></i>
                        <span>Kirim Pesanan</span>
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Ambil nilai subtotal dari PHP
    const subtotal = {{ $subtotal }};
    
    // Elemen HTML
    const selectCity = document.getElementById('city_select');
    const displayOngkir = document.getElementById('display-ongkir');
    const displayTotal = document.getElementById('display-total');

    // Format Rupiah
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
    }

    // Event Listener saat Kota dipilih
    selectCity.addEventListener('change', function() {
        // Ambil data-ongkir
        const ongkir = parseInt(this.options[this.selectedIndex].getAttribute('data-ongkir')) || 0;
        
        // Hitung total
        const totalBaru = subtotal + ongkir;

        // Update Text
        displayOngkir.innerText = formatRupiah(ongkir);
        displayTotal.innerText = formatRupiah(totalBaru);
        
        // Animasi kecil (Flash effect)
        displayTotal.classList.add('text-green-600');
        setTimeout(() => displayTotal.classList.remove('text-green-600'), 300);
    });
</script>

@endsection