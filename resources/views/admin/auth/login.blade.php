<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator — Jasmine Services</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#142B3B] text-slate-800 font-sans antialiased min-h-screen flex items-center justify-center p-4">

    <!-- Login Container -->
    <div class="w-full max-w-md bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-slate-100 space-y-8">
        
        <!-- Brand Header -->
        <div class="text-center space-y-3">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-[#142B3B] to-[#28B8A7] text-white flex items-center justify-center mx-auto shadow-lg shadow-[#28B8A7]/25">
                <i data-lucide="shield-check" class="w-7 h-7"></i>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold text-[#142B3B] tracking-tight">
                    Jasmine<span class="text-[#28B8A7]">Admin</span>
                </h1>
                <p class="text-xs text-slate-400 mt-1">
                    Masuk ke Portal Administrator Layanan
                </p>
            </div>
        </div>

        <!-- Alert messages -->
        @if (session('error'))
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-medium">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
                @foreach ($errors->all() as $err)
                    <p>{{ $err }}</p>
                @endforeach
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Administrator</label>
                <div class="relative">
                    <i data-lucide="mail" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="email" name="email" value="{{ old('email', 'admin@jasmineservices.com') }}" required autofocus
                           class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm font-medium"
                           placeholder="admin@jasmineservices.com">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Password</label>
                <div class="relative">
                    <i data-lucide="lock" class="w-4 h-4 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                    <input type="password" name="password" required
                           class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#28B8A7] text-sm font-medium"
                           placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center gap-2 cursor-pointer text-slate-600">
                    <input type="checkbox" name="remember" class="rounded text-[#28B8A7] focus:ring-[#28B8A7]">
                    <span>Ingat Saya</span>
                </label>
                <span class="text-slate-400 text-[11px]">Akses Khusus Terbatas</span>
            </div>

            <button type="submit"
                    class="w-full py-4 rounded-xl font-bold text-sm text-white bg-[#28B8A7] hover:bg-[#20998a] shadow-lg shadow-[#28B8A7]/30 hover:-translate-y-0.5 active:translate-y-0 transition flex items-center justify-center gap-2">
                <i data-lucide="log-in" class="w-4 h-4"></i>
                <span>Masuk ke Dashboard</span>
            </button>
        </form>

        <div class="pt-4 border-t border-slate-100 text-center">
            <a href="{{ route('home') }}" class="text-xs font-semibold text-slate-500 hover:text-[#28B8A7] transition inline-flex items-center gap-1.5">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Website Utama</span>
            </a>
        </div>
    </div>

</body>
</html>

