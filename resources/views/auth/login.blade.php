<x-guest-layout>
    <div class="hidden lg:flex w-1/2 bg-olive relative items-center justify-center overflow-hidden">
        <div class="absolute inset-0 opacity-60">
            <img src="{{ asset('img/hero-bunga.jpg') }}" class="w-full h-full object-cover" alt="Bunga">
        </div>
        <div class="relative z-10 text-center p-12">
            <h2 class="font-heading text-5xl text-cream font-bold mb-4">Selamat Datang</h2>
            <p class="text-cream/90 text-lg italic">"Awali harimu dengan keindahan bunga segar."</p>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center bg-cream p-8 md:p-16">
        <div class="w-full max-w-md space-y-8">
            
            <div class="text-center">
                <img src="{{ asset('img/logo.jpg') }}" class="h-20 w-20 rounded-full border border-sand mx-auto mb-4 object-contain">
                <h2 class="font-heading text-3xl font-bold text-olive">Masuk Member</h2>
                <p class="mt-2 text-taupe text-sm">Silakan masuk untuk mengelola pesanan Anda.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Email</label>
                    <input id="email" name="email" type="email" required autofocus autocomplete="username" 
                        class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition"
                        placeholder="nama@email.com">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-coral text-xs" />
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-olive uppercase tracking-wider mb-2">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full bg-surface border border-sand px-4 py-3 text-olive focus:outline-none focus:border-coral focus:ring-1 focus:ring-coral transition"
                        placeholder="••••••••">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-coral text-xs" />
                </div>

                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center text-taupe hover:text-olive cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-coral border-sand rounded focus:ring-coral bg-surface">
                        <span class="ml-2">Ingat Saya</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-coral hover:text-olive font-medium transition">
                            Lupa Password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full flex justify-center bg-coral text-white p-4 font-bold uppercase tracking-widest text-xs hover:bg-olive transition duration-300 shadow-lg">
                    Masuk Sekarang
                </button>

                <div class="text-center text-sm text-taupe">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-olive font-bold hover:text-coral underline transition">
                        Daftar disini
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>