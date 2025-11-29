<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ginada Florist')</title>
    
    <link rel="icon" href="{{ asset('img/logo.jpg') }}" type="image/jpeg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cream': '#FFF7F0',     // Background Utama
                        'surface': '#FAF4ED',   // Card / Section Background
                        'olive': '#4A4A2E',     // Primary Text (Judul/Nav)
                        'taupe': '#7A7160',     // Secondary Text (Deskripsi)
                        'coral': '#E4574E',     // Accent (Tombol/Link)
                        'leaf': '#A2B679',      // Icon Dekoratif
                        'sand': '#C8BBAA',      // Border / Garis
                    },
                    fontFamily: {
                        heading: ['"Playfair Display"', 'serif'],
                        body: ['"Libre Baskerville"', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Libre Baskerville', serif; background-color: #FFF7F0; color: #4A4A2E; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="flex flex-col min-h-screen bg-cream selection:bg-coral selection:text-white">

    <nav class="bg-cream/90 backdrop-blur-md sticky top-0 z-50 border-b border-sand/30 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-24">
                
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Ginada Florist" class="h-16 w-16 object-contain rounded-full border border-sand p-0.5 group-hover:border-coral transition-colors duration-300">
                        
                        <div class="flex flex-col">
                            <span class="font-heading font-bold text-2xl text-olive tracking-wide group-hover:text-coral transition-colors">GINADA</span>
                            <span class="text-xs text-coral font-bold tracking-[0.2em] uppercase">Florist</span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-12">
                    <a href="{{ route('dashboard') }}" class="text-olive hover:text-coral font-bold transition text-sm uppercase tracking-wider relative group">
                        Beranda
                        <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-coral transition-all group-hover:w-full"></span>
                    </a>
                    <a href="{{ route('customer.products.index') }}" class="text-olive hover:text-coral font-medium transition text-sm uppercase tracking-wider">
                        Katalog
                    </a>

                    <a href="{{ route('customer.contact') }}" class="text-olive hover:text-coral font-medium transition text-sm uppercase tracking-wider {{ request()->routeIs('customer.contact') ? 'text-coral font-bold' : '' }}">
                        Kontak
                    </a>
                </div>

                <div class="flex items-center gap-8">
    @auth
        <a href="{{ route('customer.keranjang.index') }}" class="text-olive hover:text-coral relative group transition" title="Keranjang Belanja">
            <i class="fas fa-shopping-bag fa-lg"></i>
            
            @php
                $cartCount = \App\Models\Keranjang::where('user_id', Auth::id())->sum('qty');
            @endphp
            
            @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 bg-coral text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm">
                    {{ $cartCount }}
                </span>
            @endif
        </a>

                        <div class="relative group z-50">
                            <button class="flex items-center gap-2 text-olive hover:text-coral font-medium focus:outline-none transition">
                                <span class="hidden md:inline text-sm uppercase tracking-wide">{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            
                            <div class="absolute right-0 mt-4 w-48 bg-surface border border-sand/20 rounded shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform origin-top-right z-50">
                                <a href="{{ route('customer.pesanan.index') }}" class="block px-4 py-3 text-sm text-olive hover:bg-cream hover:text-coral transition">
                                    Riwayat Pesanan
                                </a>

                                <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-olive hover:bg-cream hover:text-coral transition">
                                    Edit Profil
                                </a>

                                <div class="border-t border-sand/20 my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-coral hover:bg-cream transition">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-olive hover:text-coral font-medium text-sm uppercase tracking-wide">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-coral text-white px-7 py-2.5 rounded-full hover:bg-red-600 transition shadow-lg shadow-coral/30 text-xs font-bold uppercase tracking-widest">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 mt-8">
            <div class="bg-surface border border-leaf/50 p-4 flex items-center shadow-sm rounded-lg">
                <div class="bg-leaf/20 rounded-full p-2 mr-4">
                    <i class="fas fa-check text-leaf text-lg"></i>
                </div>
                <p class="text-olive font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-surface text-olive pt-20 pb-10 mt-20 border-t border-sand/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16 text-center md:text-left">
                <div class="md:col-span-2 pr-8">
                    <h3 class="font-heading text-3xl font-bold mb-6 text-olive">Ginada Florist</h3>
                    <p class="text-taupe leading-loose font-body italic text-sm border-l-2 border-coral pl-6">
                        "Setiap bunga menceritakan sebuah kisah. Kami hadir untuk membantu Anda menyampaikan perasaan terdalam melalui keindahan rangkaian bunga segar yang dirangkai dengan penuh cinta."
                    </p>
                </div>
                
                <div>
                    <h4 class="font-heading text-lg font-bold mb-6 text-olive uppercase tracking-widest text-xs">Hubungi Kami</h4>
                    <ul class="space-y-4 text-taupe text-sm">
                        <li class="flex items-center justify-center md:justify-start gap-3">
                            <i class="fas fa-map-marker-alt text-leaf"></i> 
                            <span>Jl. Bunga Mawar No. 12, Kota Batu</span>
                        </li>
                        <li class="flex items-center justify-center md:justify-start gap-3">
                            <i class="fas fa-phone text-leaf"></i> 
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center justify-center md:justify-start gap-3">
                            <i class="fas fa-envelope text-leaf"></i> 
                            <span>hello@ginadaflorist.com</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-heading text-lg font-bold mb-6 text-olive uppercase tracking-widest text-xs">Ikuti Kami</h4>
                    <div class="flex justify-center md:justify-start space-x-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-sand flex items-center justify-center text-taupe hover:bg-coral hover:text-white hover:border-coral transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-sand flex items-center justify-center text-taupe hover:bg-coral hover:text-white hover:border-coral transition duration-300"><i class="fab fa-whatsapp"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-sand flex items-center justify-center text-taupe hover:bg-coral hover:text-white hover:border-coral transition duration-300"><i class="fab fa-facebook-f"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-sand/20 pt-8 text-center">
                <p class="text-taupe text-xs tracking-wider uppercase">&copy; {{ date('Y') }} Ginada Florist. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>