@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('header_title', 'Pengaturan Profil Website')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        
        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm space-y-6">
            <div>
                <h3 class="text-lg font-bold text-[#142B3B]">Konfigurasi Website & Kontak Resmi</h3>
                <p class="text-xs text-slate-400">Pengaturan ini akan langsung diterapkan ke seluruh tampilan halaman publik dan tombol pemesanan WhatsApp.</p>
            </div>

            <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6 text-xs">
                @csrf

                <!-- Section: Identitas Perusahaan -->
                <div class="space-y-4">
                    <h4 class="font-bold text-sm text-[#142B3B] pb-2 border-b border-slate-100 flex items-center gap-2">
                        <i data-lucide="building" class="w-4 h-4 text-[#28B8A7]"></i>
                        <span>Identitas Perusahaan</span>
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Perusahaan / Brand</label>
                            <input type="text" name="site_name" value="{{ $settings['site_name'] ?? 'Jasmine Services' }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tagline Singkat</label>
                            <input type="text" name="site_tagline" value="{{ $settings['site_tagline'] ?? '' }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        </div>
                    </div>
                </div>

                <!-- Section: Kontak & Komunikasi -->
                <div class="space-y-4 pt-2">
                    <h4 class="font-bold text-sm text-[#142B3B] pb-2 border-b border-slate-100 flex items-center gap-2">
                        <i data-lucide="phone-call" class="w-4 h-4 text-[#28B8A7]"></i>
                        <span>Kontak & WhatsApp Konfirmasi</span>
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor WhatsApp Admin *</label>
                            <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] ?? '081234567890' }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-bold text-emerald-700">
                            <span class="text-[10px] text-slate-400 block mt-1">Tujuan pesan reservasi otomatis</span>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon Kantor</label>
                            <input type="text" name="phone_number" value="{{ $settings['phone_number'] ?? '+62 812-3456-7890' }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Resmi</label>
                            <input type="email" name="email_address" value="{{ $settings['email_address'] ?? 'halo@jasmineservices.id' }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Workshop & Kantor Pusat</label>
                            <textarea name="office_address" rows="3"
                                      class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">{{ $settings['office_address'] ?? '' }}</textarea>
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jam Operasional</label>
                            <input type="text" name="operating_hours" value="{{ $settings['operating_hours'] ?? 'Senin - Minggu: 08:00 - 18:00 WIB' }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                            <span class="text-[10px] text-slate-400 block mt-1">Contoh: Senin - Minggu: 08:00 - 18:00 WIB</span>
                        </div>
                    </div>
                </div>

                <!-- Section: Media Sosial & Maps -->
                <div class="space-y-4 pt-2">
                    <h4 class="font-bold text-sm text-[#142B3B] pb-2 border-b border-slate-100 flex items-center gap-2">
                        <i data-lucide="share-2" class="w-4 h-4 text-[#28B8A7]"></i>
                        <span>Media Sosial & Lokasi Peta</span>
                    </h4>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL Akun Instagram</label>
                            <input type="url" name="instagram_url" value="{{ $settings['instagram_url'] ?? '' }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs"
                                   placeholder="https://instagram.com/...">
                        </div>

                        <div>
                            <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL Halaman Facebook</label>
                            <input type="url" name="facebook_url" value="{{ $settings['facebook_url'] ?? '' }}"
                                   class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs"
                                   placeholder="https://facebook.com/...">
                        </div>
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Embed Link Google Maps (src iframe)</label>
                        <input type="text" name="google_maps_embed" value="{{ $settings['google_maps_embed'] ?? '' }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs"
                               placeholder="https://www.google.com/maps/embed?pb=...">
                    </div>
                </div>

                <!-- Section: Teks Beranda (Hero) -->
                <div class="space-y-4 pt-2">
                    <h4 class="font-bold text-sm text-[#142B3B] pb-2 border-b border-slate-100 flex items-center gap-2">
                        <i data-lucide="layout" class="w-4 h-4 text-[#28B8A7]"></i>
                        <span>Teks Hero di Halaman Beranda</span>
                    </h4>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Utama (Headline)</label>
                        <input type="text" name="hero_title" value="{{ $settings['hero_title'] ?? '' }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Sub-Judul (Deskripsi Singkat)</label>
                        <textarea name="hero_subtitle" rows="2"
                                  class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex justify-end">
                    <button type="submit" class="px-8 py-3.5 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/30 transition">
                        Simpan Semua Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
