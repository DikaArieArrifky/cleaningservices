@extends('layouts.app')

@section('title', 'Jasmine Services — Car Wash, Auto Detailing & Home Cleaning Service Profesional')
@section('meta_description', 'Layanan cuci mobil premium dan cleaning service rumah terbaik di Jabodetabek. Pilihan tepat untuk kendaraan berkilau dan hunian higienis.')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative overflow-hidden bg-gradient-to-b from-[#142B3B] via-[#142B3B]/95 to-[#142B3B] text-white pt-12 pb-24 lg:pt-20 lg:pb-32">
        <!-- Subtle Background Glows -->
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-[#28B8A7]/15 blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full bg-[#F2BD63]/10 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-8 items-center">
                
                <!-- Left Column: Copywriting & CTAs -->
                <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-[#28B8A7] text-xs font-semibold uppercase tracking-wider">
                        <i data-lucide="award" class="w-4 h-4 text-[#F2BD63]"></i>
                        <span>#1 Premium Car Wash & Home Cleaning Service</span>
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white leading-[1.15]">
                        Kilau Sempurna <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#28B8A7] to-teal-200">Mobil Anda</span>,<br class="hidden sm:inline">
                        Kebersihan Total <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#F2BD63] to-amber-200">Hunian Anda</span>.
                    </h1>

                    <p class="text-base sm:text-lg text-slate-300 max-w-2xl mx-auto lg:mx-0 font-normal leading-relaxed">
                        {{ $siteSettings['hero_subtitle'] }} Dikerjakan oleh tenaga profesional terlatih dengan peralatan modern dan chemical ramah lingkungan berstandar internasional.
                    </p>

                    <!-- Dual CTAs & Features Pills -->
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                        <a href="{{ route('booking') }}"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-4 rounded-2xl text-base font-bold text-white bg-gradient-to-r from-[#28B8A7] to-[#20998a] hover:from-[#20998a] hover:to-[#178275] shadow-xl shadow-[#28B8A7]/30 hover:shadow-2xl hover:-translate-y-0.5 active:translate-y-0 transition-all">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                            <span>Book a Service Sekarang</span>
                        </a>

                        <a href="#services"
                           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-2xl text-base font-semibold text-slate-200 hover:text-white bg-white/5 hover:bg-white/10 border border-white/10 transition-all">
                            <i data-lucide="layers" class="w-5 h-5 text-[#28B8A7]"></i>
                            <span>Lihat Semua Layanan</span>
                        </a>
                    </div>

                    <!-- Trust Stats Counter -->
                    <div class="pt-6 grid grid-cols-3 gap-4 border-t border-white/10 max-w-lg mx-auto lg:mx-0">
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-white block">4.9/5.0</span>
                            <span class="text-xs text-slate-400">Rating Kepuasan</span>
                        </div>
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-[#28B8A7] block">15.000+</span>
                            <span class="text-xs text-slate-400">Order Selesai</span>
                        </div>
                        <div>
                            <span class="text-2xl sm:text-3xl font-extrabold text-[#F2BD63] block">100%</span>
                            <span class="text-xs text-slate-400">Garansi Layanan</span>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Dual Service Interactive Showcase Cards -->
                <div class="lg:col-span-5 relative">
                    <div class="relative mx-auto max-w-md lg:max-w-none space-y-4">
                        
                        <!-- Card 1: Car Wash Showcase -->
                        <a href="{{ route('car-wash') }}" class="block group">
                            <div class="relative overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-5 hover:border-[#28B8A7]/50 hover:bg-white/15 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-white/20">
                                        <img src="https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=300&q=80" alt="Car Wash" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7]">Layanan Otomotif</span>
                                            <span class="text-xs text-[#F2BD63] font-semibold flex items-center gap-0.5">
                                                <i data-lucide="star" class="w-3 h-3 fill-current"></i> 4.9
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-bold text-white group-hover:text-[#28B8A7] transition">Car Wash & Detailing</h3>
                                        <p class="text-xs text-slate-300 line-clamp-1 mt-0.5">Cuci hidrolik salju, interior deep clean, poles bodi & nano ceramic.</p>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-[#28B8A7] group-hover:translate-x-1 transition-all">
                                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Card 2: Home Cleaning Showcase -->
                        <a href="{{ route('home-cleaning') }}" class="block group">
                            <div class="relative overflow-hidden rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 p-5 hover:border-[#28B8A7]/50 hover:bg-white/15 transition-all duration-300">
                                <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0 border border-white/20">
                                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=300&q=80" alt="Home Cleaning" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-bold uppercase tracking-wider text-[#F2BD63]">Layanan Hunian</span>
                                            <span class="text-xs text-[#F2BD63] font-semibold flex items-center gap-0.5">
                                                <i data-lucide="star" class="w-3 h-3 fill-current"></i> 5.0
                                            </span>
                                        </div>
                                        <h3 class="text-lg font-bold text-white group-hover:text-[#28B8A7] transition">Home Cleaning Service</h3>
                                        <p class="text-xs text-slate-300 line-clamp-1 mt-0.5">Deep cleaning rumah, pembersihan kerak kamar mandi & degreasing dapur.</p>
                                    </div>
                                    <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center text-white group-hover:bg-[#28B8A7] group-hover:translate-x-1 transition-all">
                                        <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <!-- Fast Booking Banner Box -->
                        <div class="p-4 rounded-2xl bg-gradient-to-r from-[#28B8A7]/20 to-teal-900/40 border border-[#28B8A7]/30 flex items-center justify-between text-xs text-slate-300">
                            <div class="flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-5 h-5 text-[#28B8A7]"></i>
                                <span>Peralatan higienis & staf terverifikasi bebas catatan kriminal.</span>
                            </div>
                            <span class="font-bold text-white uppercase tracking-wider text-[10px] bg-[#28B8A7] px-2 py-0.5 rounded">Aman</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: TWO PILLARS (Car Wash & Home Cleaning Overview) -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Dua Solusi Utama Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight">
                    Perawatan Ahli untuk Mobil dan Hunian Anda
                </h2>
                <p class="text-slate-600 text-base">
                    Kami hadir menyatukan standar kualitas profesional tertinggi dalam satu tempat, menghemat waktu berharga Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Pillar 1: Car Wash -->
                <div class="relative overflow-hidden rounded-3xl bg-[#F5F8F7] border border-slate-200/80 p-8 sm:p-10 hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl bg-[#142B3B] text-[#28B8A7] flex items-center justify-center shadow-lg">
                                <i data-lucide="car" class="w-7 h-7"></i>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#142B3B] bg-white px-3 py-1.5 rounded-full border border-slate-200">
                                Mulai Rp 60.000
                            </span>
                        </div>

                        <div>
                            <h3 class="text-2xl font-extrabold text-[#142B3B] group-hover:text-[#28B8A7] transition">
                                Car Wash & Auto Detailing
                            </h3>
                            <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                                Kembalikan kemewahan dan kilau orisinil mobil Anda dengan proses pencucian hidrolik bertekanan tinggi, sampo ber-pH netral yang aman untuk pernis, pembersihan interior higienis, hingga perlindungan cat Nano Ceramic Coating bersertifikat.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Sampo Ph Balance Aman</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Hidrolik Lift Kolong</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Fogging Anti-Bakteri</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Workshop & Home Service</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 mt-6 border-t border-slate-200/80 flex items-center justify-between">
                        <a href="{{ route('car-wash') }}" class="font-bold text-sm text-[#142B3B] hover:text-[#28B8A7] flex items-center gap-1.5 transition">
                            <span>Jelajahi Paket Car Wash</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <a href="{{ route('booking', ['category' => 'car-wash']) }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-[#142B3B] hover:bg-[#28B8A7] transition">
                            Book Car Wash
                        </a>
                    </div>
                </div>

                <!-- Pillar 2: Home Cleaning -->
                <div class="relative overflow-hidden rounded-3xl bg-[#F5F8F7] border border-slate-200/80 p-8 sm:p-10 hover:shadow-xl transition-all duration-300 group flex flex-col justify-between">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl bg-[#28B8A7] text-white flex items-center justify-center shadow-lg">
                                <i data-lucide="sparkles" class="w-7 h-7"></i>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#142B3B] bg-white px-3 py-1.5 rounded-full border border-slate-200">
                                Mulai Rp 150.000
                            </span>
                        </div>

                        <div>
                            <h3 class="text-2xl font-extrabold text-[#142B3B] group-hover:text-[#28B8A7] transition">
                                Professional Home Cleaning
                            </h3>
                            <p class="text-sm text-slate-600 mt-2 leading-relaxed">
                                Ciptakan hunian yang selalu sehat, bersih, dan harum untuk keluarga Anda. Dari deep cleaning rumah menyeluruh, descaling kerak kamar mandi yang membandel, pembersihan minyak dapur, hingga pembersihan properti sebelum pindahan.
                            </p>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-xs font-medium text-slate-700">
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Peralatan & Chemical Lengkap</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Cleaner Terlatih & Terpercaya</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Desinfektan Ramah Keluarga</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#28B8A7]"></i>
                                <span>Jadwal Fleksibel Sesuai Kebutuhan</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 mt-6 border-t border-slate-200/80 flex items-center justify-between">
                        <a href="{{ route('home-cleaning') }}" class="font-bold text-sm text-[#142B3B] hover:text-[#28B8A7] flex items-center gap-1.5 transition">
                            <span>Jelajahi Paket Home Cleaning</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <a href="{{ route('booking', ['category' => 'home-cleaning']) }}" class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-[#28B8A7] hover:bg-[#20998a] transition">
                            Book Home Cleaning
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: FEATURED PACKAGES (Database-Driven Pricing & Packages) -->
    <section id="services" class="py-20 bg-[#F5F8F7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-14 gap-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                        Paket Unggulan
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight mt-2">
                        Pilihan Layanan Paling Diminati
                    </h2>
                    <p class="text-slate-600 text-sm mt-1">
                        Harga transparan, tanpa biaya tersembunyi, dengan jaminan kepuasan maksimal.
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('car-wash') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-white border border-slate-200 hover:border-[#28B8A7] text-slate-700 hover:text-[#28B8A7] transition">
                        Semua Car Wash
                    </a>
                    <a href="{{ route('home-cleaning') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-white border border-slate-200 hover:border-[#28B8A7] text-slate-700 hover:text-[#28B8A7] transition">
                        Semua Home Cleaning
                    </a>
                </div>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($featuredServices as $service)
                    <div class="rounded-3xl bg-white border border-slate-200/80 overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                        
                        <!-- Top Image & Badge -->
                        <div class="relative h-48 overflow-hidden bg-slate-100">
                            <img src="{{ $service->image ?: 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=600&q=80' }}"
                                 alt="{{ $service->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full text-[11px] font-bold tracking-wide uppercase shadow-sm {{ $service->category->slug === 'car-wash' ? 'bg-[#142B3B] text-white' : 'bg-[#28B8A7] text-white' }}">
                                    {{ $service->category->name }}
                                </span>
                            </div>

                            @if ($service->badge)
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-[#F2BD63] text-[#142B3B] shadow-sm">
                                        {{ $service->badge }}
                                    </span>
                                </div>
                            @endif

                            <div class="absolute bottom-3 left-4 text-white text-xs flex items-center gap-1.5">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-[#28B8A7]"></i>
                                <span>Estimasi {{ $service->duration_minutes }} Menit</span>
                            </div>
                        </div>

                        <!-- Body & Features -->
                        <div class="p-6 flex-1 flex flex-col justify-between space-y-6">
                            <div>
                                <h3 class="text-xl font-bold text-[#142B3B] group-hover:text-[#28B8A7] transition">
                                    {{ $service->name }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                                    {{ $service->summary }}
                                </p>

                                <!-- Features list -->
                                @if (!empty($service->features))
                                    <ul class="mt-4 space-y-2 text-xs text-slate-600">
                                        @foreach (array_slice($service->features, 0, 4) as $feat)
                                            <li class="flex items-start gap-2">
                                                <i data-lucide="check" class="w-3.5 h-3.5 text-[#28B8A7] shrink-0 mt-0.5"></i>
                                                <span>{{ $feat }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <!-- Price & CTA -->
                            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] uppercase font-semibold text-slate-400 block">{{ $service->price_label }}</span>
                                    <span class="text-xl font-extrabold text-[#142B3B]">{{ $service->formatted_price }}</span>
                                </div>

                                <a href="{{ route('booking', ['category' => $service->category->slug, 'service' => $service->id]) }}"
                                   class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#142B3B] group-hover:bg-[#28B8A7] transition duration-200">
                                    <span>Pesan</span>
                                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION: WHY CHOOSE US -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Keunggulan Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight">
                    Mengapa Memilih Jasmine Services?
                </h2>
                <p class="text-slate-600 text-base">
                    Komitmen kami terhadap mutu, integritas, dan kepuasan pelanggan adalah pondasi utama setiap layanan yang kami sediakan.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Advantage 1 -->
                <div class="p-8 rounded-3xl bg-[#F5F8F7] border border-slate-200/80 hover:border-[#28B8A7]/50 hover:bg-white hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-[#142B3B] text-[#28B8A7] flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#142B3B] mb-2">100% Kepuasan Terjamin</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Kami menjamin kualitas kerja maksimal. Jika ada area yang terlewatkan, tim kami siap memperbaikinya tanpa biaya tambahan.
                    </p>
                </div>

                <!-- Advantage 2 -->
                <div class="p-8 rounded-3xl bg-[#F5F8F7] border border-slate-200/80 hover:border-[#28B8A7]/50 hover:bg-white hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-[#28B8A7] text-white flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i data-lucide="user-check" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#142B3B] mb-2">Staf Profesional & Terlatih</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Seluruh teknisi car wash dan cleaner telah melalui seleksi ketat, verifikasi identitas, dan pelatihan SOP berstandar hotel bintang lima.
                    </p>
                </div>

                <!-- Advantage 3 -->
                <div class="p-8 rounded-3xl bg-[#F5F8F7] border border-slate-200/80 hover:border-[#28B8A7]/50 hover:bg-white hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-[#F2BD63] text-[#142B3B] flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i data-lucide="leaf" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#142B3B] mb-2">Bahan Ramah Lingkungan</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Chemical cuci mobil dan pembersih rumah aman untuk pernapasan, ramah bagi anak-anak dan hewan peliharaan, serta tidak merusak permukaan.
                    </p>
                </div>

                <!-- Advantage 4 -->
                <div class="p-8 rounded-3xl bg-[#F5F8F7] border border-slate-200/80 hover:border-[#28B8A7]/50 hover:bg-white hover:shadow-lg transition-all group">
                    <div class="w-12 h-12 rounded-2xl bg-teal-800 text-white flex items-center justify-center mb-6 group-hover:scale-110 transition">
                        <i data-lucide="calendar-check" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-[#142B3B] mb-2">Pemesanan Sangat Mudah</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Booking online dalam 1 menit, konfirmasi instan via WhatsApp, dan pantau status jadwal pemesanan secara transparan kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: HOW IT WORKS (4 Simple Steps) -->
    <section class="py-20 bg-gradient-to-b from-[#142B3B] to-[#0c1c27] text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-white/10 px-3 py-1 rounded-full border border-white/10">
                    Proses Praktis
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    Cara Mudah Memesan Layanan
                </h2>
                <p class="text-slate-300 text-sm">
                    Hanya dengan 4 langkah sederhana, mobil Anda kembali berkilau dan rumah Anda bersih higienis.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Step 1 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 relative group hover:bg-white/10 transition">
                    <span class="text-4xl font-extrabold text-[#28B8A7]/30 absolute top-4 right-4">01</span>
                    <div class="w-10 h-10 rounded-xl bg-[#28B8A7] text-white flex items-center justify-center mb-4 font-bold">
                        1
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">Pilih Layanan</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Pilih kategori Car Wash atau Home Cleaning dan paket perawatan yang paling sesuai dengan kebutuhan Anda.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 relative group hover:bg-white/10 transition">
                    <span class="text-4xl font-extrabold text-[#28B8A7]/30 absolute top-4 right-4">02</span>
                    <div class="w-10 h-10 rounded-xl bg-[#28B8A7] text-white flex items-center justify-center mb-4 font-bold">
                        2
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">Tentukan Jadwal</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Tentukan tanggal dan jam layanan yang Anda inginkan, serta masukkan alamat lengkap pengerjaan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 relative group hover:bg-white/10 transition">
                    <span class="text-4xl font-extrabold text-[#28B8A7]/30 absolute top-4 right-4">03</span>
                    <div class="w-10 h-10 rounded-xl bg-[#28B8A7] text-white flex items-center justify-center mb-4 font-bold">
                        3
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">Konfirmasi WhatsApp</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Sistem membuat kode unik booking Anda. Lanjutkan via WhatsApp untuk konfirmasi instan bersama Admin kami.
                    </p>
                </div>

                <!-- Step 4 -->
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 relative group hover:bg-white/10 transition">
                    <span class="text-4xl font-extrabold text-[#28B8A7]/30 absolute top-4 right-4">04</span>
                    <div class="w-10 h-10 rounded-xl bg-[#28B8A7] text-white flex items-center justify-center mb-4 font-bold">
                        4
                    </div>
                    <h3 class="text-base font-bold text-white mb-2">Pengerjaan Selesai</h3>
                    <p class="text-xs text-slate-300 leading-relaxed">
                        Tim ahli kami datang tepat waktu dan melakukan pengerjaan sampai tuntas dengan hasil bersih maksimal!
                    </p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('booking') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/30 transition">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    Mulai Booking Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION: PHOTO GALLERY -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Galeri Dokumentasi
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight">
                    Hasil Karya Bersih & Berkilau
                </h2>
                <p class="text-slate-600 text-sm">
                    Cuplikan pengerjaan nyata tim Jasmine Services pada kendaraan pelanggan dan hunian bersih bebas kuman.
                </p>
            </div>

            <!-- Gallery Grid with Modern Rounded Cards & Subtle Shadows -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($galleries as $item)
                    <div class="group relative rounded-2xl overflow-hidden aspect-square bg-slate-100 shadow-sm hover:shadow-xl transition-all duration-300">
                        <img src="{{ $item->image }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-[#142B3B]/90 via-[#142B3B]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 text-white">
                            <span class="text-[10px] font-bold text-[#28B8A7] uppercase tracking-wider">{{ $item->category_tag }}</span>
                            <h4 class="text-xs sm:text-sm font-bold line-clamp-1">{{ $item->title }}</h4>
                            <p class="text-[11px] text-slate-300 line-clamp-2 mt-0.5">{{ $item->caption }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION: TESTIMONIALS -->
    <section class="py-20 bg-[#F5F8F7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Ulasan Pelanggan
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight">
                    Apa Kata Mereka Tentang Kami?
                </h2>
                <p class="text-slate-600 text-sm">
                    Kepuasan dan senyum pelanggan kami adalah bukti komitmen keunggulan tanpa kompromi.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($testimonials as $t)
                    <div class="p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm hover:shadow-lg transition-all flex flex-col justify-between">
                        <div class="space-y-4">
                            <!-- Star Rating -->
                            <div class="flex items-center gap-1 text-[#F2BD63]">
                                @for ($i = 0; $i < $t->rating; $i++)
                                    <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                @endfor
                            </div>

                            <p class="text-sm text-slate-700 italic leading-relaxed">
                                "{{ $t->content }}"
                            </p>
                        </div>

                        <div class="pt-6 mt-6 border-t border-slate-100 flex items-center gap-3">
                            <img src="{{ $t->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=100&q=80' }}"
                                 alt="{{ $t->client_name }}"
                                 class="w-11 h-11 rounded-full object-cover border border-slate-200">
                            <div>
                                <h4 class="text-sm font-bold text-[#142B3B]">{{ $t->client_name }}</h4>
                                <span class="text-xs text-slate-400 block">{{ $t->client_title }}</span>
                                @if ($t->service_name)
                                    <span class="text-[10px] font-semibold text-[#28B8A7]">{{ $t->service_name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- SECTION: FREQUENTLY ASKED QUESTIONS (FAQ with Alpine.js) -->
    <section class="py-20 bg-white" x-data="{ activeFaq: 1 }">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-14 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Pertanyaan Umum
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight">
                    Frequently Asked Questions (FAQ)
                </h2>
                <p class="text-slate-600 text-sm">
                    Jawaban untuk pertanyaan yang paling sering ditanyakan oleh pelanggan kami.
                </p>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <div class="border border-slate-200 rounded-2xl overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 1 ? null : 1)"
                            type="button"
                            class="w-full px-6 py-4 text-left font-bold text-sm text-[#142B3B] flex items-center justify-between hover:bg-slate-50 transition">
                        <span>Apakah layanan Car Wash bisa datang ke rumah (Home Service)?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeFaq === 1 ? 'rotate-180 text-[#28B8A7]' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 1" x-collapse class="px-6 pb-5 pt-1 text-xs text-slate-600 leading-relaxed border-t border-slate-100 bg-slate-50/50">
                        Ya, betul! Kami memiliki armada van keliling khusus yang dilengkapi dengan tangki air mandiri, generator listrik, dan mesin kompresor cuci uap salju. Anda cukup memilih opsi "Home Service" saat mengisi formulir booking.
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border border-slate-200 rounded-2xl overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 2 ? null : 2)"
                            type="button"
                            class="w-full px-6 py-4 text-left font-bold text-sm text-[#142B3B] flex items-center justify-between hover:bg-slate-50 transition">
                        <span>Apakah chemical yang digunakan untuk Home Cleaning aman untuk bayi & hewan?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeFaq === 2 ? 'rotate-180 text-[#28B8A7]' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 2" x-collapse class="px-6 pb-5 pt-1 text-xs text-slate-600 leading-relaxed border-t border-slate-100 bg-slate-50/50" x-cloak>
                        Sangat aman. Kami menggunakan formula pembersih bersertifikasi food-grade dan ramah lingkungan yang tidak mengandung zat kimia korosif berbahaya atau bau menyengat yang mengganggu pernapasan anak-anak maupun anabul.
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border border-slate-200 rounded-2xl overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 3 ? null : 3)"
                            type="button"
                            class="w-full px-6 py-4 text-left font-bold text-sm text-[#142B3B] flex items-center justify-between hover:bg-slate-50 transition">
                        <span>Apakah saya perlu menyiapkan alat atau cairan pembersih sendiri?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeFaq === 3 ? 'rotate-180 text-[#28B8A7]' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 3" x-collapse class="px-6 pb-5 pt-1 text-xs text-slate-600 leading-relaxed border-t border-slate-100 bg-slate-50/50" x-cloak>
                        Tidak perlu sama sekali! Tim Jasmine Services membawa seluruh peralatan lengkap: vacuum cleaner berdaya hisap tinggi, kain microfiber steril berkode warna, tangga lipat, mop rotari, hingga seluruh chemical pembersih spesifik.
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border border-slate-200 rounded-2xl overflow-hidden transition">
                    <button @click="activeFaq = (activeFaq === 4 ? null : 4)"
                            type="button"
                            class="w-full px-6 py-4 text-left font-bold text-sm text-[#142B3B] flex items-center justify-between hover:bg-slate-50 transition">
                        <span>Bagaimana cara melakukan pembayaran?</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="activeFaq === 4 ? 'rotate-180 text-[#28B8A7]' : ''"></i>
                    </button>
                    <div x-show="activeFaq === 4" x-collapse class="px-6 pb-5 pt-1 text-xs text-slate-600 leading-relaxed border-t border-slate-100 bg-slate-50/50" x-cloak>
                        Untuk kenyamanan dan kepastian pelanggan, pembayaran dapat dilakukan setelah pengerjaan selesai diperiksa (Cash on Completion / Transfer Bank / QRIS). Tidak ada deposit uang muka yang merepotkan.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CALL TO ACTION BANNER -->
    <section class="py-16 bg-[#142B3B] relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="max-w-3xl mx-auto space-y-6">
                <span class="text-xs font-bold uppercase tracking-wider text-[#F2BD63] bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">
                    Solusi Bersih Tanpa Repot
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight leading-tight">
                    Siap Merasakan Pengalaman Kebersihan Terbaik Hari Ini?
                </h2>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    Pesan sekarang dalam hitungan menit dan nikmati diskon khusus pelanggan baru serta garansi kepuasan 100%.
                </p>
                <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="{{ route('booking') }}" class="w-full sm:w-auto px-8 py-4 rounded-xl font-bold text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-xl shadow-[#28B8A7]/30 transition">
                        Pesan Layanan Sekarang
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $siteSettings['whatsapp_number']) }}" target="_blank" class="w-full sm:w-auto px-8 py-4 rounded-xl font-semibold text-white bg-white/10 hover:bg-white/20 border border-white/10 transition">
                        Tanya Admin via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

