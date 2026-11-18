@extends('layouts.app')

@section('title', 'Tentang Kami — Jasmine Services')
@section('meta_description', 'Profil perusahaan Jasmine Services, penyedia layanan Car Wash & Detailing dan Home Cleaning profesional di Indonesia.')

@section('content')
    <!-- Hero Banner About -->
    <section class="bg-[#142B3B] text-white py-16 lg:py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">
                Mengenal Jasmine Services
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mt-4 mb-4">
                Dedikasi untuk Kebersihan Hunian & Kilau Kendaraan Anda
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                Didirikan dengan visi memberikan standar pelayanan kebersihan dan detailing berkelas premium bagi masyarakat urban yang mengutamakan kualitas, kepraktisan, dan kenyamanan.
            </p>
        </div>
    </section>

    <!-- Company Story & Profile -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7]">Profil Perusahaan</span>
                    <h2 class="text-3xl font-extrabold text-[#142B3B]">
                        Mengapa Kami Memadukan Car Wash & Home Cleaning?
                    </h2>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Di tengah kesibukan sehari-hari, menjaga kebersihan kendaraan dan kenyamanan hunian sering kali menyita waktu istirahat berharga keluarga Anda. Jasmine Services hadir sebagai solusi terpadu satu pintu.
                    </p>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Kami tidak sekadar mencuci mobil atau menyapu lantai; kami menerapkan metodologi detailing berstandar internasional, sanitasi berstandar rumah sakit, dan etika kerja ramah yang menjamin rasa tenang saat tim kami bertugas di properti Anda.
                    </p>
                    <div class="grid grid-cols-2 gap-4 pt-4 border-t border-slate-100">
                        <div>
                            <span class="text-2xl font-extrabold text-[#28B8A7]">100%</span>
                            <span class="text-xs text-slate-500 block">Staf Terverifikasi & Terlatih</span>
                        </div>
                        <div>
                            <span class="text-2xl font-extrabold text-[#142B3B]">15.000+</span>
                            <span class="text-xs text-slate-500 block">Pelanggan Puas & Berulang</span>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="Tentang Jasmine Services" class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-[#142B3B] text-white p-6 rounded-2xl shadow-xl max-w-xs hidden sm:block">
                        <div class="flex items-center gap-3">
                            <i data-lucide="shield-check" class="w-8 h-8 text-[#28B8A7]"></i>
                            <div>
                                <h4 class="font-bold text-sm">Jaminan Kualitas</h4>
                                <p class="text-[11px] text-slate-300">Pengerjaan ulang gratis jika Anda kurang puas.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-20 bg-[#F5F8F7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Vision -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#142B3B] text-[#28B8A7] flex items-center justify-center font-bold">
                        <i data-lucide="eye" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-[#142B3B]">Visi Kami</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Menjadi perusahaan penyedia jasa perawatan kendaraan dan kebersihan hunian nomor satu di Indonesia yang paling dipercaya atas integritas, inovasi teknologi, dan keunggulan pelayanan pelanggan.
                    </p>
                </div>

                <!-- Mission -->
                <div class="p-8 rounded-3xl bg-white border border-slate-200/80 shadow-sm space-y-4">
                    <div class="w-12 h-12 rounded-2xl bg-[#28B8A7] text-white flex items-center justify-center font-bold">
                        <i data-lucide="target" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-2xl font-extrabold text-[#142B3B]">Misi Kami</h3>
                    <ul class="text-sm text-slate-600 space-y-2 leading-relaxed">
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-[#28B8A7] shrink-0 mt-0.5"></i>
                            <span>Memberikan layanan bermutu tinggi menggunakan peralatan modern dan ramah lingkungan.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-[#28B8A7] shrink-0 mt-0.5"></i>
                            <span>Membangun ekosistem tenaga kerja profesional yang terlatih, sejahtera, dan beretika.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check" class="w-4 h-4 text-[#28B8A7] shrink-0 mt-0.5"></i>
                            <span>Menyediakan kemudahan pemesanan digital yang transparan dan cepat bagi pelanggan.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Nilai Pelayanan
                </span>
                <h2 class="text-3xl font-extrabold text-[#142B3B]">
                    Prinsip Kerja Jasmine Services
                </h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="p-6 rounded-2xl bg-[#F5F8F7] border border-slate-200 text-center space-y-2">
                    <div class="w-12 h-12 rounded-xl bg-teal-100 text-[#28B8A7] mx-auto flex items-center justify-center">
                        <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                    </div>
                    <h4 class="font-bold text-[#142B3B] text-base">Integritas & Kejujuran</h4>
                    <p class="text-xs text-slate-500">Menjaga keamanan dan privasi rumah serta kendaraan pelanggan dengan amanah.</p>
                </div>

                <div class="p-6 rounded-2xl bg-[#F5F8F7] border border-slate-200 text-center space-y-2">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-[#F2BD63] mx-auto flex items-center justify-center">
                        <i data-lucide="clock" class="w-6 h-6"></i>
                    </div>
                    <h4 class="font-bold text-[#142B3B] text-base">Ketepatan Waktu</h4>
                    <p class="text-xs text-slate-500">Menghargai waktu pelanggan dengan hadir tepat jadwal yang disepakati.</p>
                </div>

                <div class="p-6 rounded-2xl bg-[#F5F8F7] border border-slate-200 text-center space-y-2">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-600 mx-auto flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <h4 class="font-bold text-[#142B3B] text-base">Keahlian Detail</h4>
                    <p class="text-xs text-slate-500">Mata jeli untuk sudut-sudut tersempit yang sering terlewatkan pembersih biasa.</p>
                </div>

                <div class="p-6 rounded-2xl bg-[#F5F8F7] border border-slate-200 text-center space-y-2">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-600 mx-auto flex items-center justify-center">
                        <i data-lucide="smile" class="w-6 h-6"></i>
                    </div>
                    <h4 class="font-bold text-[#142B3B] text-base">Pelayanan Ramah</h4>
                    <p class="text-xs text-slate-500">Komunikasi sopan, responsif, dan selalu siap mendengarkan preferensi Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Professional Team Section -->
    <section class="py-20 bg-[#F5F8F7]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14 space-y-3">
                <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-[#28B8A7]/10 px-3 py-1 rounded-full">
                    Tim Profesional
                </span>
                <h2 class="text-3xl font-extrabold text-[#142B3B]">
                    Didukung Tim Berpengalaman
                </h2>
                <p class="text-slate-600 text-sm">
                    Para spesialis di balik kebersihan dan kilau sempurna aset berharga Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Team 1 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm text-center p-6 space-y-4">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto border-2 border-[#28B8A7]">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=300&q=80" alt="Budi Hartono" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-[#142B3B] text-base">Budi Hartono</h4>
                        <span class="text-xs text-[#28B8A7] font-semibold">Head of Auto Detailing</span>
                        <p class="text-xs text-slate-500 mt-2">12+ tahun pengalaman dalam paint correction, ceramic coating, dan restorasi interior mobil mewah.</p>
                    </div>
                </div>

                <!-- Team 2 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm text-center p-6 space-y-4">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto border-2 border-[#28B8A7]">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=300&q=80" alt="Ratna Sari Dewi" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-[#142B3B] text-base">Ratna Sari Dewi</h4>
                        <span class="text-xs text-[#28B8A7] font-semibold">Quality & Training Manager</span>
                        <p class="text-xs text-slate-500 mt-2">Mantan supervisor housekeeping hotel bintang lima dengan sertifikasi kebersihan higienis internasional.</p>
                    </div>
                </div>

                <!-- Team 3 -->
                <div class="bg-white rounded-3xl overflow-hidden border border-slate-200 shadow-sm text-center p-6 space-y-4">
                    <div class="w-24 h-24 rounded-full overflow-hidden mx-auto border-2 border-[#28B8A7]">
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=300&q=80" alt="Dimas Pratama" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <h4 class="font-bold text-[#142B3B] text-base">Dimas Pratama</h4>
                        <span class="text-xs text-[#28B8A7] font-semibold">Customer Relations Lead</span>
                        <p class="text-xs text-slate-500 mt-2">Memastikan setiap pertanyaan dan jadwal booking terlayani dengan responsif, cepat, dan transparan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

