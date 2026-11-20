@extends('layouts.admin')

@section('title', 'Pengaturan Akun & Keamanan')
@section('page_title', 'Pengaturan Akun & Keamanan')

@section('content')
<div class="max-w-2xl space-y-6">

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 sm:p-8">
        <form action="{{ route('admin.account.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Section 1: Data Akun -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-user-circle text-blue-600"></i>
                    Informasi Akun Admin
                </h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Pengguna (Display Name)</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <span class="text-[11px] text-slate-400 mt-1 block">Nama yang ditampilkan pada pojok bawah menu sidebar admin.</span>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Alamat Email Login</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <span class="text-[11px] text-slate-400 mt-1 block">Email ini digunakan untuk masuk (login) ke panel admin.</span>
                    </div>
                </div>
            </div>

            <!-- Section 2: Ganti Password -->
            <div>
                <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                    <i class="fa-solid fa-key text-blue-600"></i>
                    Ganti Kata Sandi (Password)
                </h3>

                <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-500 mb-4">
                    Kosongkan ketiga kolom kata sandi di bawah jika Anda <strong>hanya ingin mengubah nama atau email</strong>.
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kata Sandi Saat Ini</label>
                        <input type="password" name="current_password" placeholder="Masukkan sandi lama..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Kata Sandi Baru</label>
                            <input type="password" name="new_password" placeholder="Minimal 8 karakter..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Ulangi Kata Sandi Baru</label>
                            <input type="password" name="new_password_confirmation" placeholder="Ketik ulang sandi baru..." class="w-full px-3.5 py-2 rounded-lg border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex justify-end">
                <button type="submit" class="px-6 py-2.5 rounded-xl font-bold text-sm bg-blue-600 hover:bg-blue-700 text-white shadow-md flex items-center gap-2 cursor-pointer transition">
                    <i class="fa-solid fa-floppy-disk"></i>
                    Simpan Perubahan Akun
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
