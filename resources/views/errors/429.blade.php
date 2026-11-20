@include('errors.page', [
    'code' => '429',
    'title' => 'Terlalu banyak permintaan',
    'description' => 'Permintaan sedang dibatasi. Silakan tunggu sebentar sebelum mencoba lagi.',
    'icon' => 'fa-solid fa-hourglass-half',
])
