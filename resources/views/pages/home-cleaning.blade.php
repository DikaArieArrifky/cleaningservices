@extends('layouts.app')

@section('title', 'Home Cleaning Service — Jasmine Services')
@section('meta_description', 'Layanan pembersihan rumah, deep cleaning, sedot debu tungau, pembersihan kerak kamar mandi, dan apartemen profesional di Jabodetabek.')

@section('content')
    <!-- Hero Banner Home Cleaning -->
    <section class="relative bg-gradient-to-r from-[#142B3B] via-[#142B3B]/95 to-[#1c384c] text-white py-16 lg:py-24 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1600&q=80')] bg-cover bg-center mix-blend-overlay"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#28B8A7]/20 border border-[#28B8A7]/40 text-[#28B8A7] text-xs font-bold uppercase tracking-wider">
                    <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                    Certified Home Cleaning
                </span>
                <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-white leading-tight">
                    Hunian Bersih, Higienis & Menyehatkan Keluarga
                </h1>
                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ $category->description ?: 'Bebaskan waktu luang Anda dan biarkan tim terlatih kami membersihkan hunian Anda hingga ke sudut tersempit dengan peralatan modern dan chemical ramah anak.' }}
                </p>
                <div class="pt-4 flex flex-wrap items-center gap-4">
                    <a href="{{ route('booking', ['category' => 'home-cleaning']) }}" class="px-7 py-3.5 rounded-xl font-bold text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/30 transition">
                        Booking Home Cleaning Sekarang
                    </a>
                    <a href="#packages" class="px-6 py-3.5 rounded-xl font-semibold text-slate-200 bg-white/10 hover:bg-white/20 transition">
                        Lihat Paket & Harga
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services & Pricing Grid -->
    <section id="packages" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Daftar Paket & Biaya
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-[#142B3B] tracking-tight">
                    Paket Pembersihan Hunian
                </h2>
                <p class="text-slate-600 text-sm">
                    Pilihan paket fleksibel dari pembersihan rutin hingga pembersihan pasca-renovasi dan pindah rumah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($category->services as $service)
                    <div class="rounded-3xl bg-[#F5F8F7] border border-slate-200/80 p-6 flex flex-col justify-between hover:shadow-xl hover:border-[#28B8A7]/50 hover:bg-white transition-all duration-300 group">
                        <div class="space-y-4">
                            <!-- Image thumbnail -->
                            <div class="relative h-44 rounded-2xl overflow-hidden bg-slate-200">
                                <img src="{{ $service->image ?: 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=500&q=80' }}"
                                     alt="{{ $service->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @if ($service->badge)
                                    <span class="absolute top-3 right-3 text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-[#F2BD63] text-[#142B3B]">
                                        {{ $service->badge }}
                                    </span>
                                @endif
                            </div>

                            <div>
                                <h3 class="text-xl font-bold text-[#142B3B] group-hover:text-[#28B8A7] transition">
                                    {{ $service->name }}
                                </h3>
                                <p class="text-xs text-slate-500 mt-1 line-clamp-2">
                                    {{ $service->summary }}
                                </p>
                            </div>

                            <!-- Pricing -->
                            <div class="pt-3 border-t border-slate-200">
                                <span class="text-[10px] uppercase font-semibold text-slate-400 block">{{ $service->price_label }}</span>
                                <span class="text-2xl font-extrabold text-[#142B3B]">{{ $service->formatted_price }}</span>
                                <span class="text-xs text-slate-400 block mt-0.5">Estimasi durasi: ~{{ $service->duration_minutes }} menit</span>
                            </div>

                            <!-- Features -->
                            @if (!empty($service->features))
                                <ul class="space-y-2 text-xs text-slate-600 pt-2">
                                    @foreach ($service->features as $feat)
                                        <li class="flex items-start gap-2">
                                            <i data-lucide="check" class="w-3.5 h-3.5 text-[#28B8A7] shrink-0 mt-0.5"></i>
                                            <span>{{ $feat }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="pt-6 mt-6 border-t border-slate-200">
                            <a href="{{ route('booking', ['category' => 'home-cleaning', 'service' => $service->id]) }}"
                               class="w-full py-3 rounded-xl font-bold text-xs text-center block text-white bg-[#142B3B] group-hover:bg-[#28B8A7] shadow-md transition">
                                Booking Paket Ini
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Keunggulan Layanan Home Cleaning -->
    <section class="py-16 bg-[#F5F8F7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 rounded-2xl bg-white border border-slate-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-teal-50 text-[#28B8A7] flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#142B3B] text-base mb-1">Cleaner Terverifikasi</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Pemeriksaan latar belakang ketat, SKCK aktif, dan pelatihan kesopanan kerja.</p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-[#F2BD63] flex items-center justify-center shrink-0">
                        <i data-lucide="heart" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#142B3B] text-base mb-1">Ramah Anak & Hewan</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Cairan pembersih hypoallergenic bebas amonia berbahaya dan residu toksik.</p>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-white border border-slate-200 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[#142B3B] text-base mb-1">Peralatan Modern Lengkap</h4>
                        <p class="text-xs text-slate-500 leading-relaxed">Kami bawa seluruh alat, dari vacuum cyclone, mop microfiber steril, hingga steam generator.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Galeri Pekerjaan Home Cleaning -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12 space-y-2">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Hasil Pengerjaan
                </span>
                <h2 class="text-3xl font-extrabold text-[#142B3B]">
                    Dokumentasi Home Cleaning
                </h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($galleries as $item)
                    <div class="rounded-2xl overflow-hidden shadow-sm aspect-video bg-slate-100 group relative">
                        <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent flex items-end p-4 text-white">
                            <span class="text-xs font-bold">{{ $item->title }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-[#142B3B] text-white text-center">
        <div class="max-w-4xl mx-auto px-4 space-y-4">
            <h2 class="text-3xl font-extrabold">Buat Rumah Anda Bersih & Nyaman Sekarang</h2>
            <p class="text-slate-300 text-sm max-w-xl mx-auto">Tentukan jadwal fleksibel Anda dan nikmati kenyamanan rumah yang bersih terawat.</p>
            <div class="pt-4">
                <a href="{{ route('booking', ['category' => 'home-cleaning']) }}" class="px-8 py-4 rounded-xl font-bold text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/30 transition inline-flex items-center gap-2">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Booking Home Cleaning Sekarang</span>
                </a>
            </div>
        </div>
    </section>
@endsection

