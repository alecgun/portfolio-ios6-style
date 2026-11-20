@extends('layouts.admin')

@section('title', 'Kelola Keahlian & Tools')
@section('page_title', 'Kelola Keahlian & Tools')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Keahlian (Home Screen App Grid)</h3>
            <p class="text-xs text-slate-500">Ikon aplikasi skeuomorphic iOS 6 di halaman utama portofolio.</p>
        </div>
        <a href="{{ route('admin.skills.create') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-sm flex items-center gap-1.5 self-start transition">
            <i class="fa-solid fa-plus"></i> Tambah Keahlian Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Ikon & Judul</th>
                        <th class="py-3.5 px-4">Deskripsi / Tools</th>
                        <th class="py-3.5 px-4">Gradient iOS 6</th>
                        <th class="py-3.5 px-4 text-center">Urutan</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($skills as $skill)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-b {{ $skill->gradient_classes }} flex items-center justify-center text-white text-lg shadow-sm">
                                    <i class="{{ $skill->icon_class }}"></i>
                                </div>
                                <div>
                                    <span class="font-bold text-slate-900 text-sm block">{{ $skill->title }}</span>
                                    <span class="text-slate-400 text-[10px]">{{ $skill->icon_class }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4 text-slate-600 font-medium max-w-xs truncate">
                            {{ $skill->description }}
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-slate-100 text-slate-700">
                                {{ $skill->bg_gradient }}
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-center font-bold text-slate-700">
                            {{ $skill->sort_order }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($skill->is_active)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Aktif</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Nonaktif</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Hapus keahlian ini?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-slate-400">
                            Belum ada keahlian ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
