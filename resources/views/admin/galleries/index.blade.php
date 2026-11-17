@extends('layouts.admin')

@section('title', 'Manajemen Galeri')
@section('header_title', 'Kelola Portofolio Foto')

@section('content')
    <div class="space-y-6" x-data="{ createModal: false }">
        
        <!-- Header Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
            <div>
                <h3 class="text-lg font-bold text-[#142B3B]">Galeri Foto & Dokumentasi</h3>
                <p class="text-xs text-slate-400">Unggah foto hasil pengerjaan Car Wash & Home Cleaning untuk ditampilkan di website.</p>
            </div>
            <button @click="createModal = true" type="button" class="px-5 py-3 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition flex items-center gap-2 self-start sm:self-auto">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Unggah Foto Baru</span>
            </button>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse ($galleries as $g)
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between group" x-data="{ confirmDelete: false, editModal: false }">
                    <div>
                        <div class="relative aspect-video bg-slate-100 overflow-hidden">
                            <img src="{{ $g->image }}" alt="{{ $g->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute top-2 left-2 text-[10px] font-bold px-2 py-0.5 rounded-full bg-[#142B3B]/80 text-white backdrop-blur-sm">
                                {{ $g->category_tag ?? 'Service' }}
                            </span>
                        </div>
                        <div class="p-4 space-y-1">
                            <h4 class="font-bold text-xs text-[#142B3B] line-clamp-1">{{ $g->title }}</h4>
                            <p class="text-[11px] text-slate-400 line-clamp-2">{{ $g->caption }}</p>
                        </div>
                    </div>

                    <div class="p-4 pt-0 border-t border-slate-100 flex items-center justify-between text-xs">
                        <span class="text-[10px] font-semibold {{ $g->is_featured ? 'text-[#28B8A7]' : 'text-slate-400' }}">
                            {{ $g->is_featured ? '★ Beranda' : 'Umum' }}
                        </span>

                        <div class="flex items-center gap-1">
                            <button @click="editModal = true" type="button" class="p-1.5 rounded-lg text-slate-400 hover:text-[#28B8A7] hover:bg-slate-100 transition" title="Edit">
                                <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                            </button>
                            <button @click="confirmDelete = true" type="button" class="p-1.5 rounded-lg text-rose-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div x-show="editModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                        <div class="bg-white rounded-3xl p-6 max-w-md w-full space-y-4 shadow-2xl text-left text-xs">
                            <div class="flex items-center justify-between border-b pb-3">
                                <h4 class="font-bold text-sm text-[#142B3B]">Edit Informasi Foto</h4>
                                <button @click="editModal = false" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-4 h-4"></i></button>
                            </div>
                            <form action="{{ route('admin.galleries.update', $g) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Judul *</label>
                                    <input type="text" name="title" value="{{ $g->title }}" required class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Tag Kategori</label>
                                    <input type="text" name="category_tag" value="{{ $g->category_tag }}" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Car Wash / Home Cleaning">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Keterangan / Caption</label>
                                    <textarea name="caption" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200">{{ $g->caption }}</textarea>
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Ganti Foto File</label>
                                    <input type="file" name="image_file" accept="image/*" class="w-full px-3 py-2 border rounded-xl">
                                </div>
                                <div>
                                    <label class="block font-bold text-slate-700 uppercase mb-1">Atau Tautan URL Gambar</label>
                                    <input type="url" name="image_url" value="{{ str_starts_with($g->image, 'http') ? $g->image : '' }}" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                </div>
                                <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700 pt-1">
                                    <input type="checkbox" name="is_featured" value="1" {{ $g->is_featured ? 'checked' : '' }} class="rounded text-[#28B8A7]">
                                    <span>Tampilkan di Beranda</span>
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
                            <h4 class="font-bold text-base text-[#142B3B]">Hapus Foto Ini?</h4>
                            <p class="text-xs text-slate-500">Tindakan ini akan menghapus foto dari galeri website.</p>
                            <div class="flex items-center gap-3 pt-2">
                                <button @click="confirmDelete = false" type="button" class="flex-1 py-2 rounded-xl border text-xs text-slate-600">Batal</button>
                                <form action="{{ route('admin.galleries.destroy', $g) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 bg-white rounded-3xl p-12 text-center text-slate-400">
                    Belum ada foto galeri.
                </div>
            @endforelse
        </div>

        @if ($galleries->hasPages())
            <div class="p-6 bg-white rounded-3xl border border-slate-200">
                {{ $galleries->links() }}
            </div>
        @endif

        <!-- Create Modal -->
        <div x-show="createModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full space-y-4 shadow-2xl text-xs">
                <div class="flex items-center justify-between border-b pb-3">
                    <h4 class="font-bold text-base text-[#142B3B]">Unggah Foto Baru ke Galeri</h4>
                    <button @click="createModal = false" class="text-slate-400 hover:text-slate-600"><i data-lucide="x" class="w-5 h-5"></i></button>
                </div>
                <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Judul / Nama Foto *</label>
                        <input type="text" name="title" required class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Contoh: Hasil Cuci Hidrolik Salju Fortuner">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Kategori</label>
                            <select name="service_category_id" class="w-full px-3 py-2 rounded-xl border border-slate-200">
                                <option value="">Umum</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 uppercase mb-1">Tag Label</label>
                            <input type="text" name="category_tag" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Car Wash / Kitchen / Sofa">
                        </div>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Keterangan Singkat</label>
                        <textarea name="caption" rows="2" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="Penjelasan proses atau keunggulan hasil..."></textarea>
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Unggah Berkas Gambar</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full px-3 py-2 border rounded-xl">
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 uppercase mb-1">Atau Masukkan URL Gambar (Opsional)</label>
                        <input type="url" name="image_url" class="w-full px-3 py-2 rounded-xl border border-slate-200" placeholder="https://images.unsplash.com/...">
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer font-bold text-slate-700 pt-1">
                        <input type="checkbox" name="is_featured" value="1" checked class="rounded text-[#28B8A7]">
                        <span>Tampilkan di Halaman Utama (Beranda)</span>
                    </label>
                    <div class="pt-3 flex justify-end gap-2 border-t">
                        <button @click="createModal = false" type="button" class="px-5 py-2.5 rounded-xl border text-slate-600">Batal</button>
                        <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-white bg-[#28B8A7] hover:bg-[#20998a]">Upload Foto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
