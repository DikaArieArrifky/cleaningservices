@extends('layouts.app')

@section('title', 'Formulir Pemesanan Layanan — Jasmine Services')
@section('meta_description', 'Booking layanan Car Wash & Detailing atau Home Cleaning online dengan mudah, cepat, dan konfirmasi instan.')

@section('content')
    <!-- Header Banner -->
    <section class="bg-[#142B3B] text-white py-12 lg:py-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-2xl">
            <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">
                Layanan Cepat & Praktis
            </span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight mt-3 mb-2">
                Pemesanan Layanan
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm">
                Isi data reservasi Anda di bawah ini. Konfirmasi instan akan diteruskan langsung ke WhatsApp Admin kami.
            </p>
        </div>
    </section>

    <!-- Booking Form Wizard Section with Alpine.js -->
    <section class="py-12 bg-[#F5F8F7]"
             x-data="{
                categories: {{ Js::from($categories) }},
                selectedCategoryId: {{ $selectedCategory?->id ?? $categories->first()?->id ?? 1 }},
                selectedCategorySlug: '{{ $selectedCategory?->slug ?? 'car-wash' }}',
                services: [],
                selectedServiceId: '{{ $selectedServiceId ?? '' }}',
                selectedService: null,
                serviceLocation: 'Datang ke Workshop',

                init() {
                    this.updateServices();
                },

                onCategoryChange(id, slug) {
                    this.selectedCategoryId = id;
                    this.selectedCategorySlug = slug;
                    this.selectedServiceId = '';
                    this.selectedService = null;
                    this.updateServices();
                },

                updateServices() {
                    const cat = this.categories.find(c => c.id == this.selectedCategoryId);
                    if (cat && cat.services) {
                        this.services = cat.services;
                        if (this.selectedServiceId) {
                            this.selectedService = this.services.find(s => s.id == this.selectedServiceId) || null;
                        }
                    } else {
                        this.services = [];
                    }
                    this.$nextTick(() => {
                        if (window.renderIcons) window.renderIcons();
                    });
                },

                onServiceSelect(service) {
                    this.selectedServiceId = service.id;
                    this.selectedService = service;
                },

                formatRupiah(num) {
                    if (!num) return 'Estimasi di Tempat';
                    return 'Rp ' + Number(num).toLocaleString('id-ID');
                }
             }">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left: Form Input Fields (8 Cols) -->
                    <div class="lg:col-span-8 space-y-8">
                        
                        <!-- STEP 1: Pilih Kategori Layanan -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-[#142B3B] text-white flex items-center justify-center font-bold text-xs">1</span>
                                <h3 class="text-lg font-bold text-[#142B3B]">Pilih Kategori Layanan</h3>
                            </div>

                            <input type="hidden" name="service_category_id" :value="selectedCategoryId">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <template x-for="cat in categories" :key="cat.id">
                                    <div @click="onCategoryChange(cat.id, cat.slug)"
                                         :class="selectedCategoryId == cat.id ? 'border-[#28B8A7] bg-teal-50/50 shadow-md ring-2 ring-[#28B8A7]/20' : 'border-slate-200 bg-white hover:border-slate-300'"
                                         class="p-5 rounded-2xl border-2 cursor-pointer transition-all flex items-start gap-4">
                                        <div :class="selectedCategoryId == cat.id ? 'bg-[#28B8A7] text-white' : 'bg-slate-100 text-slate-600'"
                                             class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 transition">
                                            <i x-show="cat.slug === 'car-wash'" data-lucide="car" class="w-6 h-6"></i>
                                            <i x-show="cat.slug === 'home-cleaning'" data-lucide="sparkles" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-bold text-sm text-[#142B3B]" x-text="cat.name"></h4>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-2" x-text="cat.tagline || cat.description"></p>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            @error('service_category_id')
                                <p class="text-rose-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- STEP 2: Pilih Jenis Layanan / Paket -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-[#142B3B] text-white flex items-center justify-center font-bold text-xs">2</span>
                                <h3 class="text-lg font-bold text-[#142B3B]">Pilih Paket Layanan</h3>
                            </div>

                            <input type="hidden" name="service_id" :value="selectedServiceId">

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <template x-for="srv in services" :key="srv.id">
                                    <div @click="onServiceSelect(srv)"
                                         :class="selectedServiceId == srv.id ? 'border-[#28B8A7] bg-teal-50/40 shadow-sm ring-2 ring-[#28B8A7]/20' : 'border-slate-200 bg-white hover:border-slate-300'"
                                         class="p-4 rounded-2xl border-2 cursor-pointer transition-all flex flex-col justify-between">
                                        <div class="space-y-1">
                                            <div class="flex items-center justify-between">
                                                <h4 class="font-bold text-sm text-[#142B3B]" x-text="srv.name"></h4>
                                                <span x-show="srv.badge" class="text-[10px] font-bold px-2 py-0.5 rounded bg-[#F2BD63] text-[#142B3B]" x-text="srv.badge"></span>
                                            </div>
                                            <p class="text-[11px] text-slate-500 line-clamp-2" x-text="srv.summary"></p>
                                        </div>
                                        <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between">
                                            <span class="text-xs text-slate-400" x-text="'~' + srv.duration_minutes + ' mnt'"></span>
                                            <span class="font-extrabold text-sm text-[#28B8A7]" x-text="formatRupiah(srv.price)"></span>
                                        </div>
                                    </div>
                                </template>
                            </div>
                            @error('service_id')
                                <p class="text-rose-500 text-xs">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- STEP 3: Detail Tambahan Berdasarkan Kategori -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-[#142B3B] text-white flex items-center justify-center font-bold text-xs">3</span>
                                <h3 class="text-lg font-bold text-[#142B3B]">
                                    <span x-show="selectedCategorySlug === 'car-wash'">Spesifikasi Kendaraan</span>
                                    <span x-show="selectedCategorySlug === 'home-cleaning'">Spesifikasi Properti & Kebutuhan</span>
                                </h3>
                            </div>

                            <!-- Car Wash Specific Inputs -->
                            <div x-show="selectedCategorySlug === 'car-wash'" class="space-y-4 pt-2">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tipe / Ukuran Mobil *</label>
                                        <select name="vehicle_type" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm">
                                            <option value="Hatchback / City Car (Brio, Yaris, March)">Hatchback / City Car (Brio, Yaris, March)</option>
                                            <option value="Sedan (Civic, Camry, BMW Seri 3)">Sedan (Civic, Camry, BMW Seri 3)</option>
                                            <option value="Small / Medium SUV (HR-V, Creta, Raize)">Small / Medium SUV (HR-V, Creta, Raize)</option>
                                            <option value="Large SUV / MPV (Fortuner, Pajero, Innova, Alphard)" selected>Large SUV / MPV (Fortuner, Pajero, Innova, Alphard)</option>
                                            <option value="Luxury / Supercar">Luxury / Supercar</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Merk, Model & Warna *</label>
                                        <input type="text" name="vehicle_model" value="{{ old('vehicle_model') }}"
                                               placeholder="Contoh: Honda Civic RS 2022 Putih"
                                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Lokasi Pengerjaan *</label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                                            <input type="radio" name="service_location" value="Datang ke Workshop" checked class="text-[#28B8A7] focus:ring-[#28B8A7]">
                                            <span class="text-xs font-semibold text-slate-700">Datang ke Workshop Jasmine</span>
                                        </label>
                                        <label class="flex items-center gap-3 p-3.5 rounded-xl border border-slate-200 cursor-pointer hover:bg-slate-50">
                                            <input type="radio" name="service_location" value="Home Service (Mobil Keliling)" class="text-[#28B8A7] focus:ring-[#28B8A7]">
                                            <span class="text-xs font-semibold text-slate-700">Home Service (Panggilan ke Rumah)</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Home Cleaning Specific Inputs -->
                            <div x-show="selectedCategorySlug === 'home-cleaning'" class="space-y-4 pt-2" x-cloak>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tipe Properti *</label>
                                    <select name="property_type" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm">
                                        <option value="Rumah Tinggal (1 Lantai)">Rumah Tinggal (1 Lantai)</option>
                                        <option value="Rumah Tinggal (2+ Lantai)" selected>Rumah Tinggal (2+ Lantai)</option>
                                        <option value="Apartemen Studio">Apartemen Studio</option>
                                        <option value="Apartemen 2BR / 3BR">Apartemen 2BR / 3BR</option>
                                        <option value="Ruko / Kantor / Commercial">Ruko / Kantor / Commercial</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Fokus / Prioritas Kebersihan</label>
                                    <input type="text" name="cleaning_focus" value="{{ old('cleaning_focus') }}"
                                           placeholder="Contoh: Fokus 2 kamar tidur, kerak kaca kamar mandi, dan degreasing dapur"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- STEP 4: Informasi Pelanggan & Jadwal -->
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-4">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-full bg-[#142B3B] text-white flex items-center justify-center font-bold text-xs">4</span>
                                <h3 class="text-lg font-bold text-[#142B3B]">Data Pelanggan & Jadwal</h3>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm"
                                           placeholder="Nama Anda">
                                    @error('customer_name')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor WhatsApp Aktif *</label>
                                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" required
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm"
                                           placeholder="0812xxxxxxxx">
                                    @error('customer_phone')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email (Opsional)</label>
                                    <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm"
                                           placeholder="nama@email.com">
                                </div>

                                <div class="grid grid-cols-2 gap-2">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal *</label>
                                        <input type="date" name="service_date" value="{{ old('service_date', date('Y-m-d')) }}"
                                               min="{{ date('Y-m-d') }}" required
                                               class="w-full px-3 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm">
                                        @error('service_date')
                                            <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jam Layanan *</label>
                                        <select name="service_time" required
                                                class="w-full px-3 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm">
                                            <option value="08:00">08:00 WIB</option>
                                            <option value="09:30">09:30 WIB</option>
                                            <option value="11:00">11:00 WIB</option>
                                            <option value="13:00" selected>13:00 WIB</option>
                                            <option value="14:30">14:30 WIB</option>
                                            <option value="16:00">16:00 WIB</option>
                                            <option value="17:30">17:30 WIB</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Lengkap / Lokasi Layanan *</label>
                                <textarea name="service_address" rows="3" required
                                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm"
                                          placeholder="Jalan, Nomor Rumah, RT/RW, Patokan / Detail Apartemen...">{{ old('service_address') }}</textarea>
                                @error('service_address')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Catatan Tambahan (Opsional)</label>
                                <textarea name="notes" rows="2"
                                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm"
                                          placeholder="Instruksi khusus, permintaan khusus, dll...">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Order Live Summary Sidebar (4 Cols) -->
                    <div class="lg:col-span-4 sticky top-24">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-lg space-y-6">
                            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                                <h3 class="font-extrabold text-lg text-[#142B3B]">Ringkasan Order</h3>
                                <span class="text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full bg-teal-50 text-[#28B8A7]">
                                    Direct Booking
                                </span>
                            </div>

                            <div class="space-y-4 text-xs">
                                <div>
                                    <span class="text-slate-400 block font-semibold">Kategori:</span>
                                    <span class="font-bold text-sm text-[#142B3B]" x-text="selectedCategorySlug === 'car-wash' ? 'Car Wash & Detailing' : 'Home Cleaning Service'"></span>
                                </div>

                                <div>
                                    <span class="text-slate-400 block font-semibold">Paket yang Dipilih:</span>
                                    <span class="font-bold text-sm text-[#142B3B]" x-text="selectedService ? selectedService.name : 'Belum memilih paket'"></span>
                                </div>

                                <div>
                                    <span class="text-slate-400 block font-semibold">Estimasi Durasi:</span>
                                    <span class="font-medium text-slate-700" x-text="selectedService ? '~' + selectedService.duration_minutes + ' menit' : '-'"></span>
                                </div>

                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-slate-500 font-semibold">Estimasi Biaya:</span>
                                    <span class="text-xl font-extrabold text-[#28B8A7]" x-text="selectedService ? formatRupiah(selectedService.price) : 'Rp 0'"></span>
                                </div>
                            </div>

                            <div class="space-y-3 pt-2">
                                <button type="submit"
                                        class="w-full py-4 rounded-xl font-bold text-sm text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/30 hover:-translate-y-0.5 active:translate-y-0 transition flex items-center justify-center gap-2">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    <span>Konfirmasi & Lanjut WA</span>
                                </button>

                                <p class="text-[11px] text-center text-slate-400">
                                    Pembayaran dilakukan setelah pengerjaan selesai di tempat. Bebas biaya pembatalan.
                                </p>
                            </div>

                            <!-- Trust Badges -->
                            <div class="pt-4 border-t border-slate-100 space-y-2 text-[11px] text-slate-500">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-[#28B8A7]"></i>
                                    <span>Garansi pengerjaan ulang jika kurang puas</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="lock" class="w-4 h-4 text-[#28B8A7]"></i>
                                    <span>Data pribadi aman & terenkripsi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
