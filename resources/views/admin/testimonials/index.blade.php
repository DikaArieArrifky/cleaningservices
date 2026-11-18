@extends('layouts.admin')

@section('title', 'Manajemen Testimoni')
@section('header_title', 'Ulasan & Testimoni Pelanggan')

@section('content')
    <div class="space-y-6" x-data="{ createModal: false }">
        
        <!-- Header Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
            <div>
                <h3 class="text-lg font-bold text-[#142B3B]">Testimoni & Review Pelanggan</h3>
                <p class="text-xs text-slate-400">Kelola ulasan kepuasan pelanggan untuk membangun kredibilitas layanan.</p>
            </div>
            <button @click="createModal = true" type="button" class="px-5 py-3 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition flex items-center gap-2 self-start sm:self-auto">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Testimoni Baru</span>
            </button>
        </div>

        <!-- Testimonials List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($testimonials as $t)
                <div class="bg-white rounded-3xl border border-slate-200/80 p-6 shadow-sm flex flex-col justify-between group" x-data="{ confirmDelete: false, editModal: false }">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <!-- Rating -->
                            <div class="flex items-center gap-1 text-[#F2BD63]">
                                @for ($i = 0; $i < $t->rating; $i++)
                                    <i data-lucide="star" class="w-3.5 h-3.5 fill-current"></i>
                                @endfor
                            </div>

                            <!-- Publish Toggle -->
                            <form action="{{ route('admin.testimonials.toggle', $t) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-2.5 py-0.5 rounded-full text-[10px] font-bold transition {{ $t->is_published ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $t->is_published ? 'Publik' : 'Draft' }}
                                </button>
                            </form>
                        </div>

                        <p class="text-xs text-slate-600 italic leading-relaxed line-clamp-4">
                            "{{ $t->content }}"
                        </p>

                        <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
                            <img src="{{ $t->avatar ?: 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=100&q=80' }}"
                                 alt="{{ $t->client_name }}" class="w-10 h-10 rounded-full object-cover border">
                            <div class="flex-1">
                                <h4 class="font-bold text-xs text-[#142B3B]">{{ $t->client_name }}</h4>
                                <span class="text-[11px] text-slate-400 block">{{ $t->client_title }}</span>
                                @if ($t->service_name)
                                    <span class="text-[10px] font-semibold text-[#28B8A7]">{{ $t->service_name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-end gap-2 text-xs">
                        <button @click="editModal = true" type="button" class="p-1.5 rounded-lg text-slate-400 hover:text-[#28B8A7] hover:bg-slate-100 transition" title="Edit">
                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                        </button>
                        <button @click="confirmDelete = true" type="button" class="p-1.5 rounded-lg text-rose-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <!-- Edit Modal -->
                    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full space-y-4 shadow-2xl text-left text-xs">
                            <div class="flex items-center justify-between border-b pb-3">
                                <h4 class="font-bold text-sm text-[#142B3B]">Edit Testimoni</h4>
                                <button @click="editModal = false" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-4 h-4"></i></button>
                            </div>
                            <form action="{{ route('admin.testimonials.update', $t) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Klien *</label>
                                    <input type="text" name="client_name" value="{{ $t->client_name }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Status / Jabatan</label>
                                    <input type="text" name="client_title" value="{{ $t->client_title }}" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Pemilik Mobil / Ibu Rumah Tangga">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Nama Layanan</label>
                                    <input type="text" name="service_name" value="{{ $t->service_name }}" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Rating Bintang (1-5)</label>
                                    <select name="rating" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                        <option value="5" {{ $t->rating == 5 ? 'selected' : '' }}>5 Bintang (Sangat Puas)</option>
                                        <option value="4" {{ $t->rating == 4 ? 'selected' : '' }}>4 Bintang (Puas)</option>
                                        <option value="3" {{ $t->rating == 3 ? 'selected' : '' }}>3 Bintang (Cukup)</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Isi Ulasan *</label>
                                    <textarea name="content" rows="3" required class="w-full px-3 py-2 rounded-xl border border-slate-200">{{ $t->content }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Unggah Avatar / Foto Klien</label>
                                    <input type="file" name="avatar_file" accept="image/*" class="w-full px-3 py-2 border rounded-xl">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Atau URL Foto</label>
                                    <input type="url" name="avatar_url" value="{{ str_starts_with($t->avatar, 'http') ? $t->avatar : '' }}" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                </div>
                                <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700 pt-1">
                                    <input type="checkbox" name="is_published" value="1" {{ $t->is_published ? 'checked' : '' }} class="rounded text-[#28B8A7]">
                                    <span>Publikasikan di Website</span>
                                </label>
                                <div class="pt-3 flex justify-end gap-2 border-t">
                                    <button @click="editModal = false" type="button" class="px-4 py-2 rounded-xl border text-slate-600">Batal</button>
                                    <button type="submit" class="px-4 py-2 rounded-xl font-bold text-white bg-[#28B8A7]">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                        <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center space-y-4 shadow-2xl">
                            <h4 class="font-bold text-base text-[#142B3B]">Hapus Testimoni Ini?</h4>
                            <p class="text-xs text-slate-500">Ulasan dari <strong>"{{ $t->client_name }}"</strong> akan dihapus.</p>
                            <div class="flex items-center gap-3 pt-2">
                                <button @click="confirmDelete = false" type="button" class="flex-1 py-2 rounded-xl border text-xs text-slate-600">Batal</button>
                                <form action="{{ route('admin.testimonials.destroy', $t) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center text-slate-400">
                    Belum ada testimoni.
                </div>
            @endforelse
        </div>

        <!-- Create Modal -->
        <div x-show="createModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full space-y-4 shadow-2xl text-xs">
                <div class="flex items-center justify-between border-b pb-3">
                    <h4 class="font-bold text-base text-[#142B3B]">Tambah Testimoni Baru</h4>
                    <button @click="createModal = false" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
                </div>
                <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Nama Klien *</label>
                        <input type="text" name="client_name" required class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Contoh: Hendra Kusuma">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Profesi / Kendaraan / Hunian</label>
                        <input type="text" name="client_title" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Pemilik Pajero Sport / Apartemen Pakubuwono">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Layanan yang Digunakan</label>
                        <input type="text" name="service_name" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Full Car Wash / Deep Cleaning Total">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Rating</label>
                        <select name="rating" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                            <option value="5" selected>5 Bintang</option>
                            <option value="4">4 Bintang</option>
                            <option value="3">3 Bintang</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Isi Ulasan Testimoni *</label>
                        <textarea name="content" rows="3" required class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Tuliskan ulasan pelanggan..."></textarea>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Unggah Foto Avatar</label>
                        <input type="file" name="avatar_file" accept="image/*" class="w-full px-3 py-2 border rounded-xl">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Atau URL Foto Klien</label>
                        <input type="url" name="avatar_url" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="https://images.unsplash.com/...">
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700 pt-1">
                        <input type="checkbox" name="is_published" value="1" checked class="rounded text-[#28B8A7]">
                        <span>Langsung Publikasikan</span>
                    </label>
                    <div class="pt-3 flex justify-end gap-2 border-t">
                        <button @click="createModal = false" type="button" class="px-4 py-2 rounded-xl border text-slate-600">Batal</button>
                        <button type="submit" class="px-5 py-2 rounded-xl font-bold text-white bg-[#28B8A7]">Simpan Testimoni</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

