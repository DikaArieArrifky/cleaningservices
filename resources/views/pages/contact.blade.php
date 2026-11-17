@extends('layouts.app')

@section('title', 'Kontak Kami — Jasmine Services')
@section('meta_description', 'Hubungi customer service Jasmine Services untuk konsultasi layanan Car Wash & Detailing atau Home Cleaning. WhatsApp responsif dan siap membantu.')

@section('content')
    <!-- Hero Banner Contact -->
    <section class="bg-[#142B3B] text-white py-14 lg:py-20 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center max-w-2xl">
            <span class="text-xs font-bold uppercase tracking-wider text-[#28B8A7] bg-white/10 px-3.5 py-1.5 rounded-full border border-white/10">
                Pusat Bantuan & Konsultasi
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight mt-4 mb-3">
                Hubungi Kami
            </h1>
            <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                Punya pertanyaan mengenai paket layanan, estimasi biaya khusus, atau permintaan kemitraan bisnis? Tim kami siap melayani Anda.
            </p>
        </div>
    </section>

    <!-- Contact Details & Form Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                
                <!-- Left: Contact Cards & Operating Info -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="bg-[#F5F8F7] rounded-3xl p-8 border border-slate-200/80 space-y-6">
                        <h3 class="text-xl font-bold text-[#142B3B]">Informasi Kontak Langsung</h3>
                        
                        <div class="space-y-4">
                            <!-- WhatsApp -->
                            @php
                                $cleanWa = preg_replace('/[^0-9]/', '', $contact['whatsapp']);
                                if (str_starts_with($cleanWa, '0')) {
                                    $cleanWa = '62' . substr($cleanWa, 1);
                                }
                            @endphp
                            <a href="https://wa.me/{{ $cleanWa }}" target="_blank" rel="noopener" class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-200 hover:border-[#28B8A7] transition group">
                                <div class="w-10 h-10 rounded-xl bg-emerald-100 text-[#25D366] flex items-center justify-center shrink-0 group-hover:scale-110 transition">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs text-slate-400 font-semibold block uppercase">WhatsApp Admin</span>
                                    <span class="text-sm font-bold text-[#142B3B] group-hover:text-[#28B8A7]">{{ $contact['whatsapp'] }}</span>
                                    <span class="text-[11px] text-emerald-600 block mt-0.5">Responsif dalam beberapa menit</span>
                                </div>
                            </a>

                            <!-- Phone -->
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contact['phone']) }}" class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-200 hover:border-[#28B8A7] transition group">
                                <div class="w-10 h-10 rounded-xl bg-blue-100 text-[#142B3B] flex items-center justify-center shrink-0 group-hover:scale-110 transition">
                                    <i data-lucide="phone" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs text-slate-400 font-semibold block uppercase">Telepon Kantor</span>
                                    <span class="text-sm font-bold text-[#142B3B] group-hover:text-[#28B8A7]">{{ $contact['phone'] }}</span>
                                    <span class="text-[11px] text-slate-500 block mt-0.5">Hubungi selama jam operasional</span>
                                </div>
                            </a>

                            <!-- Email -->
                            <a href="mailto:{{ $contact['email'] }}" class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-200 hover:border-[#28B8A7] transition group">
                                <div class="w-10 h-10 rounded-xl bg-teal-100 text-[#28B8A7] flex items-center justify-center shrink-0 group-hover:scale-110 transition">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs text-slate-400 font-semibold block uppercase">Email Resmi</span>
                                    <span class="text-sm font-bold text-[#142B3B] group-hover:text-[#28B8A7]">{{ $contact['email'] }}</span>
                                    <span class="text-[11px] text-slate-500 block mt-0.5">Untuk penawaran kerja sama</span>
                                </div>
                            </a>

                            <!-- Address -->
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-200">
                                <div class="w-10 h-10 rounded-xl bg-amber-100 text-[#F2BD63] flex items-center justify-center shrink-0">
                                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs text-slate-400 font-semibold block uppercase">Lokasi Workshop & Kantor</span>
                                    <span class="text-xs font-semibold text-[#142B3B] leading-relaxed block">{{ $contact['address'] }}</span>
                                </div>
                            </div>

                            <!-- Operating Hours -->
                            <div class="flex items-start gap-4 p-4 rounded-2xl bg-white border border-slate-200">
                                <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center shrink-0">
                                    <i data-lucide="clock" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <span class="text-xs text-slate-400 font-semibold block uppercase">Jam Operasional</span>
                                    <span class="text-xs font-semibold text-[#142B3B] leading-relaxed block">{{ $contact['hours'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Interactive Contact Message Form -->
                <div class="lg:col-span-7">
                    <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-200 shadow-sm">
                        <div class="mb-8">
                            <h3 class="text-2xl font-bold text-[#142B3B]">Kirimkan Pesan Anda</h3>
                            <p class="text-xs text-slate-500 mt-1">
                                Isi formulir di bawah ini dan kami akan membalas pertanyaan Anda dalam waktu maksimal 1x24 jam kerja.
                            </p>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                                    <input type="text" name="name" value="{{ old('name') }}" required
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] focus:border-transparent text-sm"
                                           placeholder="Contoh: Aditya Pratama">
                                    @error('name')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email *</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] focus:border-transparent text-sm"
                                           placeholder="nama@email.com">
                                    @error('email')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon / WA</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] focus:border-transparent text-sm"
                                           placeholder="0812xxxxxxx">
                                    @error('phone')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Subjek / Topik</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}"
                                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] focus:border-transparent text-sm"
                                           placeholder="Pertanyaan paket / kerja sama">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Pesan Anda *</label>
                                <textarea name="message" rows="5" required
                                          class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] focus:border-transparent text-sm"
                                          placeholder="Tuliskan pertanyaan atau kebutuhan layanan Anda secara detail...">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full py-4 rounded-xl font-bold text-sm text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/25 transition flex items-center justify-center gap-2">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Kirim Pesan Sekarang</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed Section -->
            @if ($contact['maps'])
                <div class="mt-16 rounded-3xl overflow-hidden border border-slate-200 shadow-sm">
                    <iframe src="{{ $contact['maps'] }}"
                            width="100%"
                            height="400"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Lokasi Jasmine Services">
                    </iframe>
                </div>
            @endif
        </div>
    </section>
@endsection
