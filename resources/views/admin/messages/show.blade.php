@extends('layouts.admin')

@section('title', 'Detail Pesan dari ' . $message->sender_name)
@section('page_title', 'Detail Pesan Masuk')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8 space-y-6">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-lg font-bold text-slate-900">{{ $message->sender_name }}</h3>
                <a href="mailto:{{ $message->sender_email }}" class="text-xs text-blue-600 hover:underline flex items-center gap-1.5 mt-0.5">
                    <i class="fa-solid fa-envelope"></i> {{ $message->sender_email }}
                </a>
            </div>
            <div class="text-right text-xs text-slate-400">
                <div>{{ $message->created_at->format('d M Y, H:i') }} WIB</div>
                <div class="text-[11px] text-slate-400">IP: {{ $message->ip_address ?? '-' }}</div>
            </div>
        </div>

        <!-- Message Body -->
        <div>
            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Isi Pesan:</label>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-sm text-slate-800 leading-relaxed whitespace-pre-line font-medium">
                {{ $message->message }}
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
            <a href="{{ route('admin.messages.index') }}" class="text-xs text-slate-500 hover:underline flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Kotak Masuk
            </a>

            <div class="flex items-center gap-2">
                <form action="{{ route('admin.messages.mark-read', $message) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-semibold bg-slate-100 hover:bg-slate-200 text-slate-700 transition">
                        {{ $message->is_read ? 'Tandai Belum Dibaca' : 'Tandai Sudah Dibaca' }}
                    </button>
                </form>

                <a href="mailto:{{ $message->sender_email }}?subject=Re: Kolaborasi Portofolio" class="px-4 py-1.5 rounded-lg text-xs font-bold bg-blue-600 hover:bg-blue-700 text-white flex items-center gap-1.5 shadow-sm transition">
                    <i class="fa-solid fa-reply"></i> Balas Email
                </a>

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Hapus pesan ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-1.5 rounded-lg text-rose-600 hover:bg-rose-50 transition" title="Hapus Pesan">
                        <i class="fa-solid fa-trash-can"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
