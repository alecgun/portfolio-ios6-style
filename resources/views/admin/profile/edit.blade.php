@extends('layouts.admin')

@section('title', 'Kelola Profil & Resume CV')
@section('page_title', 'Kelola Profil & Resume CV')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Informasi Utama -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-user text-blue-600"></i>
                    Informasi Utama (Hero Section)
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap</label>
                        <input type="text" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Badge Pekerjaan (Pill Tag)</label>
                        <input type="text" name="role_badge" value="{{ old('role_badge', $profile->role_badge) }}" required placeholder="Product Designer & Frontend Engineer" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Intro (Headline)</label>
                        <input type="text" name="headline" value="{{ old('headline', $profile->headline) }}" required placeholder="Halo, Saya Raka Pratama" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat (Bio)</label>
                        <textarea name="bio" rows="3" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('bio', $profile->bio) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Section 2: Media & Dokumen -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-file-arrow-up text-blue-600"></i>
                    Foto Avatar & Dokumen Resume (PDF)
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Avatar Upload -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Foto Profil (Avatar Squircle)</label>
                        <div class="flex items-center gap-4 mb-3">
                            @php
                                $avatar = 'https://placehold.co/300x300/2563eb/ffffff?text=DEV';
                                if ($profile && $profile->avatar_path) {
                                    $avatar = str_starts_with($profile->avatar_path, 'http') ? $profile->avatar_path : asset('storage/' . $profile->avatar_path);
                                }
                            @endphp
                            <img src="{{ $avatar }}" class="w-16 h-16 rounded-2xl object-cover border border-slate-300 shadow-sm" alt="Preview Avatar">
                            <div class="text-xs text-slate-500">
                                Format: JPG, PNG, WebP.<br>Maksimal ukuran 2MB.
                            </div>
                        </div>
                        <input type="file" name="avatar" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    </div>

                    <!-- CV Resume PDF -->
                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50/50">
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Dokumen CV / Resume (PDF)</label>
                        <div class="mb-3 text-xs">
                            @if($profile->cv_pdf_path)
                            <div class="flex items-center gap-2 text-emerald-700 font-semibold mb-1">
                                <i class="fa-solid fa-file-pdf text-rose-500 text-base"></i>
                                <span>Dokumen CV tersimpan</span>
                                <a href="{{ route('public.download-cv') }}" target="_blank" class="text-blue-600 underline text-[11px] ml-1">Unduh & Cek</a>
                            </div>
                            @else
                            <div class="text-amber-700 flex items-center gap-2">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                <span>Belum ada dokumen PDF diunggah.</span>
                            </div>
                            @endif
                            <div class="text-slate-500 text-[11px] mt-1">Format PDF, maksimal 10MB.</div>
                        </div>
                        <input type="file" name="cv_pdf" accept="application/pdf" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    </div>
                </div>
            </div>

            <!-- Section 3: Pengaturan Ketersediaan & Versi -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-blue-600"></i>
                    Status Ketersediaan & Preferensi
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Label Versi CV</label>
                        <input type="text" name="cv_version_label" value="{{ old('cv_version_label', $profile->cv_version_label) }}" required placeholder="v6.1.3" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Lokasi Basis</label>
                        <input type="text" name="location_base" value="{{ old('location_base', $profile->location_base) }}" required placeholder="Jawa Timur, Indonesia (WIB)" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Teks Periode Ketersediaan Freelance</label>
                        <input type="text" name="freelance_period_text" value="{{ old('freelance_period_text', $profile->freelance_period_text) }}" required placeholder="Tersedia untuk Q4 2026" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="sm:col-span-2 pt-2 space-y-3">
                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer hover:bg-slate-100 transition">
                            <input type="checkbox" name="is_open_to_work" value="1" {{ old('is_open_to_work', $profile->is_open_to_work) ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Tampilkan Badge "OPEN TO WORK"</span>
                                <span class="text-[11px] text-slate-500">Muncul di sudut kanan atas foto avatar profil.</span>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 bg-slate-50 cursor-pointer hover:bg-slate-100 transition">
                            <input type="checkbox" name="is_freelance_available" value="1" {{ old('is_freelance_available', $profile->is_freelance_available) ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                            <div>
                                <span class="text-xs font-bold text-slate-800 block">Ketersediaan Proyek Freelance (Switch ON / OFF)</span>
                                <span class="text-[11px] text-slate-500">Mengontrol posisi switch toggle iOS 6 pada tabel preferensi kerja.</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 cursor-pointer transition">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
