@extends('layouts.customer')

@section('title', 'Edit Profil - Ginada Florist')

@section('content')

<div class="relative bg-surface border-b border-sand/30 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <span class="text-coral font-bold tracking-[0.2em] uppercase text-xs mb-2 block">Pengaturan Akun</span>
            <h1 class="font-heading text-3xl md:text-4xl font-bold text-olive">Profil Saya</h1>
        </div>
        
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-2 text-taupe hover:text-coral transition font-bold text-xs uppercase tracking-widest">
            <i class="fas fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>
    
    <div class="absolute inset-0 opacity-5 pointer-events-none" style="background-image: radial-gradient(#A2B679 1px, transparent 1px); background-size: 20px 20px;"></div>
</div>

<div class="bg-cream py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

        <div class="bg-surface border border-sand/20 p-8 md:p-10 shadow-sm relative overflow-hidden">
            <div class="md:grid md:grid-cols-3 md:gap-12">
                
                <div class="md:col-span-1 mb-6 md:mb-0">
                    <h3 class="font-heading text-xl font-bold text-olive mb-2">Informasi Pribadi</h3>
                    <p class="text-taupe text-sm leading-relaxed">
                        Perbarui informasi profil akun dan alamat email Anda. Pastikan email aktif untuk menerima notifikasi pesanan.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" 
                                class="w-full bg-cream border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition placeholder-taupe/50">
                            @error('name') <span class="text-coral text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required autocomplete="username" 
                                class="w-full bg-cream border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition placeholder-taupe/50">
                            @error('email') <span class="text-coral text-xs mt-1">{{ $message }}</span> @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-sm text-taupe">
                                        Email Anda belum diverifikasi.
                                        <button form="send-verification" class="underline text-coral hover:text-olive font-bold">
                                            Klik di sini untuk kirim ulang verifikasi.
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-leaf">
                                            Link verifikasi baru telah dikirim ke email Anda.
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-olive text-white px-6 py-3 font-bold uppercase tracking-widest text-xs hover:bg-coral transition duration-300 shadow-lg">
                                Simpan Perubahan
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-leaf font-bold">
                                    <i class="fas fa-check mr-1"></i> Tersimpan.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-surface border border-sand/20 p-8 md:p-10 shadow-sm">
            <div class="md:grid md:grid-cols-3 md:gap-12">
                
                <div class="md:col-span-1 mb-6 md:mb-0">
                    <h3 class="font-heading text-xl font-bold text-olive mb-2">Ganti Password</h3>
                    <p class="text-taupe text-sm leading-relaxed">
                        Pastikan akun Anda aman dengan menggunakan password yang panjang dan acak.
                    </p>
                </div>

                <div class="md:col-span-2">
                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password" autocomplete="current-password" 
                                class="w-full bg-cream border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition">
                            @error('current_password') <span class="text-coral text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Password Baru</label>
                            <input type="password" name="password" id="password" autocomplete="new-password" 
                                class="w-full bg-cream border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition">
                            @error('password') <span class="text-coral text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" 
                                class="w-full bg-cream border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition">
                            @error('password_confirmation') <span class="text-coral text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-olive text-white px-6 py-3 font-bold uppercase tracking-widest text-xs hover:bg-coral transition duration-300 shadow-lg">
                                Update Password
                            </button>

                            @if (session('status') === 'password-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-leaf font-bold">
                                    <i class="fas fa-check mr-1"></i> Tersimpan.
                                </p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="bg-white border border-coral/30 p-8 md:p-10 shadow-sm relative overflow-hidden">
            <div class="absolute top-0 left-0 w-1 h-full bg-coral"></div>
            
            <div class="md:grid md:grid-cols-3 md:gap-12">
                <div class="md:col-span-1 mb-6 md:mb-0">
                    <h3 class="font-heading text-xl font-bold text-coral mb-2">Hapus Akun</h3>
                    <p class="text-taupe text-sm leading-relaxed">
                        Setelah akun dihapus, semua data dan riwayat pesanan akan hilang permanen. Tindakan ini tidak bisa dibatalkan.
                    </p>
                </div>

                <div class="md:col-span-2 flex items-center">
                    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" 
                        class="bg-white border border-coral text-coral px-6 py-3 font-bold uppercase tracking-widest text-xs hover:bg-coral hover:text-white transition duration-300">
                        Hapus Akun Saya
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-8 bg-surface">
        @csrf
        @method('delete')

        <h2 class="text-xl font-bold font-heading text-olive">
            Apakah Anda yakin ingin menghapus akun?
        </h2>

        <p class="mt-2 text-sm text-taupe">
            Setelah akun dihapus, semua data akan hilang permanen. Silakan masukkan password Anda untuk konfirmasi bahwa Anda ingin menghapus akun ini secara permanen.
        </p>

        <div class="mt-6">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="password" placeholder="Password Anda"
                class="w-full bg-cream border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition">
            @error('password', 'userDeletion') <span class="text-coral text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6 flex justify-end gap-3">
            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-cream text-olive text-xs font-bold uppercase tracking-widest border border-sand hover:bg-white transition">
                Batal
            </button>

            <button type="submit" class="px-4 py-2 bg-coral text-white text-xs font-bold uppercase tracking-widest hover:bg-red-600 transition shadow-lg">
                Hapus Akun
            </button>
        </div>
    </form>
</x-modal>

@endsection