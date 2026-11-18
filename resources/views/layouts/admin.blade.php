<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — Jasmine Services</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-slate-100 text-[#263746] font-sans antialiased" x-data="{ sidebarOpen: false }">

    <div class="min-h-screen flex">
        
        <!-- SIDEBAR -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-40 w-64 bg-[#142B3B] text-slate-300 transition-transform duration-300 ease-in-out flex flex-col justify-between border-r border-slate-800 shadow-xl">
            
            <!-- Top Logo & Navigation -->
            <div class="p-6 space-y-6">
                <!-- Brand Logo -->
                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#28B8A7] to-teal-300 flex items-center justify-center text-[#142B3B] font-black shadow-md shadow-[#28B8A7]/30">
                            <i data-lucide="sparkles" class="w-5 h-5 text-[#142B3B]"></i>
                        </div>
                        <div>
                            <span class="text-lg font-extrabold tracking-tight text-white block leading-none">
                                Jasmine<span class="text-[#28B8A7]">Admin</span>
                            </span>
                            <span class="text-[10px] uppercase font-semibold text-slate-400 block mt-0.5 tracking-wider">
                                Management Suite
                            </span>
                        </div>
                    </a>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="space-y-1 text-xs font-semibold">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Dashboard</span>
                    </a>

                    <!-- Bookings -->
                    @php
                        $pendingCount = \App\Models\Booking::where('status', \App\Models\Booking::STATUS_PENDING)->count();
                    @endphp
                    <a href="{{ route('admin.bookings.index') }}"
                       class="flex items-center justify-between px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.bookings.*') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="calendar" class="w-4 h-4"></i>
                            <span>Kelola Booking</span>
                        </div>
                        @if ($pendingCount > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#F2BD63] text-[#142B3B]">
                                {{ $pendingCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Services -->
                    <a href="{{ route('admin.services.index') }}"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.services.*') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="layers" class="w-4 h-4"></i>
                        <span>Kelola Layanan</span>
                    </a>

                    <!-- Galleries -->
                    <a href="{{ route('admin.galleries.index') }}"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.galleries.*') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="image" class="w-4 h-4"></i>
                        <span>Galeri Foto</span>
                    </a>

                    <!-- Testimonials -->
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.testimonials.*') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="star" class="w-4 h-4"></i>
                        <span>Testimoni</span>
                    </a>

                    <!-- Messages -->
                    @php
                        $unreadMsgCount = \App\Models\ContactMessage::unread()->count();
                    @endphp
                    <a href="{{ route('admin.messages.index') }}"
                       class="flex items-center justify-between px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.messages.*') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <div class="flex items-center gap-3">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>Pesan Masuk</span>
                        </div>
                        @if ($unreadMsgCount > 0)
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-extrabold bg-[#28B8A7] text-white">
                                {{ $unreadMsgCount }}
                            </span>
                        @endif
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center gap-3 px-3.5 py-3 rounded-xl transition {{ request()->routeIs('admin.settings.*') ? 'bg-[#28B8A7] text-white font-bold shadow-md shadow-[#28B8A7]/25' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                        <i data-lucide="settings" class="w-4 h-4"></i>
                        <span>Pengaturan Web</span>
                    </a>
                </nav>
            </div>

            <!-- Bottom Actions -->
            <div class="p-6 border-t border-slate-800/80 space-y-3">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800 transition">
                    <span class="flex items-center gap-2">
                        <i data-lucide="external-link" class="w-4 h-4 text-[#28B8A7]"></i>
                        Lihat Website
                    </span>
                    <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-slate-500"></i>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-xs font-semibold text-rose-400 hover:text-rose-300 hover:bg-rose-500/10 transition">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Keluar (Logout)</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN VIEW WRAPPER -->
        <div class="flex-1 lg:pl-64 flex flex-col min-w-0">
            
            <!-- Top Admin Header Bar -->
            <header class="bg-white border-b border-slate-200 sticky top-0 z-30 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-500 hover:text-[#142B3B] p-1">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <h2 class="text-base sm:text-lg font-bold text-[#142B3B]">
                        @yield('header_title', 'Dashboard')
                    </h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <span class="text-xs font-bold text-[#142B3B] block">{{ Auth::user()->name ?? 'Administrator' }}</span>
                        <span class="text-[10px] text-emerald-600 font-semibold flex items-center justify-end gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Online
                        </span>
                    </div>

                    <div class="w-9 h-9 rounded-full bg-[#142B3B] text-white flex items-center justify-center font-bold text-xs shadow">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>
                </div>
            </header>

            <!-- Flash Alert Messages -->
            <div class="px-6 pt-6">
                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" class="p-4 mb-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-600"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div x-data="{ show: true }" x-show="show" class="p-4 mb-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2.5">
                            <i data-lucide="alert-circle" class="w-4 h-4 text-rose-600"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-rose-500 hover:text-rose-700">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Page Body Yield -->
            <main class="flex-1 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>

