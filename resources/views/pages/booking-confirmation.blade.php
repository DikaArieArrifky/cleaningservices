@extends('layouts.app')

@section('title', 'Konfirmasi Pemesanan #' . $booking->booking_code . ' — Jasmine Services')

@section('content')
    <section class="py-16 bg-[#F5F8F7]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Success Card -->
            <div class="bg-white rounded-3xl p-8 sm:p-12 border border-slate-200/80 shadow-xl space-y-8 text-center">
                
                <!-- Icon & Headline -->
                <div class="space-y-3">
                    <div class="w-20 h-20 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto shadow-inner">
                        <i data-lucide="check" class="w-10 h-10"></i>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-teal-50 px-3.5 py-1.5 rounded-full inline-block">
                        Pemesanan Berhasil Terkirim
                    </span>
                    <h1 class="text-3xl font-extrabold text-[#142B3B] tracking-tight">
                        Terima Kasih, {{ $booking->customer_name }}!
                    </h1>
                    <p class="text-sm text-slate-500 max-w-md mx-auto">
                        Pemesanan Anda telah tercatat di sistem kami. Silakan klik tombol di bawah untuk melanjutkan konfirmasi instan bersama Admin via WhatsApp.
                    </p>
                </div>

                <!-- Unique Booking Code Highlight Box -->
                <div class="p-6 rounded-2xl bg-[#142B3B] text-white space-y-1">
                    <span class="text-xs uppercase tracking-wider text-slate-400 font-semibold block">Kode Booking Anda:</span>
                    <span class="text-3xl font-black tracking-widest text-[#28B8A7] font-mono block">{{ $booking->booking_code }}</span>
                    <span class="text-[11px] text-slate-400 block pt-1">Simpan kode ini untuk mengecek status pesanan kapan saja.</span>
                </div>

                <!-- Order Details Breakdown Table -->
                <div class="rounded-2xl border border-slate-200 overflow-hidden text-left text-xs divide-y divide-slate-100">
                    <div class="p-4 bg-slate-50 flex items-center justify-between font-bold text-slate-700">
                        <span>Ringkasan Layanan</span>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold {{ $booking->status_badge_class }}">
                            {{ $booking->status_label }}
                        </span>
                    </div>

                    <div class="p-4 grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-slate-400 block font-semibold">Kategori:</span>
                            <span class="font-bold text-[#142B3B] text-sm">{{ $booking->category->name }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold">Paket Layanan:</span>
                            <span class="font-bold text-[#142B3B] text-sm">{{ $booking->service?->name ?? 'Layanan Spesial' }}</span>
                        </div>
                    </div>

                    <div class="p-4 grid grid-cols-2 gap-4">
                        <div>
                            <span class="text-slate-400 block font-semibold">Jadwal Tanggal:</span>
                            <span class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($booking->service_date)->translatedFormat('l, d F Y') }}</span>
                        </div>
                        <div>
                            <span class="text-slate-400 block font-semibold">Jam Layanan:</span>
                            <span class="font-bold text-slate-700">{{ $booking->service_time }} WIB</span>
                        </div>
                    </div>

                    <div class="p-4">
                        <span class="text-slate-400 block font-semibold">Alamat Tujuan:</span>
                        <span class="font-medium text-slate-700">{{ $booking->service_address }}</span>
                    </div>

                    @if (!empty($booking->metadata))
                        <div class="p-4 space-y-1.5 bg-slate-50/50">
                            @if (!empty($booking->metadata['vehicle_type']))
                                <div>
                                    <span class="text-slate-400 font-semibold">Kendaraan:</span>
                                    <span class="font-medium text-slate-700">{{ $booking->metadata['vehicle_type'] }} ({{ $booking->metadata['vehicle_model'] ?? '-' }})</span>
                                </div>
                            @endif
                            @if (!empty($booking->metadata['service_location']))
                                <div>
                                    <span class="text-slate-400 font-semibold">Tipe Layanan:</span>
                                    <span class="font-medium text-slate-700">{{ $booking->metadata['service_location'] }}</span>
                                </div>
                            @endif
                            @if (!empty($booking->metadata['property_type']))
                                <div>
                                    <span class="text-slate-400 font-semibold">Tipe Properti:</span>
                                    <span class="font-medium text-slate-700">{{ $booking->metadata['property_type'] }}</span>
                                </div>
                            @endif
                            @if (!empty($booking->metadata['cleaning_focus']))
                                <div>
                                    <span class="text-slate-400 font-semibold">Fokus Kebersihan:</span>
                                    <span class="font-medium text-slate-700">{{ $booking->metadata['cleaning_focus'] }}</span>
                                </div>
                            @endif
                        </div>
                    @endif

                    <div class="p-4 flex items-center justify-between font-bold bg-slate-50">
                        <span class="text-slate-600">Estimasi Total Biaya:</span>
                        <span class="text-base text-[#28B8A7]">{{ $booking->formatted_total_price }}</span>
                    </div>
                </div>

                <!-- Big Green WhatsApp Button (Click-to-chat with prefilled text) -->
                <div class="space-y-3 pt-2">
                    <a href="{{ $whatsAppUrl }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="w-full py-4 px-6 rounded-2xl font-bold text-base text-white bg-[#25D366] hover:bg-[#20ba5a] shadow-xl shadow-[#25D366]/30 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-3">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                        <span>Lanjutkan Konfirmasi ke WhatsApp</span>
                    </a>

                    <p class="text-[11px] text-slate-400">
                        Pesan otomatis berisi kode booking dan rincian pesanan sudah disiapkan untuk dikirimkan ke Admin.
                    </p>
                </div>

                <!-- Secondary Actions -->
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-center gap-4 text-xs font-semibold text-slate-600">
                    <a href="{{ route('booking.track', ['q' => $booking->booking_code]) }}" class="hover:text-[#28B8A7] flex items-center gap-1.5 transition">
                        <i data-lucide="compass" class="w-4 h-4"></i>
                        Lacak Status Booking Ini
                    </a>
                    <span class="hidden sm:inline text-slate-300">•</span>
                    <a href="{{ route('home') }}" class="hover:text-[#28B8A7] flex items-center gap-1.5 transition">
                        <i data-lucide="home" class="w-4 h-4"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

