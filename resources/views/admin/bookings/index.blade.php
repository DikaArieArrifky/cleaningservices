@extends('layouts.admin')

@section('title', 'Manajemen Booking')
@section('header_title', 'Daftar Semua Pemesanan')

@section('content')
    <div class="space-y-6">
        
        <!-- Filters & Search Toolbar -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm space-y-4">
            <form action="{{ route('admin.bookings.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-12 gap-4 items-center">
                <!-- Search -->
                <div class="sm:col-span-5 relative">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari kode booking, nama, WA..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-medium">
                </div>

                <!-- Category Filter -->
                <div class="sm:col-span-3">
                    <select name="category_id" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-medium">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Status Filter -->
                <div class="sm:col-span-2">
                    <select name="status" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-medium">
                        <option value="">Semua Status</option>
                        @foreach ($statusOptions as $key => $lbl)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $lbl }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit & Reset -->
                <div class="sm:col-span-2 flex items-center gap-2">
                    <button type="submit" class="flex-1 py-2.5 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.bookings.index') }}" class="p-2.5 rounded-xl border border-slate-200 text-slate-400 hover:text-slate-600 transition" title="Reset Filter">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Bookings Data Table -->
        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead>
                        <tr class="bg-slate-50/80 border-b border-slate-200 text-slate-500 uppercase tracking-wider text-[10px]">
                            <th class="py-4 px-6 font-semibold">Kode Booking</th>
                            <th class="py-4 px-6 font-semibold">Pelanggan</th>
                            <th class="py-4 px-6 font-semibold">Kategori & Layanan</th>
                            <th class="py-4 px-6 font-semibold">Jadwal Layanan</th>
                            <th class="py-4 px-6 font-semibold">Total Biaya</th>
                            <th class="py-4 px-6 font-semibold">Status</th>
                            <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($bookings as $booking)
                            <tr class="hover:bg-slate-50/60 transition">
                                <td class="py-4 px-6 font-bold font-mono text-[#142B3B]">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="hover:text-[#28B8A7] flex items-center gap-1.5">
                                        {{ $booking->booking_code }}
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-bold text-slate-800 block text-xs">{{ $booking->customer_name }}</span>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_phone) }}" target="_blank" class="text-slate-400 text-[11px] hover:text-emerald-600 flex items-center gap-1 mt-0.5">
                                        <i data-lucide="message-circle" class="w-3 h-3 text-emerald-500"></i>
                                        {{ $booking->customer_phone }}
                                    </a>
                                </td>
                                <td class="py-4 px-6">
                                    <span class="font-semibold text-slate-700 block">{{ $booking->service?->name ?? 'Custom Service' }}</span>
                                    <span class="text-[10px] text-[#28B8A7] font-semibold">{{ $booking->category->name }}</span>
                                </td>
                                <td class="py-4 px-6 text-slate-600">
                                    <span class="font-medium block">{{ \Carbon\Carbon::parse($booking->service_date)->format('d M Y') }}</span>
                                    <span class="text-[10px] text-slate-400">{{ $booking->service_time }} WIB</span>
                                </td>
                                <td class="py-4 px-6 font-extrabold text-[#142B3B]">
                                    {{ $booking->formatted_total_price }}
                                </td>
                                <td class="py-4 px-6">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $booking->status_badge_class }}">
                                        {{ $booking->status_label }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-right space-x-1 whitespace-nowrap" x-data="{ confirmDelete: false }">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" class="p-2 rounded-lg text-slate-400 hover:text-[#28B8A7] hover:bg-slate-100 inline-block transition" title="Lihat & Edit">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    
                                    <a href="{{ $booking->getWhatsAppUrl() }}" target="_blank" class="p-2 rounded-lg text-emerald-500 hover:text-emerald-700 hover:bg-emerald-50 inline-block transition" title="Kirim Pesan WhatsApp">
                                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    </a>

                                    <button @click="confirmDelete = true" type="button" class="p-2 rounded-lg text-rose-400 hover:text-rose-600 hover:bg-rose-50 inline-block transition" title="Hapus Booking">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>

                                    <!-- Delete Modal Confirmation -->
                                    <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                                        <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center space-y-4 shadow-2xl">
                                            <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto">
                                                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                                            </div>
                                            <h4 class="font-bold text-base text-[#142B3B]">Hapus Booking Ini?</h4>
                                            <p class="text-xs text-slate-500">
                                                Apakah Anda yakin ingin menghapus booking <strong>#{{ $booking->booking_code }}</strong>? Tindakan ini tidak dapat dibatalkan.
                                            </p>
                                            <div class="flex items-center gap-3 pt-2">
                                                <button @click="confirmDelete = false" type="button" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                                                    Batal
                                                </button>
                                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="flex-1">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="w-full py-2.5 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700">
                                                        Ya, Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400">
                                    Tidak ada data pemesanan yang sesuai dengan filter.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($bookings->hasPages())
                <div class="p-6 border-t border-slate-100">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

