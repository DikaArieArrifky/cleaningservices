<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Jasmine Services — Car Wash & Home Cleaning Service Profesional')</title>
    <meta name="description" content="@yield('meta_description', 'Layanan Car Wash, Auto Detailing, dan Home Cleaning profesional berstandar premium dengan staf bersertifikat, peralatan modern, dan jaminan kepuasan 100%.')">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-[#F5F8F7] text-[#263746] font-sans antialiased selection:bg-[#28B8A7]/20 selection:text-[#142B3B]">

    <!-- Top Announcement & Quick Contact Bar -->
    <div class="bg-[#142B3B] text-slate-300 text-xs py-2 px-4 border-b border-slate-700/50 hidden sm:block">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span class="flex items-center gap-1.5 text-slate-300">
                    <i data-lucide="clock" class="w-3.5 h-3.5 text-[#28B8A7]"></i>
                    {{ \App\Models\SiteSetting::get('operating_hours', 'Senin - Minggu: 08:00 - 18:00 WIB') }}
                </span>
                <span class="flex items-center gap-1.5 text-slate-300">
                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#28B8A7]"></i>
                    Jakarta Selatan & Sekitarnya
                </span>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('booking.track') }}" class="hover:text-[#28B8A7] transition flex items-center gap-1">
                    <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    Cek Status Booking
                </a>
                <span class="text-slate-600">|</span>
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', \App\Models\SiteSetting::get('phone_number', '+6281234567890')) }}" class="hover:text-[#28B8A7] transition flex items-center gap-1">
                    <i data-lucide="phone" class="w-3.5 h-3.5 text-[#28B8A7]"></i>
                    {{ \App\Models\SiteSetting::get('phone_number', '+62 812-3456-7890') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Header -->
    <header x-data="{ mobileMenuOpen: false, scrolled: false }"
            @scroll.window="scrolled = (window.pageYOffset > 20)"
            :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-md py-3' : 'bg-white py-4'"
            class="sticky top-0 z-50 transition-all duration-300 border-b border-slate-200/60">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#142B3B] to-[#28B8A7] flex items-center justify-center text-white shadow-md shadow-[#28B8A7]/20 group-hover:scale-105 transition-transform">
                        <i data-lucide="sparkles" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <span class="text-xl font-extrabold tracking-tight text-[#142B3B] block leading-none">
                            Jasmine<span class="text-[#28B8A7]">Services</span>
                        </span>
                        <span class="text-[10px] uppercase tracking-wider font-semibold text-slate-400 block mt-0.5">
                            Auto Detailing & Clean Living
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2 text-sm font-semibold">
                    <a href="{{ route('home') }}"
                       class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('home') ? 'text-[#28B8A7] bg-[#28B8A7]/10' : 'text-[#263746] hover:text-[#28B8A7] hover:bg-slate-50' }}">
                        Beranda
                    </a>
                    
                    <a href="{{ route('car-wash') }}"
                       class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('car-wash') ? 'text-[#28B8A7] bg-[#28B8A7]/10' : 'text-[#263746] hover:text-[#28B8A7] hover:bg-slate-50' }}">
                        Car Wash & Detailing
                    </a>

                    <a href="{{ route('home-cleaning') }}"
                       class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('home-cleaning') ? 'text-[#28B8A7] bg-[#28B8A7]/10' : 'text-[#263746] hover:text-[#28B8A7] hover:bg-slate-50' }}">
                        Home Cleaning
                    </a>

                    <a href="{{ route('about') }}"
                       class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('about') ? 'text-[#28B8A7] bg-[#28B8A7]/10' : 'text-[#263746] hover:text-[#28B8A7] hover:bg-slate-50' }}">
                        Tentang Kami
                    </a>

                    <a href="{{ route('contact') }}"
                       class="px-3.5 py-2 rounded-lg transition {{ request()->routeIs('contact') ? 'text-[#28B8A7] bg-[#28B8A7]/10' : 'text-[#263746] hover:text-[#28B8A7] hover:bg-slate-50' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Action CTA & Track Button -->
                <div class="hidden md:flex items-center gap-3">
                    <a href="{{ route('booking.track') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-semibold text-slate-600 hover:text-[#142B3B] hover:bg-slate-100 rounded-lg transition">
                        <i data-lucide="compass" class="w-4 h-4 text-slate-500"></i>
                        Lacak Pesanan
                    </a>

                    <a href="{{ route('booking') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white bg-gradient-to-r from-[#28B8A7] to-[#20998a] hover:from-[#20998a] hover:to-[#178275] shadow-lg shadow-[#28B8A7]/25 hover:shadow-xl hover:shadow-[#28B8A7]/30 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        <i data-lucide="calendar" class="w-4 h-4"></i>
                        <span>Book a Service</span>
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden gap-2">
                    <a href="{{ route('booking') }}" class="px-3 py-1.5 rounded-lg text-xs font-bold text-white bg-[#28B8A7]">
                        Booking
                    </a>
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                            type="button"
                            class="p-2 rounded-lg text-slate-600 hover:text-[#142B3B] hover:bg-slate-100 transition focus:outline-none">
                        <i x-show="!mobileMenuOpen" data-lucide="menu" class="w-6 h-6"></i>
                        <i x-show="mobileMenuOpen" data-lucide="x" class="w-6 h-6" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-3"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-3"
             class="md:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 space-y-2 shadow-xl"
             x-cloak>
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#28B8A7]">Beranda</a>
            <a href="{{ route('car-wash') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#28B8A7]">Car Wash & Detailing</a>
            <a href="{{ route('home-cleaning') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#28B8A7]">Home Cleaning</a>
            <a href="{{ route('about') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#28B8A7]">Tentang Kami</a>
            <a href="{{ route('contact') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#28B8A7]">Kontak</a>
            <a href="{{ route('booking.track') }}" class="block px-3 py-2.5 rounded-lg font-semibold text-slate-700 hover:bg-slate-50 hover:text-[#28B8A7]">Lacak Booking</a>

            <div class="pt-4 border-t border-slate-100">
                <a href="{{ route('booking') }}" class="w-full flex items-center justify-center gap-2 py-3 rounded-xl font-bold text-white bg-[#28B8A7] shadow-md shadow-[#28B8A7]/30">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Book a Service Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- Global Toast / Flash Messages -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between p-4 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 shadow-sm transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                    </div>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 p-1">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div x-data="{ show: true }" x-show="show" class="flex items-center justify-between p-4 mb-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 shadow-sm transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                        <i data-lucide="alert-circle" class="w-5 h-5"></i>
                    </div>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-rose-500 hover:text-rose-700 p-1">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        @endif
    </div>

    <!-- Main Content Yield -->
    <main class="min-h-[70vh]">
        @yield('content')
    </main>

    <!-- Comprehensive Business Footer -->
    <footer class="bg-[#142B3B] text-slate-300 pt-16 pb-8 border-t border-slate-800 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-700/60">
                
                <!-- Col 1: About & Brand -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#28B8A7] to-teal-300 flex items-center justify-center text-[#142B3B] font-bold shadow-md shadow-[#28B8A7]/20">
                            <i data-lucide="sparkles" class="w-5 h-5 text-[#142B3B]"></i>
                        </div>
                        <span class="text-2xl font-extrabold tracking-tight text-white">
                            Jasmine<span class="text-[#28B8A7]">Services</span>
                        </span>
                    </div>
                    <p class="text-sm text-slate-400 leading-relaxed max-w-sm">
                        {{ \App\Models\SiteSetting::get('site_tagline', 'Solusi profesional dan terpercaya untuk perawatan berkilau kendaraan Anda dan kebersihan menyeluruh hunian keluarga Anda.') }}
                    </p>
                    <div class="pt-2 flex items-center space-x-3">
                        <a href="{{ \App\Models\SiteSetting::get('instagram_url', '#') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-[#28B8A7] text-slate-300 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="{{ \App\Models\SiteSetting::get('facebook_url', '#') }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-[#28B8A7] text-slate-300 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="facebook" class="w-4 h-4"></i>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', \App\Models\SiteSetting::get('whatsapp_number', '081234567890')) }}" target="_blank" rel="noopener" class="w-9 h-9 rounded-lg bg-slate-800 hover:bg-[#28B8A7] text-slate-300 hover:text-white flex items-center justify-center transition">
                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Car Wash Services -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-[#28B8A7] pl-2.5">
                        Car Wash
                    </h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('car-wash') }}" class="hover:text-[#28B8A7] transition">Exterior Car Wash</a></li>
                        <li><a href="{{ route('car-wash') }}" class="hover:text-[#28B8A7] transition">Interior Deep Cleaning</a></li>
                        <li><a href="{{ route('car-wash') }}" class="hover:text-[#28B8A7] transition">Full Wash & Hydro Wax</a></li>
                        <li><a href="{{ route('car-wash') }}" class="hover:text-[#28B8A7] transition">Nano Ceramic Coating</a></li>
                        <li><a href="{{ route('car-wash') }}" class="hover:text-[#28B8A7] transition">Engine Bay Detailing</a></li>
                    </ul>
                </div>

                <!-- Col 3: Home Cleaning Services -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-[#28B8A7] pl-2.5">
                        Home Cleaning
                    </h3>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="{{ route('home-cleaning') }}" class="hover:text-[#28B8A7] transition">Regular Home Cleaning</a></li>
                        <li><a href="{{ route('home-cleaning') }}" class="hover:text-[#28B8A7] transition">Deep Cleaning Total</a></li>
                        <li><a href="{{ route('home-cleaning') }}" class="hover:text-[#28B8A7] transition">Kitchen Degreasing</a></li>
                        <li><a href="{{ route('home-cleaning') }}" class="hover:text-[#28B8A7] transition">Bathroom Descaling</a></li>
                        <li><a href="{{ route('home-cleaning') }}" class="hover:text-[#28B8A7] transition">Move In / Move Out</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact & Office -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-4 border-l-2 border-[#28B8A7] pl-2.5">
                        Hubungi Kami
                    </h3>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li class="flex items-start gap-2.5">
                            <i data-lucide="map-pin" class="w-4 h-4 text-[#28B8A7] shrink-0 mt-0.5"></i>
                            <span>{{ \App\Models\SiteSetting::get('office_address', 'Jl. Boulevard Raya No. 45, Kebayoran Baru, Jakarta Selatan') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="phone" class="w-4 h-4 text-[#28B8A7] shrink-0"></i>
                            <span>{{ \App\Models\SiteSetting::get('phone_number', '+62 812-3456-7890') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <i data-lucide="mail" class="w-4 h-4 text-[#28B8A7] shrink-0"></i>
                            <span>{{ \App\Models\SiteSetting::get('email_address', 'halo@jasmineservices.id') }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright & Quality Badge -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; {{ date('Y') }} Jasmine Services Indonesia. All rights reserved.</p>
                <div class="flex items-center space-x-6">
                    <span class="flex items-center gap-1.5 text-slate-400">
                        <i data-lucide="shield-check" class="w-4 h-4 text-[#28B8A7]"></i>
                        100% Satisfaction Guarantee
                    </span>
                    <a href="{{ route('admin.login') }}" class="hover:text-slate-400 transition">Portal Staff</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Action Button -->
    @php
        $rawWa = \App\Models\SiteSetting::get('whatsapp_number', '081234567890');
        $cleanWa = preg_replace('/[^0-9]/', '', $rawWa);
        if (str_starts_with($cleanWa, '0')) {
            $cleanWa = '62' . substr($cleanWa, 1);
        }
    @endphp
    <div class="fixed bottom-6 right-6 z-40 group">
        <a href="https://wa.me/{{ $cleanWa }}?text=Halo%20Admin%20Jasmine%20Services%2C%20saya%20ingin%20konsultasi%20layanan..."
           target="_blank"
           rel="noopener noreferrer"
           class="flex items-center gap-2.5 bg-[#25D366] text-white px-4 py-3 rounded-full shadow-xl hover:shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-white"></span>
            </span>
            <i data-lucide="message-circle" class="w-5 h-5"></i>
            <span class="text-sm font-bold hidden sm:inline">Chat WhatsApp</span>
        </a>
    </div>

    @stack('scripts')
</body>
</html>
