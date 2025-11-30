<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Panel - Ginada Florist</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Scrollbar Halus untuk Sidebar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">

        <aside class="w-64 bg-slate-900 text-white flex-shrink-0 hidden md:flex flex-col shadow-xl z-20">
            
            <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-900">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-red-600 rounded-lg flex items-center justify-center text-white font-bold shadow-lg">
                        G
                    </div>
                    <span class="font-bold text-lg tracking-wide">Ginada Admin</span>
                </div>
            </div>

            <nav class="flex-1 overflow-y-auto py-4 no-scrollbar">
                <ul class="space-y-1 px-3">
                    
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-red-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-tachometer-alt w-5 text-center"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>

                    <li class="px-4 pt-6 pb-2 text-xs font-bold text-slate-500 uppercase tracking-wider">Master Data</li>

                    <li>
                        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.products.*') ? 'bg-red-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-box w-5 text-center"></i>
                            <span class="font-medium">Produk Bunga</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.categories.*') ? 'bg-red-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-tags w-5 text-center"></i>
                            <span class="font-medium">Kategori</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.area.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.area.*') ? 'bg-red-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-map-marked-alt w-5 text-center"></i>
                            <span class="font-medium">Wilayah & Ongkir</span>
                        </a>
                    </li>

                    <li class="px-4 pt-6 pb-2 text-xs font-bold text-slate-500 uppercase tracking-wider">Transaksi</li>

                    <li>
                        <a href="{{ route('admin.pesanan.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.pesanan.*') ? 'bg-red-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-shopping-cart w-5 text-center"></i>
                            <span class="font-medium">Pesanan Masuk</span>
                            
                            {{-- Badge Notifikasi jika ada pesanan baru dibayar --}}
                            @php $newOrders = \App\Models\Pesanan::where('status', 'dibayar')->count(); @endphp
                            @if($newOrders > 0)
                                <span class="ml-auto bg-blue-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $newOrders }}</span>
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.pembayaran.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.pembayaran.*') ? 'bg-red-600 text-white shadow-md' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <i class="fas fa-money-bill-wave w-5 text-center"></i>
                            <span class="font-medium">Konfirmasi Bayar</span>
                        </a>
                    </li>

                </ul>
            </nav>

            <div class="p-4 border-t border-slate-800 bg-slate-900">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center text-slate-300 font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 bg-slate-800 hover:bg-red-600 text-slate-300 hover:text-white py-2 rounded-lg text-sm transition duration-200">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col overflow-hidden">
            
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-10">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-slate-500 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    <h2 class="text-xl font-bold text-slate-800 hidden md:block">
                        @yield('header', 'Admin Panel')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">Hari ini: {{ date('d M Y') }}</span>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-check-circle"></i>
                            <p>{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>