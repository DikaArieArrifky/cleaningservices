@extends('layouts.admin')

@section('title', 'Manajemen Layanan')
@section('header_title', 'Kelola Layanan & Harga')

@section('content')
    <div class="space-y-6">
        
        <!-- Header Toolbar -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm">
            <div>
                <h3 class="text-lg font-bold text-[#142B3B]">Katalog Layanan & Tarif</h3>
                <p class="text-xs text-slate-400">Atur harga, deskripsi, durasi, dan status publikasi layanan Anda.</p>
            </div>
            <a href="{{ route('admin.services.create') }}" class="px-5 py-3 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition flex items-center gap-2 self-start sm:self-auto">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span>Tambah Layanan Baru</span>
            </a>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($services as $srv)
                <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between group" x-data="{ confirmDelete: false }">
                    <div>
                        <!-- Thumbnail -->
                        <div class="relative h-44 bg-slate-100 overflow-hidden">
                            <img src="{{ $srv->image ?: 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?auto=format&fit=crop&w=600&q=80' }}"
                                 alt="{{ $srv->name }}" class="w-full h-full object-cover">
                            
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase shadow-sm {{ $srv->category->slug === 'car-wash' ? 'bg-[#142B3B] text-white' : 'bg-[#28B8A7] text-white' }}">
                                    {{ $srv->category->name }}
                                </span>
                            </div>

                            <div class="absolute top-3 right-3 flex items-center gap-1.5">
                                <form action="{{ route('admin.services.toggle', $srv) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="px-2.5 py-1 rounded-full text-[10px] font-bold shadow-sm transition {{ $srv->is_active ? 'bg-emerald-500 text-white' : 'bg-slate-700 text-slate-300' }}">
                                        {{ $srv->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="p-6 space-y-3">
                            <div class="flex items-center justify-between">
                                <h4 class="font-bold text-base text-[#142B3B]">{{ $srv->name }}</h4>
                                @if ($srv->badge)
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-[#F2BD63] text-[#142B3B]">{{ $srv->badge }}</span>
                                @endif
                            </div>

                            <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed">{{ $srv->summary }}</p>

                            <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                                <div>
                                    <span class="text-[10px] uppercase font-semibold text-slate-400 block">{{ $srv->price_label }}</span>
                                    <span class="text-lg font-extrabold text-[#142B3B]">{{ $srv->formatted_price }}</span>
                                </div>
                                <span class="text-slate-500 font-medium">~{{ $srv->duration_minutes }} menit</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-6 pt-0 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[11px] text-slate-400">
                            {{ count($srv->features ?? []) }} Fitur
                        </span>

                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.services.edit', $srv) }}" class="p-2 rounded-lg text-slate-500 hover:text-[#28B8A7] hover:bg-slate-100 transition" title="Edit">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </a>

                            <button @click="confirmDelete = true" type="button" class="p-2 rounded-lg text-rose-400 hover:text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                        <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center space-y-4 shadow-2xl">
                            <div class="w-12 h-12 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mx-auto">
                                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
                            </div>
                            <h4 class="font-bold text-base text-[#142B3B]">Hapus Layanan Ini?</h4>
                            <p class="text-xs text-slate-500">
                                Yakin ingin menghapus layanan <strong>"{{ $srv->name }}"</strong>?
                            </p>
                            <div class="flex items-center gap-3 pt-2">
                                <button @click="confirmDelete = false" type="button" class="flex-1 py-2.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                                    Batal
                                </button>
                                <form action="{{ route('admin.services.destroy', $srv) }}" method="POST" class="flex-1">
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
            @empty
                <div class="col-span-3 bg-white rounded-3xl p-12 text-center text-slate-400">
                    Belum ada data layanan yang ditambahkan.
                </div>
            @endforelse
        </div>

        @if ($services->hasPages())
            <div class="p-6 bg-white rounded-3xl border border-slate-200 shadow-sm">
                {{ $services->links() }}
            </div>
        @endif
    </div>
@endsection
