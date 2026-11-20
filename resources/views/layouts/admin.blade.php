<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') | Portofolio Admin</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Geist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Geist', '-apple-system', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Geist', sans-serif;
            background-color: #f8fafc;
        }

        .admin-nav {
            scrollbar-width: none;
        }

        .admin-nav::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col md:flex-row">

    <!-- Sidebar -->
    <aside class="w-full md:w-64 bg-slate-900 text-slate-300 flex-shrink-0 flex flex-col justify-between border-r border-slate-800">
        <div>
            <!-- Brand -->
            <div class="h-14 md:h-16 flex items-center px-4 md:px-6 border-b border-slate-800 gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-sky-500 to-blue-600 flex items-center justify-center text-white text-sm shadow">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <span class="text-sm font-bold text-white tracking-tight">Portofolio Admin</span>
                    <span class="block text-[10px] text-sky-400">Laravel 13 CMS</span>
                </div>
                <div class="ml-auto flex items-center gap-2 md:hidden">
                    <a href="{{ route('admin.account.edit') }}" class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center font-bold text-white text-xs" title="Pengaturan akun">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Keluar" class="w-8 h-8 rounded-lg text-slate-300 hover:text-rose-400 hover:bg-slate-800 transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Nav Links -->
            <nav class="admin-nav flex gap-1 overflow-x-auto p-2 text-xs font-medium md:block md:space-y-1 md:overflow-visible md:p-4 md:text-sm">
                <a href="{{ route('admin.dashboard') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-gauge-high w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.profile.edit') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.profile.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-user-pen w-5 text-center"></i>
                    <span>Profil & Resume CV</span>
                </a>

                <a href="{{ route('admin.projects.index') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.projects.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-laptop-code w-5 text-center"></i>
                    <span>Karya Proyek</span>
                </a>

                <a href="{{ route('admin.skills.index') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.skills.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-cubes w-5 text-center"></i>
                    <span>Keahlian & Tools</span>
                </a>

                <a href="{{ route('admin.experiences.index') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.experiences.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-briefcase w-5 text-center"></i>
                    <span>Pengalaman Karier</span>
                </a>

                <a href="{{ route('admin.notes.edit') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.notes.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-note-sticky w-5 text-center"></i>
                    <span>Catatan Filosofi</span>
                </a>

                @php
                    $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                @endphp
                <a href="{{ route('admin.messages.index') }}" class="flex shrink-0 items-center justify-between gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <div class="flex items-center gap-2.5 md:gap-3">
                        <i class="fa-solid fa-envelope w-5 text-center"></i>
                        <span>Pesan Kontak</span>
                    </div>
                    @if($unreadCount > 0)
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-500 text-white">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <div class="hidden pt-2 my-2 border-t border-slate-800 md:block"></div>

                <a href="{{ route('admin.account.edit') }}" class="flex shrink-0 items-center gap-2.5 whitespace-nowrap rounded-lg px-2.5 py-2.5 transition md:gap-3 md:px-3.5 {{ request()->routeIs('admin.account.*') ? 'bg-blue-600 text-white font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800/60' }}">
                    <i class="fa-solid fa-user-shield w-5 text-center"></i>
                    <span>Akun & Keamanan</span>
                </a>
            </nav>
        </div>

        <!-- User / Bottom Section -->
        <div class="hidden p-4 border-t border-slate-800 md:block">
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.account.edit') }}" class="flex items-center gap-2.5 group overflow-hidden" title="Buka Pengaturan Akun">
                    <div class="w-8 h-8 rounded-full bg-slate-700 group-hover:bg-blue-600 flex items-center justify-center font-bold text-white text-xs transition">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden text-left">
                        <div class="text-xs font-semibold text-white group-hover:text-blue-400 truncate transition">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-[10px] text-slate-400 truncate">{{ auth()->user()->email }}</div>
                    </div>
                </a>

                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" title="Keluar" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-400 hover:bg-slate-800 transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Navbar -->
        <header class="min-h-16 bg-white border-b border-slate-200 px-4 sm:px-6 py-3 flex items-center justify-between gap-3 sticky top-0 z-20">
            <div class="min-w-0">
                <h2 class="text-sm sm:text-lg font-bold text-slate-800 leading-tight">@yield('page_title', 'Dashboard')</h2>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('public.index') }}" target="_blank" class="shrink-0 px-2.5 sm:px-3 py-2 sm:py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center gap-1.5 transition" aria-label="Lihat Web Portofolio">
                    <i class="fa-solid fa-arrow-up-right-from-square text-sky-600"></i>
                    <span class="hidden sm:inline">Lihat Web Portofolio</span>
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-4 sm:px-6 pt-4">
            @if(session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-circle-check text-emerald-600 text-sm"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium flex items-center gap-2 shadow-sm">
                    <i class="fa-solid fa-triangle-exclamation text-rose-600 text-sm"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs font-medium shadow-sm">
                    <div class="flex items-center gap-2 mb-1 font-semibold">
                        <i class="fa-solid fa-triangle-exclamation text-rose-600"></i>
                        <span>Mohon periksa kesalahan input berikut:</span>
                    </div>
                    <ul class="list-disc pl-5 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Page Body -->
        <main class="p-4 sm:p-6 flex-1 min-w-0">
            @yield('content')
        </main>
    </div>

</body>
</html>
