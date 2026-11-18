@extends('layouts.app')

@section('title', 'Lacak Status Pemesanan — Jasmine Services')
@section('meta_description', 'Periksa perkembangan dan status jadwal pemesanan Car Wash atau Home Cleaning Anda secara online.')

@section('content')
    <section class="bg-[#142B3B] text-white py-14 lg:py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl relative z-10">
            <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">
                Tracking Online
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mt-4 mb-2">
                Lacak Status Pemesanan
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm">
                Masukkan kode booking (contoh: JAS-20261117-XXXX) atau nomor WhatsApp yang Anda gunakan saat pemesanan.
            </p>
        </div>
    </section>

    <section class="py-16 bg-[#F5F8F7]">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            <!-- Search Input Box -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-md">
                <form action="{{ route('booking.track') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                    <div class="relative flex-1">
                        <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                        <input type="text" name="q" value="{{ $query }}" required
                               placeholder="Masukkan Kode Booking atau No WhatsApp..."
                               class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm font-medium">
                    </div>
                    <button type="submit"
                            class="px-8 py-3.5 rounded-xl font-bold text-sm text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition flex items-center justify-center gap-2">
                        <span>Cari Status</span>
                    </button>
                </form>
            </div>

            <!-- Result Box -->
            @if ($query)
                @if ($booking)
                    <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-lg space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between pb-6 border-b border-slate-100 gap-4">
                            <div>
                                <span class="text-xs text-slate-400 font-semibold block uppercase">Kode Booking:</span>
                                <span class="text-2xl font-black text-[#142B3B] font-mono">{{ $booking->booking_code }}</span>
                            </div>
                            <div>
                                <span class="px-4 py-1.5 rounded-full text-xs font-bold border {{ $booking->status_badge_class }}">
                                    {{ $booking->status_label }}
                                </span>
                            </div>
                        </div>

                        <!-- Progress Steps Tracker -->
                        @php
                            $statuses = ['pending', 'confirmed', 'in_progress', 'completed'];
                            $currentIndex = array_search($booking->status, $statuses);
                            if ($currentIndex === false && $booking->status === 'cancelled') {
                                $currentIndex = -1;
                            }
                        @endphp

                        @if ($booking->status === 'cancelled')
                            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs">
                                <strong>Pemesanan Dibatalkan:</strong> Pemesanan ini berstatus dibatalkan. Jika Anda membutuhkan informasi lebih lanjut, silakan hubungi tim kami melalui WhatsApp.
                            </div>
                        @else
                            <div class="py-4">
                                <div class="grid grid-cols-4 gap-2 text-center text-xs">
                                    <div class="{{ $currentIndex >= 0 ? 'text-[#28B8A7] font-bold' : 'text-slate-400' }}">
                                        <div class="w-8 h-8 rounded-full {{ $currentIndex >= 0 ? 'bg-[#28B8A7] text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center mx-auto mb-1.5">
                                            1
                                        </div>
                                        <span>Menunggu</span>
                                    </div>

                                    <div class="{{ $currentIndex >= 1 ? 'text-[#28B8A7] font-bold' : 'text-slate-400' }}">
                                        <div class="w-8 h-8 rounded-full {{ $currentIndex >= 1 ? 'bg-[#28B8A7] text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center mx-auto mb-1.5">
                                            2
                                        </div>
                                        <span>Terkonfirmasi</span>
                                    </div>

                                    <div class="{{ $currentIndex >= 2 ? 'text-[#28B8A7] font-bold' : 'text-slate-400' }}">
                                        <div class="w-8 h-8 rounded-full {{ $currentIndex >= 2 ? 'bg-[#28B8A7] text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center mx-auto mb-1.5">
                                            3
                                        </div>
                                        <span>Dikerjakan</span>
                                    </div>

                                    <div class="{{ $currentIndex >= 3 ? 'text-emerald-600 font-bold' : 'text-slate-400' }}">
                                        <div class="w-8 h-8 rounded-full {{ $currentIndex >= 3 ? 'bg-emerald-500 text-white' : 'bg-slate-200 text-slate-500' }} flex items-center justify-center mx-auto mb-1.5">
                                            4
                                        </div>
                                        <span>Selesai</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Summary info -->
                        <div class="grid grid-cols-2 gap-4 text-xs pt-4 border-t border-slate-100">
                            <div>
                                <span class="text-slate-400 block font-semibold">Nama Pelanggan:</span>
                                <span class="font-bold text-slate-800">{{ $booking->customer_name }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-semibold">Nomor WhatsApp:</span>
                                <span class="font-bold text-slate-800">{{ $booking->customer_phone }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-semibold">Layanan:</span>
                                <span class="font-bold text-slate-800">{{ $booking->service?->name ?? 'Custom Service' }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-semibold">Jadwal:</span>
                                <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($booking->service_date)->format('d/m/Y') }} jam {{ $booking->service_time }} WIB</span>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('booking.confirmation', ['booking' => $booking->booking_code]) }}"
                               class="text-xs font-bold text-[#28B8A7] hover:underline flex items-center gap-1">
                                <span>Lihat Rincian Lengkap & Hubungi WhatsApp</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-3xl p-10 border border-slate-200 text-center space-y-3">
                        <div class="w-16 h-16 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto">
                            <i data-lucide="help-circle" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-lg font-bold text-[#142B3B]">Data Pemesanan Tidak Ditemukan</h3>
                        <p class="text-xs text-slate-500 max-w-sm mx-auto">
                            Tidak ditemukan jadwal pemesanan dengan kata kunci "<span class="font-mono font-bold">{{ $query }}</span>". Pastikan kode booking atau nomor telepon sudah sesuai.
                        </p>
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection

