# Web Portofolio Personal (iOS 6 Classic Edition) + Admin Dashboard CMS

Website portofolio interaktif bergaya retro-skeuomorphic **iOS 6 Classic Edition** (linen dark background, glossy squircle icons, glossy navigation buttons, pinstripe cards, and yellow lined paper notes) dibangun dengan arsitektur **Laravel 13** dan basis data **MySQL**.

Seluruh isi konten portofolio dapat dikelola langsung secara dinamis melalui **Web Dashboard Admin** yang terproteksi autentikasi (login).

---

## 🚀 Fitur Utama

### 1. Halaman Publik Portofolio
- **Hero & Profile Card**: Foto avatar squircle glossy, badge ketersediaan "OPEN TO WORK", nama, role, bio, dan tombol aksi.
- **Slide-to-Unlock CV Resume**: Slider interaktif untuk mengunduh dokumen CV PDF asli yang diunggah oleh admin.
- **Home Screen App Grid (Skills)**: Grid 6+ ikon aplikasi glossy iOS 6 dengan banner notifikasi interaktif yang menampilkan daftar tools dan keahlian saat disentuh/diklik.
- **Portfolio Showcase (Grouped Table)**:
  - Filter kategori (*Semua*, *App*, *Web*).
  - Kartu proyek dengan thumbnail, badge kategori, dan daftar teknologi.
  - Modal dialog *UIAlertView* kaca biru gelap untuk membaca deskripsi lengkap, rincian tech stack, serta tautan live demo & repository GitHub.
- **Preferensi & Ketersediaan Kerja**: Switch toggle ON/OFF khas iOS 6 dan informasi domisili/lokasi basis.
- **Notes App Section**: Catatan karier dan filosofi desain dengan tekstur kertas kuning bergaris (*yellow lined paper*) dan header kulit (*leather header*).
- **Form Kontak Modal (AJAX)**: Pengunjung dapat mengirim pesan langsung tanpa refresh halaman, dilengkapi proteksi CSRF dan tersimpan ke database MySQL.

### 2. Autentikasi & Dashboard Admin
- **Keamanan Login**:
  - Halaman login di `/admin/login`.
  - Rate limiter bawaan (maksimal 5 percobaan gagal per menit).
  - Sesi terenkripsi dan proteksi middleware `auth` untuk seluruh route `/admin/*`.
- **Ringkasan (Overview)**: Metrik total proyek, keahlian, pesan belum dibaca, status ketersediaan kerja, dan log pesan masuk terbaru.
- **Kelola Profil & CV**: Form ubah nama, headline, role, bio, upload foto avatar (preview otomatis), upload dokumen CV PDF baru, serta nomor versi resume.
- **Kelola Proyek (CRUD)**: Tambah, edit, dan hapus proyek portofolio lengkap dengan upload gambar cover/thumbnail, tags teknologi, dan tautan live demo.
- **Kelola Keahlian (CRUD)**: Kelola daftar ikon aplikasi di Home Screen, pemilihan ikon FontAwesome, preset gradient warna iOS 6, dan urutan tampil.
- **Kelola Pengalaman (CRUD)**: Tambah dan perbarui riwayat karier pada section Notes App.
- **Kelola Catatan Filosofi**: Mengedit header, tanggal, judul utama, dan isi tulisan reflektif.
- **Kotak Masuk Pesan (Inbox)**: Membaca pesan masuk dari pengunjung, menandai status telah dibaca, membalas via email (*mailto*), serta menghapus pesan.
- **Akun & Keamanan**: Mengubah nama akun, mengganti alamat email login, serta memperbarui kata sandi admin dengan verifikasi kata sandi lama.

---

## 🛠️ Persyaratan Sistem
- **PHP** >= 8.3 (mendukung PHP 8.4 & 8.5)
- **Composer** >= 2.x
- **MySQL** >= 8.0 (atau MariaDB / SQLite untuk pengujian lokal)
- **Node.js & NPM** (opsional, Tailwind CSS CDN & FontAwesome terintegrasi)

---

## 📦 Panduan Instalasi & Menjalankan

### 1. Clone Proyek
```bash
git clone https://github.com/alecgun/portfolio-ios6-style.git
cd portfolio-ios6-style
```

### 2. Salin File Konfigurasi Environment
```bash
cp .env.example .env
```

### 3. Konfigurasi Basis Data MySQL
Buka file `.env` dan sesuaikan koneksi database MySQL serta kredensial admin awal:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_db
DB_USERNAME=root
DB_PASSWORD=

ADMIN_NAME="Nama Admin"
ADMIN_EMAIL=admin@example.com
ADMIN_PASSWORD=ganti-dengan-password-acak-minimal-8-karakter
```
> *Catatan: Pastikan database `portfolio_db` sudah dibuat di server MySQL Anda.*
>
> Gunakan password acak yang unik. Jangan commit file `.env` atau memakai password contoh ini di production.

### 4. Install Dependensi PHP (jika belum)
```bash
composer install
```

### 5. Generate Application Key & Storage Link
```bash
php artisan key:generate
php artisan storage:link
```

### 6. Jalankan Migrasi & Seeder Data Awal
Perintah ini akan membuat tabel dan mengimpor profil, keahlian, pengalaman, catatan awal, serta membuat akun admin dari nilai `ADMIN_*`. Proyek contoh tidak di-seed; tambahkan proyek Anda dari dashboard.
```bash
php artisan migrate --seed
```

### 7. Jalankan Server Lokal
```bash
php artisan serve
```
Akses web portofolio di peramban Anda melalui:
- **Halaman Portofolio Publik**: [http://127.0.0.1:8000](http://127.0.0.1:8000)
- **Halaman Login Admin**: [http://127.0.0.1:8000/admin/login](http://127.0.0.1:8000/admin/login)

---

## 🚀 Persiapan Production

Atur konfigurasi berikut melalui secret manager atau environment variables di hosting, bukan di repository:

```ini
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda
SESSION_SECURE_COOKIE=true
LOG_CHANNEL=daily
```

Isi juga koneksi database dan `ADMIN_NAME`, `ADMIN_EMAIL`, serta `ADMIN_PASSWORD` yang kuat (minimal 8 karakter). Gunakan HTTPS dari hosting/reverse proxy dan jangan pernah menjalankan `key:generate` lagi setelah aplikasi production mulai menyimpan data.

Build dependensi dan aset saat proses deployment:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
php artisan migrate --force
php artisan storage:link
php artisan optimize
```

Pada instalasi pertama saja, jalankan `php artisan db:seed --force` untuk membuat akun admin dan konten awal tanpa proyek contoh. Jangan jalankan seeder pada setiap deployment. Backup database sebelum migrasi, dan jangan commit `.env`, database SQLite, log, atau file upload.

---

## 🧪 Menjalankan Pengujian Otomatis (Testing)
Seluruh modul dilengkapi unit/feature test:
```bash
php artisan test
```
Hasil uji mencakup verifikasi render publik, form kontak AJAX, proteksi route admin, flow autentikasi, serta operasi CRUD portofolio.
