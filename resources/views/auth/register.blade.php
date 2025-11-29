<x-guest-layout>
    <div class="hidden lg:flex w-1/2 bg-olive relative items-center justify-center overflow-hidden">
        <div class="absolute inset-0 opacity-60">
            <img src="{{ asset('img/hero-bunga.jpg') }}" class="w-full h-full object-cover" alt="Bunga">
        </div>
        <div class="relative z-10 text-center p-12">
            <h2 class="font-heading text-5xl text-cream font-bold mb-4">Bergabunglah</h2>
            <p class="text-cream/90 text-lg italic">"Jadilah bagian dari keluarga Ginada Florist."</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-cream p-8 md:p-16 h-full overflow-y-auto">
        <div class="w-full max-w-md space-y-8">
            
            <div class="text-center">
                <img src="{{ asset('img/logo.jpg') }}" class="h-20 w-20 rounded-full border border-sand mx-auto mb-4 object-contain">
                <h2 class="font-heading text-3xl font-bold text-olive">Buat Akun Baru</h2>
                <p class="mt-2 text-taupe text-sm">Lengkapi data diri Anda untuk memulai.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <input id="name" name="name" type="text" :value="old('name')" required autofocus autocomplete="name"
                        class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition"
                        placeholder="Nama Anda">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-coral text-xs" />
                </div>

                <div>
                    <label for="email" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Email</label>
                    <input id="email" name="email" type="email" :value="old('email')" required autocomplete="username"
                        class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition"
                        placeholder="nama@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-coral text-xs" />
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition"
                        placeholder="Minimal 8 karakter">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-coral text-xs" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Konfirmasi Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition"
                        placeholder="Ulangi password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-coral text-xs" />
                </div>

                <button type="submit" class="w-full flex justify-center bg-coral text-white p-4 font-bold uppercase tracking-widest text-xs hover:bg-olive transition duration-300 shadow-lg mt-6">
                    Daftar Sekarang
                </button>

                <div class="text-center text-sm text-taupe">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-olive font-bold hover:text-coral underline transition">
                        Masuk disini
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>