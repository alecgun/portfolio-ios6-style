@extends('layouts.admin')

@section('title', 'Ringkasan Dashboard')
@section('page_title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-6">

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4">
        <!-- Card 1 -->
        <div class="bg-white p-3 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between gap-2">
            <div>
                <span class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Proyek</span>
                <div class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $totalProjects }}</div>
                <span class="text-[10px] sm:text-xs text-sky-600 font-medium">Portofolio aktif</span>
            </div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 shrink-0 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center text-base sm:text-xl">
                <i class="fa-solid fa-laptop-code"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-3 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between gap-2">
            <div>
                <span class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Keahlian & Tools</span>
                <div class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $totalSkills }}</div>
                <span class="text-[10px] sm:text-xs text-emerald-600 font-medium">Ikon di Home Screen</span>
            </div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 shrink-0 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-base sm:text-xl">
                <i class="fa-solid fa-cubes"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white p-3 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between gap-2">
            <div>
                <span class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Pesan Kontak</span>
                <div class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $totalMessages }}</div>
                <span class="text-[10px] sm:text-xs text-indigo-600 font-medium">Total pesan masuk</span>
            </div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 shrink-0 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-base sm:text-xl">
                <i class="fa-solid fa-envelope"></i>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white p-3 sm:p-5 rounded-2xl border border-slate-200 shadow-sm flex items-center justify-between gap-2">
            <div>
                <span class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wider">Belum Dibaca</span>
                <div class="text-xl sm:text-2xl font-bold text-slate-900 mt-1">{{ $unreadMessages }}</div>
                <span class="text-[10px] sm:text-xs text-rose-600 font-medium">Perlu ditindaklanjuti</span>
            </div>
            <div class="w-9 h-9 sm:w-12 sm:h-12 shrink-0 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-base sm:text-xl">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>
    </div>

    <!-- Quick Status & Action Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Quick Card -->
        <div class="bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                <i class="fa-solid fa-id-card text-blue-600"></i>
                Status Portofolio
            </h3>

            <div class="flex items-center gap-4 mb-4">
                @php
                    $avatar = 'https://placehold.co/300x300/2563eb/ffffff?text=DEV';
                    if ($profile && $profile->avatar_path) {
                        $avatar = str_starts_with($profile->avatar_path, 'http') ? $profile->avatar_path : asset('storage/' . $profile->avatar_path);
                    }
                @endphp
                <img src="{{ $avatar }}" class="w-14 h-14 rounded-xl object-cover border border-slate-300 shadow-sm" alt="Avatar">
                <div class="min-w-0">
                    <h4 class="font-bold text-slate-900 text-base">{{ $profile->full_name ?? 'Developer' }}</h4>
                    <p class="text-xs text-slate-500 break-words">{{ $profile->role_badge ?? 'Frontend Engineer' }}</p>
                    <span class="inline-block mt-1 text-[11px] font-semibold px-2 py-0.5 rounded-full {{ ($profile && $profile->is_open_to_work) ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-600' }}">
                        {{ ($profile && $profile->is_open_to_work) ? 'Open to Work' : 'Busy' }}
                    </span>
                </div>
            </div>

            <div class="space-y-2.5 text-xs text-slate-600 border-t border-slate-100 pt-4">
                <div class="flex justify-between gap-3">
                    <span class="text-slate-400">Freelance:</span>
                    <span class="font-semibold {{ ($profile && $profile->is_freelance_available) ? 'text-emerald-600' : 'text-slate-500' }}">
                        {{ ($profile && $profile->is_freelance_available) ? 'Tersedia (ON)' : 'Tidak Aktif (OFF)' }}
                    </span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-slate-400">Versi CV:</span>
                    <span class="font-semibold text-slate-700">{{ $profile->cv_version_label ?? 'v6.1.3' }}</span>
                </div>
                <div class="flex justify-between gap-3">
                    <span class="text-slate-400">Lokasi:</span>
                    <span class="text-right font-semibold text-slate-700 break-words">{{ $profile->location_base ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-5">
                <a href="{{ route('admin.profile.edit') }}" class="w-full py-2 px-3 rounded-lg text-xs font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 flex items-center justify-center gap-1.5 transition">
                    <i class="fa-solid fa-pen-to-square"></i> Perbarui Data Profil & CV
                </a>
            </div>
        </div>

        <!-- Recent Messages -->
        <div class="lg:col-span-2 bg-white p-4 sm:p-6 rounded-2xl border border-slate-200 shadow-sm flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider flex items-center gap-2">
                        <i class="fa-solid fa-inbox text-blue-600"></i>
                        Pesan Masuk Terbaru
                    </h3>
                    <a href="{{ route('admin.messages.index') }}" class="text-xs text-blue-600 hover:underline font-semibold">
                        Lihat Semua ({{ $totalMessages }})
                    </a>
                </div>

                <div class="divide-y divide-slate-100">
                    @forelse($recentMessages as $msg)
                    <div class="py-3 flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-xs text-slate-800">{{ $msg->sender_name }}</span>
                                @if(!$msg->is_read)
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 truncate mt-0.5">{{ $msg->message }}</p>
                            <span class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }} • {{ $msg->sender_email }}</span>
                        </div>
                        <a href="{{ route('admin.messages.show', $msg) }}" class="px-2.5 py-1 rounded bg-slate-100 hover:bg-slate-200 text-[11px] font-semibold text-slate-700 shrink-0">
                            Baca
                        </a>
                    </div>
                    @empty
                    <div class="text-center py-8 text-slate-400 text-xs">
                        <i class="fa-solid fa-envelope-open text-2xl mb-2 text-slate-300 block"></i>
                        Belum ada pesan kontak dari pengunjung.
                    </div>
                    @endforelse
                </div>
            </div>

            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                <span>Form kontak publik sudah terhubung langsung ke database.</span>
            </div>
        </div>
    </div>

</div>
@endsection
