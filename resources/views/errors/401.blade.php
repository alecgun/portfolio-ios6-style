@include('errors.page', [
    'code' => '401',
    'title' => 'Akses perlu diverifikasi',
    'description' => 'Sesi Anda tidak dapat diverifikasi. Silakan kembali ke halaman utama.',
    'icon' => 'fa-solid fa-lock',
])
