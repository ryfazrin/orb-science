# Orb-Science Project Roadmap & Implementation Plan

Dokumen ini berfungsi sebagai peta jalan (roadmap) agar arah pengembangan LMS **Orb-Science** selaras dan tidak melenceng dari arsitektur utama.

## ✅ Fase yang Telah Diselesaikan
**Tahap 1-3: UI, Arsitektur Database, dan Dynamic Wiring**
- Mengubah desain statis menjadi Blade berbasis komponen (TailwindCSS v4).
- Membangun Relasi Database utama (`Courses`, `Modules`, `Lessons`, `Enrollments`).
- Implementasi pelacakan persentase progres per-lesson secara mikroskopis via tabel *Pivot* `lesson_user`.
- Mesin pembaca *Markdown* bawaan yang merender konten materi.

---

## 🚀 Fase Pengembangan Selanjutnya

### ✅ Tahap 4: Autentikasi Asli (Sistem Identitas)
Menghapus _Dummy User Id 1_ dan mengaktifkan kemampuan Register/Login mandiri.
- **Teknologi**: Laravel Breeze (Blade/Alpine).
- **Tugas Utama**: Menginstal sistem Auth. Sinkronisasi Controller `LearningController`, `CheckoutController` dan `DashboardController` untuk membaca data murni dari `Auth::user()->id()`. Memastikan Rute utama dilindungi dengan perlindungan _Middleware_.

### ✅ Tahap 5: Instructor / Admin Panel (Pengelolaan Konten)
LMS tidak lengkap tanpa dasbor untuk Pembuat Konten/Tutor, karena memodifikasi kode via _Database Seeder_ tidaklah relevan untuk ranah _produksi_.
- **Teknologi**: Rekomendasi terkuat menggunakan **Filament PHP** panel. Sangat cepat, modern, dan sejalur dengan ekosistem Laravel Tailwiind.
- **Tugas Utama**: Membuat CRUD Resources untuk tabel `Courses`, `Modules`, `Lessons`. Termasuk kolom pengisi konten berformat Markdown dan KaTeX.

### (HOLD) Tahap 6: Integrasi Payment Gateway (Checkout Asli)
Menerima uang ke rekening platform secara valid.
- **Teknologi**: Midtrans Snap API (Ideal untuk lokalisasi Rupiah) / Stripe.
- **Tugas Utama**: Sistem simulasi akan dilepas. Menangani Webhook Midtrans. Apabila balasan Server adalah HTTP 200 (Success), barulah model `Enrollment` dibuat dan membuka pintu gerbang belajar bagi siswa yang membayar.

### Tahap 7: Mesin Ujian (Exam/Quiz Engine)
Sebagai respon dari kebutuhan evaluasi siswa sebelum dinyatakan lulus kursus.
- **Konsep**: Membuat tipe Sub-Bab khusus (Lesson dengan `type='quiz'`).
- **Tugas Utama**: 
  - Sub-bab tipe ini tidak akan merender *Markdown* panjang, namun menyajikan tombol peluncuran/meng-link ke halaman **Ujian Spesifik** antarmuka interaktif baru (`/course/{course_id}/exam/{lesson_id}`).
  - Pembangunan Database baru: `questions`, `options`, dan `user_answers`. 
  - Sistem penilaian _(Grading Logic)_. Mengharuskan skor lolos > 75% untuk bisa mengubah status _Mark as Complete_.

### Tahap 8: Finishing & Polishing (User Profile & Sertifikat)
- **Tugas Utama**: Dinamisasi ganti foto profil, ganti _password_, manajemen preferensi User.
- Meluncurkan fitur Generator PDF (misal memakai `spatie/laravel-pdf`) ketika Kursus = 100%, sehingga tombol *View Certificate* dapat mengunduh dokumen secara sah.

