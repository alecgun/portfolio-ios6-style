@extends('layouts.admin')

@section('title', 'Tambah Proyek Baru')
@section('page_title', 'Tambah Proyek Baru')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Proyek</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Nama Proyek" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori Filter</label>
                    <select name="category" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="app" {{ old('category') == 'app' ? 'selected' : '' }}>App (Aplikasi)</option>
                        <option value="web" {{ old('category') == 'web' ? 'selected' : '' }}>Web (Website / Web App)</option>
                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other (Lainnya)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Badge Kategori Overlay</label>
                    <input type="text" name="category_badge" value="{{ old('category_badge', 'iOS & Web App') }}" required placeholder="Misal: iOS & Web App, Web Audio, Mobile" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Upload Gambar Thumbnail</label>
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <span class="text-[11px] text-slate-400 mt-1 block">Rekomendasi rasio 16:9 atau 600x400 piksel. Maks 3MB.</span>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat (Tampil di Kartu)</label>
                    <textarea name="short_description" rows="2" required placeholder="Penjelasan 1-2 kalimat tentang proyek ini..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('short_description') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Lengkap (Tampil di Modal Detail)</label>
                    <textarea name="full_description" rows="4" placeholder="Ceritakan latar belakang, tantangan, dan solusi yang diimplementasikan..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('full_description') }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Teknologi yang Digunakan (Tech Stack)</label>
                    <input type="text" name="tech_stack" value="{{ old('tech_stack', 'React • TypeScript') }}" required placeholder="Contoh: React • TypeScript • Tailwind CSS" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tautan Live Demo (Opsional)</label>
                    <input type="url" name="project_url" value="{{ old('project_url') }}" placeholder="https://..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tautan GitHub / Repo (Opsional)</label>
                    <input type="url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-xs font-bold text-slate-700">Publikasikan Langsung ke Portofolio</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 transition">
                    <i class="fa-solid fa-plus"></i> Simpan Proyek
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
