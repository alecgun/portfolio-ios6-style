@extends('layouts.admin')

@section('title', 'Kelola Pengalaman Karier')
@section('page_title', 'Kelola Pengalaman Karier')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Riwayat Karier</h3>
            <p class="text-xs text-slate-500">Kartu pengalaman kerja pada section Notes App bergaris kuning.</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-sm flex items-center gap-1.5 self-start transition">
            <i class="fa-solid fa-plus"></i> Tambah Pengalaman Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Posisi / Jabatan</th>
                        <th class="py-3.5 px-4">Perusahaan / Studio</th>
                        <th class="py-3.5 px-4">Periode</th>
                        <th class="py-3.5 px-4 text-center">Urutan</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($experiences as $exp)
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4 font-bold text-slate-900 text-sm">
                            {{ $exp->role_title }}
                        </td>
                        <td class="py-3.5 px-4 text-slate-700 font-medium">
                            {{ $exp->company_name }}
                        </td>
                        <td class="py-3.5 px-4 text-slate-500 font-semibold">
                            {{ $exp->period }}
                        </td>
                        <td class="py-3.5 px-4 text-center font-bold text-slate-700">
                            {{ $exp->sort_order }}
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.experiences.edit', $exp) }}" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" onsubmit="return confirm('Hapus pengalaman ini?');" class="inline">
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
                        <td colspan="5" class="py-12 text-center text-slate-400">
                            Belum ada riwayat pengalaman ditambahkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