### Tahap 9: Sistem Artikel (Blog & CMS)
Artikel berfungsi sebagai media literasi gratis dan pendongkrak SEO LMS Anda. Ini bukan fitur sekunder sembarangan.
- **Kebutuhan Database**: Tabel `articles` (slug, title, content, published_at), tabel `categories`, dan pivot `article_tag`.
- **Kebutuhan Admin Panel**: Pembuatan form editor purna jual di Filament untuk mengunggah The *Thumbnail Image*, menulis konten dengan *Markdown Compiler* dan preview, beserta konfigurasi status (Draft/Publish).
- **Kebutuhan Front-end**: Laman `/article` (Katalog Artikel dengan pemfilteran) dan `/article/{slug}` (Halaman baca memanjang dioptimasi Tailwind Typography).

### Tahap 10: Sistem Algoritma Rekomendasi
Menyajikan kursus yang sangat spesifik dan relevan kepada pengguna secara otomatis di dasbor *Recommended for You*.
- **Kebutuhan Logic**: Mesin *Query* atau algoritma analitik yang mampu membaca jejak *Enrollments* siswa. Jika ia membeli kursus React, maka sodorkan tawaran kursus Next.js.
- **Kebutuhan Front-end**: Blok statis diubah menjadi korsel (*carousel/slider*) dinamis yang berevolusi tiap pengguna menamatkan suatu modul.

### Tahap 11: Arsitektur Learning Paths (Alur Karir Berjenjang)
Mengkategorisasikan kursus satuan ke dalam lintasan spesialisasi karir secara komprehensif (contoh: *Front-End Engineer*, *Data Scientist*).
- **Kebutuhan Database**: Hirarki bersarang tinggi. Tabel master `pathways` (nama karir, ikon) -> berelasi *One-to-Many* dengan tabel `pathway_levels` (menyimpan urutan level: Pemula, Menengah, Mahir) -> bertaut *Many-to-Many* dengan kursus di dalamnya.
- **Kebutuhan Admin Panel**: Modul matriks purna-jual bersistem *Drag-and-Drop* di *Dashboard Admin* untuk mendesain *Skill Tree* hirarki karir berjenjang tersebut.
- **Kebutuhan Front-end**: Laman penjelajah peta karir `/pathway` yang visualnya menyeramapai rute *game* atau *Skill Tree*.

### Tahap 12: Arsitektur Langganan (Pricing & Subscription)
Alih-alih membeli kursus satu per satu, LMS harus di-skalakan agar memfasilitasi "Sistem Langganan Bulanan" bagai Netflix.
- **Kebutuhan Database**: Penambahan lapisan pada `users` (seperti struktur langganan Cashier: `subscription_status`, `trial_ends_at`). Tabel rekap `subscription_plans`.
- **Kebutuhan Payment Gateway**: Mengintegrasikan sistem *Recurring Billing* pada Midtrans/Stripe khusus perputaran bulanan.
- **Kebutuhan Logika Autentikasi**: *Middleware* baru (misal `EnsureSubscribed`) untuk mendepak paksa akses video ketika durasi penagihan belum dilunasi pada bulan tersebut.

### Tahap 13: Mesin Gamifikasi & Pengelolaan Acara Jarak Jauh (Live Events)
Menerapkan psikologi gamifikasi (*Achievements*) untuk mendongkrak retensi penyelesaian para siswa.
- **Kebutuhan Skema Events**: Tabel `events` (tema, jadwal tayang, link Google Meet/Zoom, sisa kursi maksimal) -> Terhubung visualnya ke "Upcoming Events" Widget di Dasbor.
- **Kebutuhan Skema Gamifikasi**: Tabel master `badges/achievements` vs pivot `achievement_user`.
- **Kebutuhan Logic Event Trigger**: Menggunakan The Eloquent *Observers (Listeners)*. Contoh: ketika User menamatkan kuis pertamanya dengan > 90 poin, otomatis selipkan "The Perfectionist Badge" diam-diam ke laci mereka dan luncurkan animasi selebrasi di ranah antarmuka Dasbor.
