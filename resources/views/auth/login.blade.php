<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin | Portofolio iOS 6</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Geist -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            font-family: 'Geist', -apple-system, sans-serif;
            background-color: #1e2124;
            background-image: 
                radial-gradient(circle at 50% 0%, #2f353d 0%, #15181b 100%);
        }
        .ios6-card {
            background: #ffffff;
            border: 1px solid #374151;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
        }
        .ios6-btn-blue {
            background: linear-gradient(180deg, #5ea5f7 0%, #2a7ae2 49%, #1967d2 50%, #2272dc 100%);
            border: 1px solid #104591;
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.55), 0 2px 4px rgba(0,0,0,0.25);
            text-shadow: 0 -1px 0 rgba(0,0,0,0.45);
        }
        .ios6-btn-blue:hover {
            filter: brightness(1.05);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <!-- Brand Header -->
        <div class="text-center mb-6">
            <div class="inline-flex w-16 h-16 rounded-2xl bg-gradient-to-b from-sky-400 to-blue-700 items-center justify-center shadow-lg text-white text-2xl mb-3">
                <i class="fa-solid fa-lock"></i>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight">Admin Dashboard</h1>
            <p class="text-xs text-gray-400 mt-1">Masuk untuk mengelola seluruh konten web portofolio</p>
        </div>

        <!-- Login Card -->
        <div class="ios6-card p-6 sm:p-8">
            @if(session('status'))
                <div class="mb-4 p-3 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-lg bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <span>Gagal Masuk:</span>
                    </div>
                    <ul class="list-disc pl-5 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus
                            placeholder="nama@email.com"
                            autocomplete="off"
                            class="w-full pl-9 pr-3.5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-inner"
                        >
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password" class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Kata Sandi</label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full pl-9 pr-3.5 py-2.5 rounded-lg border border-gray-300 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-inner"
                        >
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center gap-2 cursor-pointer text-gray-600">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span>Ingat Sesi Masuk</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-2.5 rounded-lg text-white font-bold text-sm ios6-btn-blue cursor-pointer transition">
                    Masuk ke Admin
                </button>
            </form>

            <div class="mt-6 pt-4 border-t border-gray-100 flex items-center justify-start text-xs text-gray-500">
                <a href="{{ route('public.index') }}" class="hover:text-blue-600 flex items-center gap-1">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Portofolio
                </a>
            </div>
        </div>
    </div>

</body>
</html>
