<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $profile->full_name ?? 'Portofolio' }} | iOS 6 Classic Edition</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Geist dari Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Geist', '-apple-system', 'BlinkMacSystemFont', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Pengaturan Dasar & Font Geist */
        body {
            font-family: 'Geist', sans-serif;
            /* Tekstur Linen Gelap Khas iOS 6 */
            background-color: #2b2e33;
            background-image: 
                repeating-linear-gradient(0deg, rgba(255,255,255,0.03) 0px, rgba(255,255,255,0.03) 1px, transparent 1px, transparent 3px),
                repeating-linear-gradient(90deg, rgba(0,0,0,0.18) 0px, rgba(0,0,0,0.18) 1px, transparent 1px, transparent 3px),
                radial-gradient(circle at 50% 0%, #3e444d 0%, #1d2024 100%);
            min-height: 100vh;
            color: #1c1c1e;
            overflow-x: hidden;
            user-select: none;
        }

        /* Navigation Bar Biru Baja Klasik iOS 6 */
        .ios6-navbar {
            background: linear-gradient(180deg, #b0bccd 0%, #889bb3 49%, #7a8fa9 50%, #6d84a2 100%);
            border-top: 1px solid #cdd5df;
            border-bottom: 1px solid #2d3642;
            box-shadow: 0 2px 6px rgba(0,0,0,0.45);
        }

        .ios6-navbar-title {
            color: #ffffff;
            text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.55);
        }

        /* Tombol Navigasi iOS 6 */
        .ios6-nav-btn {
            background: linear-gradient(180deg, #8ea1ba 0%, #5c7596 50%, #4b6587 51%, #577193 100%);
            border: 1px solid #35475e;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.35), 0 1px 0 rgba(255,255,255,0.25);
            color: white;
            text-shadow: 0 -1px 0 rgba(0,0,0,0.5);
            transition: all 0.1s ease;
        }
        .ios6-nav-btn:active {
            background: linear-gradient(180deg, #4b6587 0%, #374c66 100%);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.5);
        }

        /* Kartu / Panel Pinstripe Grouped Table View Khas iOS 6 */
        .ios6-sheet {
            background-color: #e4e7ec;
            background-image: repeating-linear-gradient(
                90deg,
                #e2e5ea,
                #e2e5ea 6px,
                #ebedf1 6px,
                #ebedf1 12px
            );
            border: 1px solid #1a1c20;
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.65),
                inset 0 1px 0 rgba(255, 255, 255, 0.85);
        }

        /* Grouped Table Card Putih */
        .ios6-card {
            background: #ffffff;
            border: 1px solid #abaeb3;
            border-radius: 12px;
            box-shadow: 
                0 1px 2px rgba(0,0,0,0.12),
                inset 0 1px 0 #ffffff;
        }

        /* Ikon Aplikasi Squircle Glossy iOS 6 */
        .ios6-app-icon {
            position: relative;
            border-radius: 22.5%;
            box-shadow: 
                0 6px 12px rgba(0, 0, 0, 0.45),
                0 1px 2px rgba(0, 0, 0, 0.6),
                inset 0 1px 1px rgba(255, 255, 255, 0.7);
            overflow: hidden;
            transition: transform 0.15s cubic-bezier(0.2, 0.8, 0.2, 1), filter 0.15s ease;
            cursor: pointer;
        }
        .ios6-app-icon:hover {
            transform: scale(1.06) translateY(-2px);
        }
        .ios6-app-icon:active {
            transform: scale(0.95);
            filter: brightness(0.8);
        }

        /* Efek Kilau Kaca Melengkung (Glossy Overlay) */
        .ios6-app-icon::after {
            content: '';
            position: absolute;
            top: -42%;
            left: -20%;
            width: 140%;
            height: 88%;
            background: linear-gradient(180deg, rgba(255,255,255,0.72) 0%, rgba(255,255,255,0.18) 100%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Teks Label di bawah Ikon Home Screen */
        .ios6-icon-label {
            color: #ffffff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.9), 0 0 4px rgba(0,0,0,0.6);
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        /* Tombol Glossy Utama */
        .ios6-btn-blue {
            background: linear-gradient(180deg, #5ea5f7 0%, #2a7ae2 49%, #1967d2 50%, #2272dc 100%);
            border: 1px solid #104591;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.55), 0 2px 4px rgba(0,0,0,0.25);
            color: #ffffff;
            text-shadow: 0 -1px 0 rgba(0,0,0,0.45);
        }
        .ios6-btn-blue:hover {
            filter: brightness(1.05);
        }
        .ios6-btn-blue:active {
            background: linear-gradient(180deg, #1967d2 0%, #2a7ae2 100%);
            box-shadow: inset 0 2px 5px rgba(0,0,0,0.5);
        }

        .ios6-btn-silver {
            background: linear-gradient(180deg, #ffffff 0%, #e5e7eb 49%, #d1d5db 50%, #e2e4e8 100%);
            border: 1px solid #8e939b;
            box-shadow: inset 0 1px 0 #ffffff, 0 1px 3px rgba(0,0,0,0.18);
            color: #1f2937;
            text-shadow: 0 1px 0 rgba(255,255,255,0.9);
        }
        .ios6-btn-silver:active {
            background: linear-gradient(180deg, #c5c9d0 0%, #dcdfe4 100%);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.3);
        }

        /* Toggle Switch Klasik iOS 6 */
        .ios6-switch {
            width: 76px;
            height: 28px;
            border-radius: 14px;
            background: linear-gradient(180deg, #1b5fb8 0%, #3b88e8 100%);
            border: 1px solid #134487;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.45), 0 1px 0 rgba(255,255,255,0.8);
            position: relative;
            cursor: pointer;
            transition: background 0.25s ease;
        }
        .ios6-switch.off {
            background: linear-gradient(180deg, #b8bcc2 0%, #e4e6e9 100%);
            border-color: #8f949c;
        }
        .ios6-switch-knob {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: linear-gradient(180deg, #ffffff 0%, #dcdcdc 100%);
            border: 1px solid #7a7e85;
            box-shadow: 0 1px 3px rgba(0,0,0,0.4), inset 0 1px 0 #fff;
            position: absolute;
            top: 0;
            right: 0;
            transition: transform 0.25s cubic-bezier(0.3, 1.2, 0.3, 1);
        }
        .ios6-switch.off .ios6-switch-knob {
            transform: translateX(-48px);
        }

        /* Slide to Unlock Shimmer Animation */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .slide-shimmer-text {
            background: linear-gradient(90deg, #6b7280 25%, #ffffff 50%, #6b7280 75%);
            background-size: 200% 100%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 2.8s infinite linear;
        }

        /* Paper Note Card (Notes App Style) */
        .ios6-notes-paper {
            background-color: #fef9d7;
            background-image: 
                linear-gradient(90deg, transparent 38px, #e89b9b 38px, #e89b9b 40px, transparent 40px),
                repeating-linear-gradient(180deg, transparent 0px, transparent 27px, #d5cfa8 28px);
            border: 1px solid #9e8a5c;
            box-shadow: 0 10px 25px rgba(0,0,0,0.45);
        }

        /* Leather Header untuk Notes */
        .ios6-leather-header {
            background: linear-gradient(180deg, #5e412f 0%, #3d281c 100%);
            border-bottom: 2px solid #24160e;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.2), 0 2px 4px rgba(0,0,0,0.4);
        }

        /* Badge Notifikasi Merah Glossy */
        .ios6-badge {
            background: linear-gradient(180deg, #f86b6b 0%, #d91c1c 50%, #b80f0f 100%);
            border: 2px solid #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.5);
            color: white;
            font-weight: 700;
        }
    </style>
</head>
<body class="antialiased selection:bg-blue-600 selection:text-white">

    <!-- Top Admin Bar jika sudah login -->
    @auth
    <div class="bg-gray-900 border-b border-gray-700 text-xs py-1.5 px-4 flex justify-between items-center text-gray-300">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Mode Pratinjau Admin (Login sebagai <strong>{{ auth()->user()->name }}</strong>)</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.dashboard') }}" class="text-sky-400 hover:underline flex items-center gap-1 font-semibold">
                <i class="fa-solid fa-gauge-high"></i> Dashboard Admin
            </a>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-rose-400 hover:underline">Keluar</button>
            </form>
        </div>
    </div>
    @endauth

    <!-- Main Container -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 pt-8 pb-16">

        <!-- HERO SECTION: Kartu Profil Skeuomorphic ala iOS 6 -->
        <section id="hero" class="ios6-sheet rounded-2xl overflow-hidden mb-10">
            <!-- Navigation Bar -->
            <div class="ios6-navbar px-4 py-2.5 flex items-center justify-between">
                <button onclick="scrollToSection('projects')" class="ios6-nav-btn px-3 py-1 rounded-md text-xs font-semibold">
                    Karya
                </button>
                <h1 class="ios6-navbar-title text-base sm:text-lg font-bold tracking-tight">
                    Portofolio.app
                </h1>
                <div class="flex items-center gap-2">
                    <button onclick="openContactModal()" class="ios6-nav-btn px-3 py-1 rounded-md text-xs font-semibold">
                        Kontak
                    </button>
                    @guest
                    <a href="{{ route('admin.login') }}" class="ios6-nav-btn px-2.5 py-1 rounded-md text-xs font-semibold opacity-80 hover:opacity-100" title="Login Admin">
                        <i class="fa-solid fa-lock"></i>
                    </a>
                    @endguest
                </div>
            </div>

            <!-- Isi Hero -->
            <div class="p-6 sm:p-10">
                <div class="ios6-card p-6 sm:p-8 flex flex-col md:flex-row items-center gap-6 sm:gap-8">
                    <!-- Avatar Frame ala iOS 6 App Icon -->
                    <div class="relative shrink-0">
                        <div class="ios6-app-icon w-28 h-28 sm:w-36 sm:h-36 bg-gradient-to-b from-sky-400 via-blue-600 to-indigo-800 flex items-center justify-center">
                            @php
                                $avatarSrc = 'https://placehold.co/300x300/2563eb/ffffff?text=DEV';
                                if ($profile && $profile->avatar_path) {
                                    $avatarSrc = str_starts_with($profile->avatar_path, 'http') 
                                        ? $profile->avatar_path 
                                        : asset('storage/' . $profile->avatar_path);
                                }
                            @endphp
                            <img 
                                src="{{ $avatarSrc }}" 
                                alt="Foto Profil {{ $profile->full_name ?? 'Developer' }}"
                                onerror="this.src='https://placehold.co/300x300/2563eb/ffffff?text=DEV'"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        <!-- Status Badge -->
                        @if($profile && $profile->is_open_to_work)
                        <div class="ios6-badge absolute -top-2 -right-2 px-2.5 py-0.5 rounded-full text-[11px] tracking-tight">
                            OPEN TO WORK
                        </div>
                        @endif
                    </div>

                    <!-- Info & Intro -->
                    <div class="text-center md:text-left flex-1">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 border border-gray-300 text-xs font-semibold text-gray-600 mb-3 shadow-inner">
                            <span class="w-2 h-2 rounded-full {{ ($profile && $profile->is_open_to_work) ? 'bg-green-500' : 'bg-amber-500' }} shadow"></span>
                            {{ $profile->role_badge ?? 'Product Designer & Frontend Engineer' }}
                        </div>

                        <h2 class="text-2xl sm:text-4xl font-extrabold text-gray-900 tracking-tight leading-tight mb-2">
                            {{ $profile->headline ?? 'Halo, Saya Raka Pratama' }}
                        </h2>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed max-w-2xl mb-6 font-normal">
                            {{ $profile->bio ?? 'Merancang pengalaman digital yang taktil, intuitif, dan berkarakter.' }}
                        </p>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-3">
                            <button onclick="scrollToSection('projects')" class="ios6-btn-blue px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-compass"></i>
                                Jelajahi Proyek
                            </button>
                            <button onclick="openContactModal()" class="ios6-btn-silver px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 cursor-pointer">
                                <i class="fa-solid fa-paper-plane text-blue-600"></i>
                                Kirim Pesan
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Interactive Slide-to-Unlock Bar untuk Unduh CV -->
                <div class="mt-6 bg-gradient-to-b from-gray-800 to-gray-900 p-2 rounded-2xl border border-gray-600 shadow-inner flex items-center justify-between gap-3">
                    <a id="cv-slider-btn" href="{{ route('public.download-cv') }}" onclick="triggerDownloadCV(event)" class="ios6-btn-silver px-4 py-2.5 rounded-xl font-bold text-gray-700 flex items-center gap-2 shadow-md cursor-pointer shrink-0">
                        <i class="fa-solid fa-arrow-right text-gray-500"></i>
                        <span class="text-xs sm:text-sm">Unduh CV</span>
                    </a>
                    <div class="flex-1 text-center overflow-hidden">
                        <span id="cv-status-text" class="slide-shimmer-text text-sm sm:text-base font-medium tracking-tight">
                            klik tombol untuk mengunduh resume (PDF)
                        </span>
                    </div>
                    <div class="hidden sm:flex items-center pr-3 text-gray-400 text-xs font-medium">
                        {{ $profile->cv_version_label ?? 'v6.1.3' }}
                    </div>
                </div>
            </div>
        </section>

        <!-- HOME SCREEN APP GRID: Keahlian & Navigasi Cepat -->
        <section id="skills" class="mb-12">
            <div class="flex items-center justify-between mb-5 px-1">
                <h3 class="ios6-icon-label text-lg sm:text-xl flex items-center gap-2">
                    <i class="fa-solid fa-layer-group text-sky-300"></i>
                    Keahlian & Teknologi
                </h3>
                <span class="text-xs text-gray-300 font-medium bg-black/40 px-3 py-1 rounded-full border border-white/15">
                    Ketuk ikon untuk detail
                </span>
            </div>

            <!-- Grid Ikon Aplikasi iOS 6 -->
            <div class="grid grid-cols-3 sm:grid-cols-6 gap-5 sm:gap-6 px-2">
                @forelse($skills as $skill)
                <div onclick="showSkillToast('{{ addslashes($skill->title) }}', '{{ addslashes($skill->description) }}')" class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="ios6-app-icon w-16 h-16 sm:w-20 sm:h-20 bg-gradient-to-b {{ $skill->gradient_classes }} flex items-center justify-center text-white text-2xl sm:text-3xl">
                        <i class="{{ $skill->icon_class }} drop-shadow"></i>
                    </div>
                    <span class="ios6-icon-label text-xs text-center">{{ $skill->title }}</span>
                </div>
                @empty
                <div class="col-span-6 text-center text-gray-400 text-sm py-4">Belum ada keahlian ditambahkan.</div>
                @endforelse
            </div>

            <!-- Toast Banner Notifikasi ala iOS 6 -->
            <div id="skill-banner" class="hidden mt-5 bg-gradient-to-b from-neutral-800 to-neutral-950 border border-neutral-600 rounded-xl p-3.5 shadow-2xl flex items-center justify-between text-white transition-all">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-b from-blue-400 to-blue-700 flex items-center justify-center shadow">
                        <i class="fa-solid fa-circle-info text-white"></i>
                    </div>
                    <div>
                        <div id="skill-banner-title" class="text-sm font-bold text-white">Detail Keahlian</div>
                        <div id="skill-banner-desc" class="text-xs text-gray-300">Rincian alat dan teknologi</div>
                    </div>
                </div>
                <button onclick="document.getElementById('skill-banner').classList.add('hidden')" class="text-gray-400 hover:text-white px-2">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </section>

        <!-- PORTFOLIO SECTION: Grouped Table View & Project Showcase -->
        <section id="projects" class="ios6-sheet rounded-2xl overflow-hidden mb-12">
            <!-- Navigation Bar -->
            <div class="ios6-navbar px-4 py-2.5 flex items-center justify-between">
                <span class="text-xs font-semibold text-white/90 drop-shadow">{{ $projects->count() }} Proyek Pilihan</span>
                <h2 class="ios6-navbar-title text-base sm:text-lg font-bold">Karya Terbaru</h2>
                <!-- Segmented Control Khas iOS 6 -->
                <div class="flex rounded-md overflow-hidden border border-[#2d3d52] shadow-sm text-xs font-semibold">
                    <button onclick="filterProjects('all')" id="filter-all" class="px-2.5 py-1 bg-[#486284] text-white shadow-inner cursor-pointer">Semua</button>
                    <button onclick="filterProjects('app')" id="filter-app" class="px-2.5 py-1 bg-gradient-to-b from-[#8fa3bd] to-[#6880a0] text-white border-l border-[#2d3d52] cursor-pointer">App</button>
                    <button onclick="filterProjects('web')" id="filter-web" class="px-2.5 py-1 bg-gradient-to-b from-[#8fa3bd] to-[#6880a0] text-white border-l border-[#2d3d52] cursor-pointer">Web</button>
                </div>
            </div>

            <div class="p-5 sm:p-8 space-y-6">
                <!-- Project Grid -->
                <div id="projects-grid" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @forelse($projects as $project)
                    @php
                        $thumbSrc = 'https://placehold.co/600x400/1e3a8a/ffffff?text=' . urlencode($project->title);
                        if ($project->thumbnail_path) {
                            $thumbSrc = str_starts_with($project->thumbnail_path, 'http')
                                ? $project->thumbnail_path
                                : asset('storage/' . $project->thumbnail_path);
                        }
                    @endphp
                    <article data-category="{{ $project->category }}" class="project-card ios6-card overflow-hidden flex flex-col justify-between transition-transform hover:-translate-y-1">
                        <div>
                            <div class="relative h-44 bg-gray-900 border-b border-gray-300 overflow-hidden">
                                <img 
                                    src="{{ $thumbSrc }}" 
                                    alt="{{ $project->title }}"
                                    onerror="this.src='https://placehold.co/600x400/1e3a8a/ffffff?text=Project'"
                                    class="w-full h-full object-cover"
                                >
                                <span class="absolute top-3 left-3 px-2.5 py-0.5 rounded-md text-[11px] font-bold bg-black/75 text-white border border-white/25 backdrop-blur-sm">
                                    {{ $project->category_badge }}
                                </span>
                            </div>
                            <div class="p-5">
                                <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $project->title }}</h3>
                                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed mb-4">
                                    {{ $project->short_description }}
                                </p>
                            </div>
                        </div>
                        <div class="px-5 pb-5 pt-2 border-t border-gray-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-gray-500">{{ $project->tech_stack }}</span>
                            <button onclick="openProjectDetail(
                                '{{ addslashes($project->title) }}', 
                                '{{ addslashes($project->full_description ?? $project->short_description) }}', 
                                '{{ addslashes($project->tech_stack) }}',
                                '{{ $project->project_url ?? '' }}',
                                '{{ $project->github_url ?? '' }}'
                            )" class="ios6-btn-blue px-3.5 py-1.5 rounded-md text-xs font-bold cursor-pointer">
                                Detail <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                            </button>
                        </div>
                    </article>
                    @empty
                    <div class="col-span-3 text-center text-gray-500 py-10">Belum ada proyek portofolio yang ditampilkan.</div>
                    @endforelse
                </div>

                <!-- Settings / Preferences Grouped Table ala iOS 6 -->
                <div class="pt-2">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-600 mb-2 px-2 drop-shadow-[0_1px_0_rgba(255,255,255,0.8)]">
                        Preferensi & Ketersediaan Kerja
                    </h4>
                    <div class="ios6-card divide-y divide-gray-200">
                        <div class="px-4 py-3.5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-md bg-green-600 text-white flex items-center justify-center text-xs shadow-sm">
                                    <i class="fa-solid fa-briefcase"></i>
                                </div>
                                <div>
                                    <div class="text-sm font-bold text-gray-900">Proyek Freelance & Konsultasi</div>
                                    <div class="text-xs text-gray-500">{{ $profile->freelance_period_text ?? 'Tersedia untuk proyek baru' }}</div>
                                </div>
                            </div>
                            <!-- Interactive iOS 6 Toggle Switch -->
                            @php
                                $isAvailable = $profile->is_freelance_available ?? true;
                            @endphp
                            <div id="availability-switch" class="ios6-switch {{ $isAvailable ? '' : 'off' }}" role="switch" aria-checked="{{ $isAvailable ? 'true' : 'false' }}">
                                <span class="{{ $isAvailable ? 'text-[10px] font-extrabold text-white pl-2.5 leading-[26px] tracking-wider' : 'text-[10px] font-extrabold text-gray-600 pr-2.5 float-right leading-[26px] tracking-wider' }}">
                                    {{ $isAvailable ? 'ON' : 'OFF' }}
                                </span>
                                <div class="ios6-switch-knob"></div>
                            </div>
                        </div>

                        <div class="px-4 py-3.5 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-7 h-7 rounded-md bg-blue-600 text-white flex items-center justify-center text-xs shadow-sm">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="text-sm font-bold text-gray-900">Lokasi Basis</div>
                            </div>
                            <span class="text-sm font-medium text-gray-500">{{ $profile->location_base ?? 'Indonesia (WIB)' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- NOTES APP SECTION: Tentang Saya & Pengalaman -->
        @if($notes)
        <section id="about" class="ios6-notes-paper rounded-2xl overflow-hidden mb-8">
            <!-- Leather Header -->
            <div class="ios6-leather-header px-5 py-3 flex items-center justify-between text-amber-100">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-note-sticky text-amber-300"></i>
                    <span class="font-bold text-sm tracking-tight">{{ $notes->header_title }}</span>
                </div>
                <span class="text-xs text-amber-200/80 font-medium">{{ $notes->date_label }}</span>
            </div>

            <div class="pl-12 pr-6 py-6 text-gray-800 space-y-4">
                <h3 class="text-xl font-extrabold text-gray-900 tracking-tight">
                    {{ $notes->main_heading }}
                </h3>
                <p class="text-sm sm:text-base leading-[28px] text-gray-800 whitespace-pre-line">
                    {{ $notes->content }}
                </p>
                <div class="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    @forelse($experiences as $exp)
                    <div class="bg-amber-200/50 border border-amber-400/60 rounded-lg p-3.5">
                        <div class="font-bold text-gray-900">{{ $exp->role_title }} — {{ $exp->company_name }}</div>
                        <div class="text-xs text-gray-600 mt-0.5">{{ $exp->period }}</div>
                        @if($exp->summary)
                        <div class="text-xs text-gray-700 mt-1.5">{{ $exp->summary }}</div>
                        @endif
                    </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </section>
        @endif

    </main>

    <!-- MODAL KLASIK iOS 6 (UIAlertView Style) -->
    <div id="ios6-modal-backdrop" class="fixed inset-0 z-50 hidden bg-black/65 backdrop-blur-xs flex items-center justify-center p-4">
        
        <!-- Dialog Box ala iOS 6 Blue Glass Alert -->
        <div id="ios6-alert-box" class="w-full max-w-md rounded-2xl overflow-hidden border-2 border-white/80 shadow-[0_20px_50px_rgba(0,0,0,0.85)] bg-gradient-to-b from-[#2c4670]/95 via-[#172b4d]/95 to-[#0f1d36]/95 text-white p-5 relative">
            <!-- Glossy Top Highlight -->
            <div class="absolute inset-x-0 top-0 h-12 bg-gradient-to-b from-white/25 to-transparent pointer-events-none"></div>

            <div class="relative z-10">
                <h3 id="modal-title" class="text-lg font-bold text-center tracking-tight drop-shadow mb-2">
                    Kirim Pesan
                </h3>
                <p id="modal-subtitle" class="text-xs sm:text-sm text-blue-100 text-center mb-4 leading-relaxed">
                    Tertarik berkolaborasi membangun produk digital? Tinggalkan pesan di bawah ini.
                </p>

                <!-- Form Kontak -->
                <form id="contact-form" onsubmit="handleFormSubmit(event)" class="space-y-3 mb-4">
                    <input type="text" id="contact-name" name="sender_name" required placeholder="Nama Anda" class="w-full px-3.5 py-2 rounded-lg bg-white text-gray-900 text-sm font-medium border border-gray-400 shadow-inner focus:outline-none focus:ring-2 focus:ring-sky-400">
                    <input type="email" id="contact-email" name="sender_email" required placeholder="alamat@email.com" class="w-full px-3.5 py-2 rounded-lg bg-white text-gray-900 text-sm font-medium border border-gray-400 shadow-inner focus:outline-none focus:ring-2 focus:ring-sky-400">
                    <textarea id="contact-message" name="message" rows="3" required placeholder="Ceritakan ide proyek Anda..." class="w-full px-3.5 py-2 rounded-lg bg-white text-gray-900 text-sm font-medium border border-gray-400 shadow-inner focus:outline-none focus:ring-2 focus:ring-sky-400"></textarea>
                    
                    <div id="form-error-box" class="hidden text-xs text-red-200 bg-red-900/60 p-2 rounded-md border border-red-500"></div>

                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <button type="button" onclick="closeModal()" class="py-2 rounded-lg font-bold text-sm bg-gradient-to-b from-slate-500/80 to-slate-700/90 border border-white/30 shadow hover:brightness-110 cursor-pointer">
                            Batal
                        </button>
                        <button type="submit" id="contact-submit-btn" class="py-2 rounded-lg font-bold text-sm bg-gradient-to-b from-sky-400 to-blue-600 border border-white/50 shadow hover:brightness-110 cursor-pointer">
                            Kirim
                        </button>
                    </div>
                </form>

                <!-- Konten Detail Proyek -->
                <div id="project-detail-content" class="hidden space-y-4">
                    <div class="bg-black/30 border border-white/15 rounded-xl p-3.5 text-xs text-blue-100">
                        <span class="font-bold text-white block mb-1">Teknologi yang digunakan:</span>
                        <span id="modal-tech-stack">React, TypeScript</span>
                    </div>

                    <div id="modal-links" class="flex gap-2 justify-center hidden">
                        <a id="modal-demo-link" href="#" target="_blank" class="hidden px-4 py-2 rounded-lg text-xs font-bold bg-blue-500 hover:bg-blue-600 text-white flex items-center gap-1.5">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Live Demo
                        </a>
                        <a id="modal-github-link" href="#" target="_blank" class="hidden px-4 py-2 rounded-lg text-xs font-bold bg-gray-800 hover:bg-gray-700 text-white border border-gray-600 flex items-center gap-1.5">
                            <i class="fa-brands fa-github"></i> Repository
                        </a>
                    </div>

                    <button onclick="closeModal()" class="w-full py-2.5 rounded-lg font-bold text-sm bg-gradient-to-b from-sky-400 to-blue-600 border border-white/50 shadow hover:brightness-110 cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Smooth Scroll
        function scrollToSection(id) {
            const el = document.getElementById(id);
            if (el) {
                el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        // Tampilkan Banner Notifikasi Keahlian
        function showSkillToast(title, desc) {
            const banner = document.getElementById('skill-banner');
            document.getElementById('skill-banner-title').textContent = title;
            document.getElementById('skill-banner-desc').textContent = desc;
            banner.classList.remove('hidden');
        }

        // Trigger Download CV
        function triggerDownloadCV(e) {
            const statusText = document.getElementById('cv-status-text');
            statusText.textContent = 'Menyiapkan dokumen CV...';
            setTimeout(() => {
                statusText.textContent = '✓ Resume siap diunduh!';
            }, 1000);
        }

        // Filter Proyek Segmented Control
        function filterProjects(category) {
            const cards = document.querySelectorAll('.project-card');
            const buttons = ['all', 'app', 'web'];

            buttons.forEach(btn => {
                const el = document.getElementById(`filter-${btn}`);
                if (btn === category) {
                    el.className = 'px-2.5 py-1 bg-[#486284] text-white shadow-inner cursor-pointer';
                } else {
                    el.className = 'px-2.5 py-1 bg-gradient-to-b from-[#8fa3bd] to-[#6880a0] text-white border-l border-[#2d3d52] cursor-pointer';
                }
            });

            cards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }

        // Buka Modal Kontak
        function openContactModal() {
            document.getElementById('modal-title').textContent = 'Kirim Pesan';
            document.getElementById('modal-subtitle').textContent = 'Tertarik berkolaborasi membangun produk digital? Tinggalkan pesan di bawah ini.';
            document.getElementById('contact-form').classList.remove('hidden');
            document.getElementById('project-detail-content').classList.add('hidden');
            document.getElementById('form-error-box').classList.add('hidden');
            document.getElementById('modal-links').classList.add('hidden');
            document.getElementById('ios6-modal-backdrop').classList.remove('hidden');
        }

        // Buka Modal Detail Proyek
        function openProjectDetail(title, desc, tech, demoUrl, githubUrl) {
            document.getElementById('modal-title').textContent = title;
            document.getElementById('modal-subtitle').textContent = desc;
            document.getElementById('modal-tech-stack').textContent = tech;
            document.getElementById('contact-form').classList.add('hidden');
            document.getElementById('project-detail-content').classList.remove('hidden');
            
            const linksBox = document.getElementById('modal-links');
            const demoBtn = document.getElementById('modal-demo-link');
            const githubBtn = document.getElementById('modal-github-link');

            let hasLinks = false;
            if (demoUrl && demoUrl !== '#' && demoUrl.startsWith('http')) {
                demoBtn.href = demoUrl;
                demoBtn.classList.remove('hidden');
                hasLinks = true;
            } else {
                demoBtn.classList.add('hidden');
            }

            if (githubUrl && githubUrl !== '#' && githubUrl.startsWith('http')) {
                githubBtn.href = githubUrl;
                githubBtn.classList.remove('hidden');
                hasLinks = true;
            } else {
                githubBtn.classList.add('hidden');
            }

            if (hasLinks) {
                linksBox.classList.remove('hidden');
            } else {
                linksBox.classList.add('hidden');
            }

            document.getElementById('ios6-modal-backdrop').classList.remove('hidden');
        }

        // Tutup Modal
        function closeModal() {
            document.getElementById('ios6-modal-backdrop').classList.add('hidden');
        }

        // Submit Form Kontak via AJAX
        async function handleFormSubmit(e) {
            e.preventDefault();
            const submitBtn = document.getElementById('contact-submit-btn');
            const errorBox = document.getElementById('form-error-box');
            errorBox.classList.add('hidden');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim...';

            const payload = {
                sender_name: document.getElementById('contact-name').value,
                sender_email: document.getElementById('contact-email').value,
                message: document.getElementById('contact-message').value,
            };

            try {
                const response = await fetch("{{ route('public.contact') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    document.getElementById('modal-title').textContent = 'Pesan Terkirim!';
                    document.getElementById('modal-subtitle').textContent = data.message;
                    document.getElementById('contact-form').classList.add('hidden');
                    document.getElementById('project-detail-content').classList.remove('hidden');
                    document.getElementById('modal-tech-stack').textContent = 'Status: Terkirim ke kotak masuk {{ $profile->full_name ?? "Admin" }}';
                    document.getElementById('contact-form').reset();
                } else {
                    let errMsg = data.message || 'Terjadi kesalahan saat mengirim pesan.';
                    if (data.errors) {
                        errMsg = Object.values(data.errors).flat().join('<br>');
                    }
                    errorBox.innerHTML = errMsg;
                    errorBox.classList.remove('hidden');
                }
            } catch (err) {
                errorBox.textContent = 'Gagal terhubung ke server. Silakan coba beberapa saat lagi.';
                errorBox.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Kirim';
            }
        }
    </script>
</body>
</html>
