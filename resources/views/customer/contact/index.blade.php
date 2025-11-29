@extends('layouts.customer')

@section('title', 'Hubungi Kami - Ginada Florist')

@section('content')

<div class="bg-olive py-16 text-center relative overflow-hidden">
    <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FFF 1px, transparent 1px); background-size: 20px 20px;"></div>
    <h1 class="relative z-10 font-heading text-4xl text-cream font-bold tracking-widest uppercase">Hubungi Kami</h1>
    <p class="relative z-10 text-cream/80 mt-2 text-sm">Kami siap membantu mewujudkan momen spesial Anda</p>
</div>

<div class="bg-cream min-h-screen py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            
            <div class="bg-surface p-8 border border-sand/20 shadow-lg h-fit">
                <h2 class="font-heading text-2xl text-olive mb-6 font-bold">Informasi Toko</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center text-coral border border-sand/20 flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-olive uppercase tracking-wider text-xs mb-1">Lokasi Studio</h3>
                            <p class="text-taupe text-sm leading-relaxed">
                                Jl. Bunga Mawar No. 12, Kec. Lowokwaru,<br>
                                Kota Malang, Jawa Timur 65141
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center text-leaf border border-sand/20 flex-shrink-0">
                            <i class="fab fa-whatsapp text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-olive uppercase tracking-wider text-xs mb-1">WhatsApp Admin</h3>
                            <p class="text-taupe text-sm mb-2">Senin - Minggu (08.00 - 20.00)</p>
                            <a href="https://wa.me/6281234567890" target="_blank" class="text-olive font-bold hover:text-coral transition underline">
                                +62 812-3456-7890
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-cream rounded-full flex items-center justify-center text-olive border border-sand/20 flex-shrink-0">
                            <i class="fas fa-envelope text-xl"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-olive uppercase tracking-wider text-xs mb-1">Email Support</h3>
                            <p class="text-taupe text-sm">
                                hello@ginadaflorist.com
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-sand/20">
                    <h3 class="font-bold text-olive uppercase tracking-wider text-xs mb-4 text-center">Temukan Kami di Sosial Media</h3>
                    <div class="flex justify-center gap-4">
                        <a href="#" class="w-10 h-10 bg-olive text-white flex items-center justify-center rounded-full hover:bg-coral transition"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 bg-olive text-white flex items-center justify-center rounded-full hover:bg-coral transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 bg-olive text-white flex items-center justify-center rounded-full hover:bg-coral transition"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>

            <div class="bg-white p-2 shadow-lg border border-sand/20">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.448906933934!2d112.6158423147761!3d-7.952478994271814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e78827928892705%3A0x633f6756272545e!2sUniversitas%20Brawijaya!5e0!3m2!1sid!2sid!4v1626145321890!5m2!1sid!2sid" 
                    width="100%" 
                    height="500" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy"
                    class="grayscale hover:grayscale-0 transition duration-700">
                </iframe>
            </div>

        </div>
    </div>
</div>

@endsection