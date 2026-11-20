@extends('layouts.admin')

@section('title', 'Edit Proyek: ' . $project->title)
@section('page_title', 'Edit Proyek: ' . $project->title)

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Proyek</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kategori Filter</label>
                    <select name="category" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="app" {{ old('category', $project->category) == 'app' ? 'selected' : '' }}>App (Aplikasi)</option>
                        <option value="web" {{ old('category', $project->category) == 'web' ? 'selected' : '' }}>Web (Website / Web App)</option>
                        <option value="other" {{ old('category', $project->category) == 'other' ? 'selected' : '' }}>Other (Lainnya)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Badge Kategori Overlay</label>
                    <input type="text" name="category_badge" value="{{ old('category_badge', $project->category_badge) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Ganti Gambar Thumbnail</label>
                    @if($project->thumbnail_path)
                    <div class="mb-2">
                        @php
                            $thumb = str_starts_with($project->thumbnail_path, 'http') ? $project->thumbnail_path : asset('storage/' . $project->thumbnail_path);
                        @endphp
                        <img src="{{ $thumb }}" class="w-32 h-20 rounded-lg object-cover border border-slate-200" alt="Current Thumb">
                    </div>
                    @endif
                    <input type="file" name="thumbnail" accept="image/*" class="w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengubah gambar.</span>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Singkat (Tampil di Kartu)</label>
                    <textarea name="short_description" rows="2" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('short_description', $project->short_description) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi Lengkap (Tampil di Modal Detail)</label>
                    <textarea name="full_description" rows="4" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('full_description', $project->full_description) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Teknologi yang Digunakan (Tech Stack)</label>
                    <input type="text" name="tech_stack" value="{{ old('tech_stack', $project->tech_stack) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tautan Live Demo</label>
                    <input type="url" name="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="https://..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Tautan GitHub / Repo</label>
                    <input type="url" name="github_url" value="{{ old('github_url', $project->github_url) }}" placeholder="https://github.com/..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-xs font-bold text-slate-700">Publikasikan di Portofolio</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-slate-500 hover:underline">Kembali</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
