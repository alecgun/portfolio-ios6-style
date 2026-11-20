@extends('layouts.admin')

@section('title', 'Tambah Keahlian Baru')
@section('page_title', 'Tambah Keahlian Baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Keahlian (Label Ikon)</label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: UI/UX Design, Frontend, Flutter" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Deskripsi / Tools (Tampil di Toast Banner)</label>
                <input type="text" name="description" value="{{ old('description') }}" required placeholder="Contoh: Figma, Prototyping, Design Systems" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kelas Ikon FontAwesome</label>
                    <input type="text" name="icon_class" value="{{ old('icon_class', 'fa-solid fa-code') }}" required placeholder="fa-solid fa-code" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <span class="text-[11px] text-slate-400 mt-1 block">Contoh: fa-solid fa-code, fa-solid fa-pen-nib, dll.</span>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Preset Gradient iOS 6</label>
                    <select name="bg_gradient" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="sky-blue" {{ old('bg_gradient') == 'sky-blue' ? 'selected' : '' }}>Sky Blue (Biru Langit)</option>
                        <option value="amber-orange" {{ old('bg_gradient') == 'amber-orange' ? 'selected' : '' }}>Amber Orange (Oranye Hangat)</option>
                        <option value="lime-green" {{ old('bg_gradient') == 'lime-green' ? 'selected' : '' }}>Lime Green (Hijau Terang)</option>
                        <option value="fuchsia-purple" {{ old('bg_gradient') == 'fuchsia-purple' ? 'selected' : '' }}>Fuchsia Purple (Ungu Cerah)</option>
                        <option value="slate-gray" {{ old('bg_gradient') == 'slate-gray' ? 'selected' : '' }}>Slate Gray (Abu-abu Modern)</option>
                        <option value="rose-red" {{ old('bg_gradient') == 'rose-red' ? 'selected' : '' }}>Rose Red (Merah Mengkilap)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500">
                        <span class="text-xs font-bold text-slate-700">Tampilkan di Home Screen</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('admin.skills.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 transition">
                    <i class="fa-solid fa-plus"></i> Simpan Keahlian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
