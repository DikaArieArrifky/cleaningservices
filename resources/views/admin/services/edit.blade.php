@extends('layouts.admin')

@section('title', 'Edit Layanan — ' . $service->name)
@section('header_title', 'Edit Layanan: ' . $service->name)

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <a href="{{ route('admin.services.index') }}" class="text-xs font-semibold text-slate-500 hover:text-[#142B3B] flex items-center gap-1.5 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali ke Daftar Layanan</span>
        </a>

        <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-xs">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Layanan *</label>
                        <input type="text" name="name" value="{{ old('name', $service->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                        @error('name') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori Layanan *</label>
                        <select name="service_category_id" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('service_category_id', $service->service_category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_category_id') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Harga (Rp) *</label>
                        <input type="number" name="price" value="{{ old('price', $service->price) }}" step="1000" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                        @error('price') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Label Harga</label>
                        <input type="text" name="price_label" value="{{ old('price_label', $service->price_label) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Durasi (Menit) *</label>
                        <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $service->duration_minutes) }}" step="5" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                    </div>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ringkasan Singkat (Summary)</label>
                    <input type="text" name="summary" value="{{ old('summary', $service->summary) }}"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap</label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">{{ old('description', $service->description) }}</textarea>
                </div>

                <div>
                    <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Daftar Fitur / Benefit (1 baris per fitur)</label>
                    <textarea name="features" rows="4"
                              class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">{{ old('features', implode("\n", $service->features ?? [])) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ganti Foto Layanan</label>
                        <input type="file" name="image" accept="image/*"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs">
                        @if ($service->image)
                            <div class="mt-2 flex items-center gap-2">
                                <img src="{{ $service->image }}" alt="Current" class="w-10 h-10 object-cover rounded-lg border">
                                <span class="text-[11px] text-slate-400">Foto aktif saat ini</span>
                            </div>
                        @endif
                        @error('image') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Badge Promo (Opsional)</label>
                        <input type="text" name="badge" value="{{ old('badge', $service->badge) }}"
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                    </div>
                </div>

                <div class="flex items-center gap-6 pt-2">
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $service->is_featured) ? 'checked' : '' }}
                               class="rounded text-[#28B8A7] focus:ring-[#28B8A7]">
                        <span>Tampilkan di Paket Unggulan Beranda</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}
                               class="rounded text-[#28B8A7] focus:ring-[#28B8A7]">
                        <span>Status Aktif (Tersedia untuk Dipesan)</span>
                    </label>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.services.index') }}" class="px-5 py-3 rounded-xl border border-slate-200 font-semibold text-slate-600 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 rounded-xl font-bold text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

