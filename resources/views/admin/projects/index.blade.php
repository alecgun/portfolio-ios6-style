@extends('layouts.admin')

@section('title', 'Kelola Karya Proyek')
@section('page_title', 'Kelola Karya Proyek')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Daftar Proyek Portofolio</h3>
            <p class="text-xs text-slate-500">Karya yang ditampilkan pada Grouped Table Showcase iOS 6.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white shadow-sm flex items-center gap-1.5 self-start transition">
            <i class="fa-solid fa-plus"></i> Tambah Proyek Baru
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Proyek</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Teknologi</th>
                        <th class="py-3.5 px-4 text-center">Urutan</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($projects as $project)
                    @php
                        $thumb = 'https://placehold.co/600x400/1e3a8a/ffffff?text=' . urlencode($project->title);
                        if ($project->thumbnail_path) {
                            $thumb = str_starts_with($project->thumbnail_path, 'http') ? $project->thumbnail_path : asset('storage/' . $project->thumbnail_path);
                        }
                    @endphp
                    <tr class="hover:bg-slate-50/60 transition">
                        <td class="py-3.5 px-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $thumb }}" class="w-12 h-10 rounded-lg object-cover border border-slate-200" alt="{{ $project->title }}">
                                <div>
                                    <div class="font-bold text-slate-900 text-sm">{{ $project->title }}</div>
                                    <div class="text-slate-400 text-[11px] truncate max-w-xs">{{ $project->short_description }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="py-3.5 px-4">
                            <span class="px-2 py-0.5 rounded-md text-[11px] font-semibold bg-slate-100 text-slate-700">
                                {{ strtoupper($project->category) }} ({{ $project->category_badge }})
                            </span>
                        </td>
                        <td class="py-3.5 px-4 text-slate-600 font-medium">
                            {{ $project->tech_stack }}
                        </td>
                        <td class="py-3.5 px-4 text-center font-bold text-slate-700">
                            {{ $project->sort_order }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if($project->is_published)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Tayang</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Draft</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek ini?');" class="inline">
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
                            Belum ada proyek. Klik tombol "Tambah Proyek Baru" di atas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($projects->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $projects->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
