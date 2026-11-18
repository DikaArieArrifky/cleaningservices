@extends('layouts.admin')

@section('title', 'Detail Booking #' . $booking->booking_code)
@section('header_title', 'Detail Pemesanan #' . $booking->booking_code)

@section('content')
    <div class="space-y-8" x-data="{ confirmDelete: false }">
        
        <!-- Top Action & Navigation Bar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <a href="{{ route('admin.bookings.index') }}" class="text-xs font-semibold text-slate-500 hover:text-[#142B3B] flex items-center gap-1.5 transition">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>Kembali ke Daftar Booking</span>
            </a>

            <div class="flex items-center gap-3">
                <a href="{{ $booking->getWhatsAppUrl() }}" target="_blank"
                   class="px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-[#25D366] hover:bg-[#20ba5a] shadow-md flex items-center gap-2 transition">
                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                    <span>Hubungi via WhatsApp</span>
                </a>

                <button @click="confirmDelete = true" type="button"
                        class="px-4 py-2.5 rounded-xl text-xs font-bold text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition flex items-center gap-2">
                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                    <span>Hapus Booking</span>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Customer & Service Info (7 Cols) -->
            <div class="lg:col-span-7 space-y-6">
                <!-- Overview Card -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                        <div>
                            <span class="text-xs uppercase font-semibold text-slate-400 block">Kode Reservasi</span>
                            <span class="text-2xl font-black text-[#142B3B] font-mono">{{ $booking->booking_code }}</span>
                        </div>
                        <span class="px-3.5 py-1.5 rounded-full text-xs font-bold border {{ $booking->status_badge_class }}">
                            {{ $booking->status_label }}
                        </span>
                    </div>

                    <!-- Customer Info Grid -->
                    <div class="space-y-4 text-xs">
                        <h4 class="font-bold text-sm text-[#142B3B] uppercase tracking-wider text-[11px]">Informasi Pelanggan</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-slate-400 block font-semibold">Nama:</span>
                                <span class="font-bold text-slate-800 text-sm">{{ $booking->customer_name }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-semibold">WhatsApp:</span>
                                <span class="font-bold text-slate-800 text-sm">{{ $booking->customer_phone }}</span>
                            </div>
                        </div>

                        <div>
                            <span class="text-slate-400 block font-semibold">Alamat Layanan:</span>
                            <span class="font-medium text-slate-700 leading-relaxed block mt-0.5">{{ $booking->service_address }}</span>
                        </div>

                        @if ($booking->customer_email)
                            <div>
                                <span class="text-slate-400 block font-semibold">Email:</span>
                                <span class="font-medium text-slate-700">{{ $booking->customer_email }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Service & Specs Info -->
                    <div class="space-y-4 text-xs pt-4 border-t border-slate-100">
                        <h4 class="font-bold text-sm text-[#142B3B] uppercase tracking-wider text-[11px]">Detail Layanan & Spesifikasi</h4>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-slate-400 block font-semibold">Kategori:</span>
                                <span class="font-bold text-[#28B8A7] text-sm">{{ $booking->category->name }}</span>
                            </div>
                            <div>
                                <span class="text-slate-400 block font-semibold">Paket:</span>
                                <span class="font-bold text-[#142B3B] text-sm">{{ $booking->service?->name ?? 'Custom Service' }}</span>
                            </div>
                        </div>

                        @if (!empty($booking->metadata))
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                                @if (!empty($booking->metadata['vehicle_type']))
                                    <div>
                                        <span class="text-slate-400 font-semibold">Tipe Mobil:</span>
                                        <span class="font-medium text-slate-800">{{ $booking->metadata['vehicle_type'] }}</span>
                                    </div>
                                @endif
                                @if (!empty($booking->metadata['vehicle_model']))
                                    <div>
                                        <span class="text-slate-400 font-semibold">Merk/Model Mobil:</span>
                                        <span class="font-medium text-slate-800">{{ $booking->metadata['vehicle_model'] }}</span>
                                    </div>
                                @endif
                                @if (!empty($booking->metadata['service_location']))
                                    <div>
                                        <span class="text-slate-400 font-semibold">Pilihan Tempat:</span>
                                        <span class="font-medium text-slate-800">{{ $booking->metadata['service_location'] }}</span>
                                    </div>
                                @endif
                                @if (!empty($booking->metadata['property_type']))
                                    <div>
                                        <span class="text-slate-400 font-semibold">Tipe Properti:</span>
                                        <span class="font-medium text-slate-800">{{ $booking->metadata['property_type'] }}</span>
                                    </div>
                                @endif
                                @if (!empty($booking->metadata['cleaning_focus']))
                                    <div>
                                        <span class="text-slate-400 font-semibold">Fokus Pembersihan:</span>
                                        <span class="font-medium text-slate-800">{{ $booking->metadata['cleaning_focus'] }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if ($booking->notes)
                            <div>
                                <span class="text-slate-400 block font-semibold">Catatan Khusus dari Pelanggan:</span>
                                <p class="p-3.5 rounded-xl bg-amber-50/60 border border-amber-200 text-slate-700 mt-1 italic leading-relaxed">
                                    "{{ $booking->notes }}"
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column: Edit Status & Management Form (5 Cols) -->
            <div class="lg:col-span-5 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div>
                    <h3 class="text-lg font-bold text-[#142B3B]">Kelola Status & Catatan</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Perbarui perkembangan status pengerjaan pesanan ini.</p>
                </div>

                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Status Booking *</label>
                        <select name="status" class="w-full px-3.5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                            @foreach ($statusOptions as $key => $lbl)
                                <option value="{{ $key }}" {{ old('status', $booking->status) == $key ? 'selected' : '' }}>
                                    {{ $lbl }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Total Biaya (Rp)</label>
                        <input type="number" name="total_price" value="{{ old('total_price', $booking->total_price) }}" step="1000"
                               class="w-full px-3.5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Layanan</label>
                            <input type="date" name="service_date" value="{{ old('service_date', \Carbon\Carbon::parse($booking->service_date)->format('Y-m-d')) }}"
                                   class="w-full px-3 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jam Layanan</label>
                            <input type="text" name="service_time" value="{{ old('service_time', $booking->service_time) }}"
                                   class="w-full px-3 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Catatan Internal Admin</label>
                        <textarea name="admin_notes" rows="4"
                                  class="w-full px-3.5 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs"
                                  placeholder="Contoh: Petugas Budi & Tim ditugaskan; konfirmasi sudah dilakukan via WA...">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                    </div>

                    <button type="submit"
                            class="w-full py-3.5 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

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
    </div>
@endsection

