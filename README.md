<div align="center">
  <h1>🚀 Orb-Science LMS</h1>
  <p><strong>Platform Manajemen Pembelajaran Terdepan untuk Era Digital</strong></p>
  <p>
    <img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel 12">
    <img src="https://img.shields.io/badge/Filament-3-F59E0B?style=flat-square&logo=laravel&logoColor=white" alt="Filament v3">
    <img src="https://img.shields.io/badge/TailwindCSS-v4-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white" alt="Tailwind v4">
    <img src="https://img.shields.io/badge/Alpine.js-3-77C1D2?style=flat-square&logo=alpine.js&logoColor=white" alt="Alpine.js">
  </p>
</div>

---

## 🌟 Tentang Orb-Science

**Orb-Science** adalah platform Learning Management System (LMS) revolusioner yang dibangun di atas **Laravel 12** dan **Filament PHP v3**. Dirancang untuk memadukan keindahan desain, performa tinggi, dan fungsionalitas lengkap — dari manajemen kursus hingga ujian berbasis waktu, sertifikat digital, dan sistem blog terintegrasi.

---

## ✨ Fitur yang Sudah Tersedia

### 🎓 Sistem Pembelajaran
- **Kurikulum Berjenjang** — Hierarki *Course → Module → Lesson* yang terstruktur rapi
- **Progress Tracking** — Pelacakan persentase progres per-lesson via tabel pivot `lesson_user`
- **Enrollment System** — Sistem pendaftaran kursus dengan status (`active`, `completed`)
- **Mark as Complete** — Navigasi antar-lesson dengan kontrol penyelesaian materi

### 📝 Mesin Ujian (Quiz Engine)
- **Halaman Ujian Terisolasi** — Halaman `/exam` tersendiri terpisah dari halaman materi
- **Server-side Countdown Timer** — Timer sinkron server yang tahan *refresh* (localStorage deadline)
- **Auto-submit** — Jawaban otomatis dikirim saat waktu habis
- **Navigasi Sidebar Soal** — Indikator status soal (dijawab/belum) di sidebar
- **Histori Nilai** — Riwayat semua percobaan ujian siswa dengan skor dan status lulus
- **Multiple Attempts** — Siswa dapat mengulang ujian, setiap percobaan tercatat

### 🎖️ Profil & Sertifikat
- **Profil Dinamis** — Upload foto profil, edit nama, email, dan bio
- **Generator Sertifikat PDF** — Download sertifikat resmi (A4 landscape) otomatis saat kursus 100% selesai
- **Histori Sertifikat** — Daftar semua kursus selesai di halaman profil

### 🗺️ Learning Paths
- **Jalur Karir Berjenjang** — Kurikulum terstruktur (Pemula → Menengah → Mahir) per jalur karir
- **Progress per Jalur** — Tracking progress kursus dalam setiap jalur secara real-time
- **Admin Pathway Manager** — CRUD jalur karir + drag-and-drop level via Filament
- **Skill Tree Frontend** — Halaman `/pathway/{slug}` dengan timeline visual berjenjang

### 📰 Blog & CMS
- **Katalog Artikel** — Halaman `/article` dengan filter kategori dan pencarian
- **Editor Markdown** — Menulis artikel dengan Markdown + Live Preview di Admin Panel
- **Kategori & Tag** — Organisasi konten artikel yang fleksibel
- **Status Draft/Published** — Kontrol penerbitan artikel dengan tanggal publish terjadwal
- **Artikel Terkait** — Rekomendasi artikel terkait di halaman baca
- **Estimasi Waktu Baca** — Otomatis dihitung dari jumlah kata (200 WPM)

### 🤖 Algoritma Rekomendasi
- **Rekomendasi Berbasis Enrollment** — Sistem otomatis merekomendasikan kursus berdasarkan kategori yang pernah diikuti siswa
- **Fallback Popularitas** — Jika rekomendasi berbasis kategori kurang dari 4, dilengkapi kursus paling populer
- **Dashboard "Recommended for You"** — Blok dinamis di dashboard siswa

### ⚙️ Admin Panel (Filament v3)
- **Dashboard Analytics** — Stats Overview Widget (total kursus, siswa, penjualan) + Chart Enrollments
- **Course Resource** — CRUD lengkap kursus, modul, lesson (dengan editor Markdown + KaTeX)
- **Quiz Manager** — Tambah soal pilihan ganda via Relation Manager, set waktu ujian per lesson
- **Article Manager** — Editor artikel dengan upload thumbnail dan kategori
- **Pathway Manager** — Kelola jalur karir berjenjang dengan drag-and-drop level

### 🔒 Autentikasi & Keamanan
- **Laravel Breeze** — Register, Login, Forgot Password
- **Role-based Access** — Middleware perlindungan rute (`auth`)
- **Server-side Timer** — Ujian menggunakan timestamp `started_at` di database untuk mencegah kecurangan

### 🧮 Rendering Konten
- **Markdown Compiler** — Konten lesson, artikel, dan soal ujian dirender dari Markdown
- **KaTeX Integration** — Persamaan matematika dan sains ditampilkan dengan presisi tinggi

---

## 🛠️ Tech Stack

| Layer | Teknologi |
|---|---|
| **Backend** | Laravel 12 |
| **Admin Panel** | Filament PHP v3 |
| **Frontend** | Blade + TailwindCSS v4 + Alpine.js |
| **Database** | MariaDB / MySQL |
| **PDF Generator** | barryvdh/laravel-dompdf |
| **Math Rendering** | KaTeX |
| **Asset Bundler** | Vite |

---

## 🚀 Instalasi

```bash
# Clone repository
git clone https://github.com/your-username/orb-science.git
cd orb-science

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Konfigurasi database di .env, lalu:
php artisan migrate

# Link storage untuk upload foto & thumbnail
php artisan storage:link

# Jalankan development server
composer run dev
```

---

## 🎯 Target Pengguna

1. **Sekolah & Universitas** — Platform belajar interaktif dengan ujian terstruktur dan sertifikasi resmi
2. **Lembaga Kursus Online** — Kelola ratusan kursus dengan admin panel yang intuitif
3. **Instruktur Independen** — Publikasikan konten berkualitas tanpa batasan teknis

---

<div align="center">
  <em>Diciptakan dengan ❤️ untuk memajukan pendidikan yang lebih cerdas dan aksesibel.</em>
</div>
