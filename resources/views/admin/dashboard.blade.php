@extends('layouts.admin')

@section('title', 'Overview Dashboard')
@section('header_title', 'Ringkasan & Aktivitas')

@section('content')
    <div class="space-y-8">
        
        <!-- Welcome Banner -->
        <div class="rounded-3xl bg-gradient-to-r from-[#142B3B] to-[#1f425b] p-8 text-white flex flex-col md:flex-row md:items-center justify-between gap-6 shadow-lg">
            <div class="space-y-2">
                <span class="text-xs uppercase font-bold tracking-wider text-[#28B8A7]">Panel Administrator</span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-xs sm:text-sm text-slate-300 max-w-xl">
                    Pantau pesanan masuk secara berkala, perbarui status pengerjaan, dan kelola katalog layanan Anda dengan mudah.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.bookings.index') }}" class="px-5 py-3 rounded-xl text-xs font-bold bg-[#28B8A7] hover:bg-[#20998a] text-white shadow-md transition flex items-center gap-2">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <span>Semua Booking</span>
                </a>
                <a href="{{ route('admin.services.create') }}" class="px-5 py-3 rounded-xl text-xs font-semibold bg-white/10 hover:bg-white/20 text-white border border-white/10 transition flex items-center gap-2">
                    <i data-lucide="plus" class="w-4 h-4 text-[#28B8A7]"></i>
                    <span>Tambah Layanan</span>
                </a>
            </div>
        </div>

        <!-- Metric Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total Bookings -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-slate-400 block uppercase">Total Booking</span>
                    <span class="text-3xl font-extrabold text-[#142B3B] mt-1 block">{{ $stats['total_bookings'] }}</span>
                    <span class="text-[11px] text-slate-500 mt-1 block">Seluruh riwayat pesanan</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-[#142B3B] flex items-center justify-center">
                    <i data-lucide="calendar-check" class="w-6 h-6"></i>
                </div>
            </div>

            <!-- Card 2: Pending Bookings -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-amber-600 block uppercase">Menunggu Konfirmasi</span>
                    <span class="text-3xl font-extrabold text-amber-600 mt-1 block">{{ $stats['pending_bookings'] }}</span>
                    <span class="text-[11px] text-slate-500 mt-1 block">Perlu verifikasi admin</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-500 flex items-center justify-center">
                    <i data-lucide="clock" class="w-6 h-6"></i>
                </div>
            </div>

            <!-- Card 3: Confirmed / Active -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-blue-600 block uppercase">Terkonfirmasi</span>
                    <span class="text-3xl font-extrabold text-blue-600 mt-1 block">{{ $stats['confirmed_bookings'] }}</span>
                    <span class="text-[11px] text-slate-500 mt-1 block">Jadwal telah terkonfirmasi</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-6 h-6"></i>
                </div>
            </div>

            <!-- Card 4: Completed -->
            <div class="p-6 rounded-3xl bg-white border border-slate-200/80 shadow-sm flex items-center justify-between">
                <div>
                    <span class="text-xs font-semibold text-emerald-600 block uppercase">Pesanan Selesai</span>
                    <span class="text-3xl font-extrabold text-emerald-600 mt-1 block">{{ $stats['completed_bookings'] }}</span>
                    <span class="text-[11px] text-slate-500 mt-1 block">Layanan tuntas dikerjakan</span>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                    <i data-lucide="award" class="w-6 h-6"></i>
                </div>
            </div>
        </div>

        <!-- Section: Recent Bookings Table & Quick Inquiries -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Recent Bookings (8 Cols) -->
            <div class="lg:col-span-8 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-bold text-[#142B3B]">Pemesanan Terbaru</h3>
                        <p class="text-xs text-slate-400">Daftar transaksi reservasi yang masuk ke sistem.</p>
                    </div>
                    <a href="{{ route('admin.bookings.index') }}" class="text-xs font-bold text-[#28B8A7] hover:underline flex items-center gap-1">
                        <span>Lihat Semua</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs">
                        <thead>
                            <tr class="border-b border-slate-100 text-slate-400 uppercase tracking-wider text-[10px]">
                                <th class="pb-3 font-semibold">Kode</th>
                                <th class="pb-3 font-semibold">Pelanggan</th>
                                <th class="pb-3 font-semibold">Layanan</th>
                                <th class="pb-3 font-semibold">Jadwal</th>
                                <th class="pb-3 font-semibold">Status</th>
                                <th class="pb-3 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse ($recentBookings as $b)
                                <tr class="hover:bg-slate-50 transition">
                                    <td class="py-3.5 font-bold font-mono text-[#142B3B]">
                                        <a href="{{ route('admin.bookings.show', $b) }}" class="hover:text-[#28B8A7]">
                                            {{ $b->booking_code }}
                                        </a>
                                    </td>
                                    <td class="py-3.5">
                                        <span class="font-bold text-slate-800 block">{{ $b->customer_name }}</span>
                                        <span class="text-slate-400 text-[11px]">{{ $b->customer_phone }}</span>
                                    </td>
                                    <td class="py-3.5">
                                        <span class="font-medium text-slate-700 block">{{ $b->service?->name ?? 'Custom' }}</span>
                                        <span class="text-[10px] text-[#28B8A7] font-semibold">{{ $b->category->name }}</span>
                                    </td>
                                    <td class="py-3.5 text-slate-600">
                                        {{ \Carbon\Carbon::parse($b->service_date)->format('d M Y') }}
                                        <span class="text-[10px] text-slate-400 block">{{ $b->service_time }} WIB</span>
                                    </td>
                                    <td class="py-3.5">
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $b->status_badge_class }}">
                                            {{ $b->status_label }}
                                        </span>
                                    </td>
                                    <td class="py-3.5 text-right space-x-2">
                                        <a href="{{ route('admin.bookings.show', $b) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-[#28B8A7] hover:bg-slate-100 inline-block transition" title="Lihat Detail">
                                            <i data-lucide="eye" class="w-4 h-4"></i>
                                        </a>
                                        <a href="{{ $b->getWhatsAppUrl() }}" target="_blank" class="p-1.5 rounded-lg text-emerald-500 hover:text-emerald-700 hover:bg-emerald-50 inline-block transition" title="Chat WhatsApp">
                                            <i data-lucide="message-circle" class="w-4 h-4"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-8 text-center text-slate-400">
                                        Belum ada data booking.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Inquiries & Quick Status (4 Cols) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Unread Messages Box -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                        <h4 class="font-bold text-sm text-[#142B3B]">Pesan Masuk Terbaru</h4>
                        <a href="{{ route('admin.messages.index') }}" class="text-xs font-semibold text-[#28B8A7] hover:underline">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="space-y-3 text-xs">
                        @forelse ($unreadMessages as $msg)
                            <div class="p-3.5 rounded-2xl bg-[#F5F8F7] border border-slate-200 space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-bold text-slate-800">{{ $msg->name }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-slate-600 line-clamp-2 text-[11px]">{{ $msg->message }}</p>
                            </div>
                        @empty
                            <p class="text-slate-400 text-center py-4 text-xs">Tidak ada pesan belum dibaca.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Shortcuts Card -->
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-3">
                    <h4 class="font-bold text-sm text-[#142B3B] mb-2">Pintasan Cepat</h4>
                    <a href="{{ route('admin.services.create') }}" class="w-full flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition text-xs font-semibold text-slate-700">
                        <span class="flex items-center gap-2">
                            <i data-lucide="plus-circle" class="w-4 h-4 text-[#28B8A7]"></i>
                            Tambah Layanan Baru
                        </span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="w-full flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition text-xs font-semibold text-slate-700">
                        <span class="flex items-center gap-2">
                            <i data-lucide="upload" class="w-4 h-4 text-[#28B8A7]"></i>
                            Upload Foto Portofolio
                        </span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="w-full flex items-center justify-between p-3 rounded-xl bg-slate-50 hover:bg-slate-100 transition text-xs font-semibold text-slate-700">
                        <span class="flex items-center gap-2">
                            <i data-lucide="phone-call" class="w-4 h-4 text-[#28B8A7]"></i>
                            Ubah No WhatsApp Admin
                        </span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-400"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
