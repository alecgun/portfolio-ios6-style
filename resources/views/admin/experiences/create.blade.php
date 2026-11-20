@extends('layouts.admin')

@section('title', 'Tambah Pengalaman Baru')
@section('page_title', 'Tambah Pengalaman Baru')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.experiences.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Posisi / Jabatan</label>
                <input type="text" name="role_title" value="{{ old('role_title') }}" required placeholder="Contoh: Lead UI Engineer" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Perusahaan / Studio / Klien</label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" required placeholder="Contoh: Studio Nusantara" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Periode Tahun / Waktu</label>
                    <input type="text" name="period" value="{{ old('period') }}" required placeholder="Contoh: 2023 – Sekarang" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Urutan Tampil</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Ringkasan Tanggung Jawab (Opsional)</label>
                <textarea name="summary" rows="2" placeholder="Catatan singkat kontribusi utama..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('summary') }}</textarea>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                <a href="{{ route('admin.experiences.index') }}" class="text-xs text-slate-500 hover:underline">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 transition">
                    <i class="fa-solid fa-plus"></i> Simpan Pengalaman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
