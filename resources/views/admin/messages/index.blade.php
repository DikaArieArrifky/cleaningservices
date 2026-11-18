@extends('layouts.admin')

@section('title', 'Pesan Masuk')
@section('header_title', 'Pesan Kontak & Pertanyaan Pelanggan')

@section('content')
    <div class="space-y-6">
        
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div>
                <h3 class="text-lg font-bold text-[#142B3B]">Pesan & Pertanyaan Masuk</h3>
                <p class="text-xs text-slate-400">Daftar formulir kontak yang dikirimkan oleh calon pelanggan melalui halaman Kontak.</p>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/80 shadow-sm overflow-hidden">
            <div class="divide-y divide-slate-100">
                @forelse ($messages as $msg)
                    <div class="p-6 transition {{ $msg->is_read ? 'bg-white' : 'bg-teal-50/30' }} flex flex-col md:flex-row md:items-start justify-between gap-4" x-data="{ confirmDelete: false }">
                        <div class="space-y-2 flex-1">
                            <div class="flex items-center gap-3">
                                <h4 class="font-bold text-sm text-[#142B3B]">{{ $msg->name }}</h4>
                                @if (! $msg->is_read)
                                    <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#28B8A7] text-white">Baru</span>
                                @endif
                                <span class="text-slate-400 text-xs">• {{ $msg->created_at->translatedFormat('d M Y, H:i') }}</span>
                            </div>

                            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-500">
                                <a href="mailto:{{ $msg->email }}" class="hover:text-[#28B8A7] flex items-center gap-1">
                                    <i data-lucide="mail" class="w-3.5 h-3.5"></i>
                                    {{ $msg->email }}
                                </a>
                                @if ($msg->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $msg->phone) }}" target="_blank" class="hover:text-emerald-600 flex items-center gap-1">
                                        <i data-lucide="phone" class="w-3.5 h-3.5"></i>
                                        {{ $msg->phone }}
                                    </a>
                                @endif
                                @if ($msg->subject)
                                    <span class="font-semibold text-slate-700">Subjek: {{ $msg->subject }}</span>
                                @endif
                            </div>

                            <p class="text-xs text-slate-700 leading-relaxed pt-2 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                                {{ $msg->message }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center gap-2 self-end md:self-start">
                            @if (! $msg->is_read)
                                <form action="{{ route('admin.messages.read', $msg) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="p-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:text-[#28B8A7] hover:bg-slate-50 transition" title="Tandai Sudah Dibaca">
                                        <i data-lucide="check" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            @endif

                            <button @click="confirmDelete = true" type="button" class="p-2 rounded-xl border border-rose-200 text-rose-500 hover:bg-rose-50 transition" title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <!-- Delete Modal -->
                        <div x-show="confirmDelete" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
                            <div class="bg-white rounded-3xl p-6 max-w-sm w-full text-center space-y-4 shadow-2xl">
                                <h4 class="font-bold text-base text-[#142B3B]">Hapus Pesan Ini?</h4>
                                <p class="text-xs text-slate-500">Pesan dari <strong>{{ $msg->name }}</strong> akan dihapus permanen.</p>
                                <div class="flex items-center gap-3 pt-2">
                                    <button @click="confirmDelete = false" type="button" class="flex-1 py-2 rounded-xl border text-xs text-slate-600">Batal</button>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" class="flex-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full py-2 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center text-slate-400 text-xs">
                        Belum ada pesan kontak yang masuk.
                    </div>
                @endforelse
            </div>

            @if ($messages->hasPages())
                <div class="p-6 border-t border-slate-100">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

