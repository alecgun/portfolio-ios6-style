@extends('layouts.admin')

@section('title', 'Kelola Catatan Filosofi')
@section('page_title', 'Kelola Catatan Filosofi (Notes App)')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.notes.update') }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="p-3.5 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-800 flex items-center gap-2">
                <i class="fa-solid fa-note-sticky text-amber-600 text-base"></i>
                <span>Teks ini muncul pada komponen kertas catatan kuning bergaris dengan header kulit khas iOS 6.</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Header Title (Kiri Atas Bar Kulit)</label>
                    <input type="text" name="header_title" value="{{ old('header_title', $notes->header_title) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Label Tanggal (Kanan Atas Bar Kulit)</label>
                    <input type="text" name="date_label" value="{{ old('date_label', $notes->date_label) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Judul Utama Catatan (Heading Besar)</label>
                <input type="text" name="main_heading" value="{{ old('main_heading', $notes->main_heading) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Isi Catatan / Filosofi Desain</label>
                <textarea name="content" rows="6" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none leading-relaxed">{{ old('content', $notes->content) }}</textarea>
                <span class="text-[11px] text-slate-400 mt-1 block">Tuliskan pandangan, etos kerja, atau filosofi rekayasa antarmuka Anda.</span>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 transition">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Catatan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
