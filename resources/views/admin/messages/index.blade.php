@extends('layouts.admin')

@section('title', 'Kotak Masuk Pesan')
@section('page_title', 'Kotak Masuk Pesan Kontak')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-base font-bold text-slate-900">Pesan Pengunjung</h3>
            <p class="text-xs text-slate-500">Daftar pertanyaan dan tawaran kerja sama yang dikirim melalui modal kontak iOS 6.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-600 font-bold uppercase tracking-wider border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4">Pengirim</th>
                        <th class="py-3.5 px-4">Alamat Email</th>
                        <th class="py-3.5 px-4">Ringkasan Pesan</th>
                        <th class="py-3.5 px-4">Waktu</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                    <tr class="hover:bg-slate-50/60 transition {{ !$msg->is_read ? 'bg-blue-50/30 font-semibold' : '' }}">
                        <td class="py-3.5 px-4 font-bold text-slate-900">
                            {{ $msg->sender_name }}
                        </td>
                        <td class="py-3.5 px-4 text-slate-600">
                            <a href="mailto:{{ $msg->sender_email }}" class="text-blue-600 hover:underline">
                                {{ $msg->sender_email }}
                            </a>
                        </td>
                        <td class="py-3.5 px-4 text-slate-700 max-w-xs truncate">
                            {{ $msg->message }}
                        </td>
                        <td class="py-3.5 px-4 text-slate-400">
                            {{ $msg->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="py-3.5 px-4 text-center">
                            @if(!$msg->is_read)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-700">Baru</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">Dibaca</span>
                            @endif
                        </td>
                        <td class="py-3.5 px-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.messages.show', $msg) }}" class="p-1.5 rounded-lg text-blue-600 hover:bg-blue-50 transition" title="Lihat">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?');" class="inline">
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
                            Kotak masuk kosong. Belum ada pesan dari pengunjung web.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($messages->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $messages->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
