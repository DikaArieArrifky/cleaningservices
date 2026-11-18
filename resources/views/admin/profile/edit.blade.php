@extends('layouts.admin')

@section('title', 'Profil & Keamanan Akun')
@section('header_title', 'Profil & Keamanan Akun')

@section('content')
    <div class="max-w-4xl mx-auto space-y-8">
        
        <!-- Header Info -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#142B3B] to-[#28B8A7] text-white flex items-center justify-center font-extrabold text-xl shadow-md">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 class="text-lg font-bold text-[#142B3B]">{{ $user->name }}</h3>
                    <p class="text-xs text-slate-400">{{ $user->email }} • <span class="text-[#28B8A7] font-semibold">Administrator</span></p>
                </div>
            </div>
            <span class="px-3 py-1 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                Akun Terverifikasi
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            
            <!-- Card 1: Informasi Profil -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div>
                    <h4 class="font-bold text-base text-[#142B3B]">Informasi Akun</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Perbarui nama dan alamat email login Anda.</p>
                </div>

                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                        @error('name') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs font-semibold">
                        @error('email') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-xs text-white bg-[#142B3B] hover:bg-[#28B8A7] shadow-md transition">
                        Simpan Perubahan Akun
                    </button>
                </form>
            </div>

            <!-- Card 2: Ganti Password -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-sm space-y-6">
                <div>
                    <h4 class="font-bold text-base text-[#142B3B]">Ganti Password</h4>
                    <p class="text-xs text-slate-400 mt-0.5">Gunakan password yang kuat demi keamanan sistem.</p>
                </div>

                <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-4 text-xs">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Password Saat Ini *</label>
                        <input type="password" name="current_password" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        @error('current_password') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Password Baru (min. 8 karakter) *</label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                        @error('password') <p class="text-rose-500 text-[11px] mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block font-bold text-slate-700 uppercase tracking-wider mb-1.5">Konfirmasi Password Baru *</label>
                        <input type="password" name="password_confirmation" required
                               class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-xs">
                    </div>

                    <button type="submit" class="w-full py-3.5 rounded-xl font-bold text-xs text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-md transition">
                        Perbarui Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

