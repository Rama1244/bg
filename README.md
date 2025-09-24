# Rekap Bulanan - Laravel Monthly Summary Application

Aplikasi web berbasis Laravel untuk mengelola rekap bulanan dengan fitur pencatatan nominal dan hutang.

## Fitur Utama

- ✅ Tabel rekap data bulanan (September 2025 - Desember 2026)
- ✅ Kolom BULAN, NOMINAL, HUTANG yang dapat diedit
- ✅ Form edit yang user-friendly dengan preview real-time
- ✅ Total otomatis (NOMINAL - HUTANG) yang ter-update secara real-time
- ✅ Desain responsif dan mobile-friendly
- ✅ Database SQLite dengan migrasi otomatis
- ✅ Seed data untuk testing
- ✅ Interface yang minimalis dan mudah digunakan

## Teknologi

- **Backend**: PHP 8.3+ dengan struktur mirip Laravel
- **Database**: SQLite
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **Styling**: Custom CSS dengan gradient modern dan responsive design

## Instalasi & Menjalankan

1. **Clone repository**:
   ```bash
   git clone https://github.com/Rama1244/bg.git
   cd bg
   ```

2. **Jalankan server development**:
   ```bash
   php -S localhost:8000 -t public
   ```

3. **Akses aplikasi**:
   Buka browser dan kunjungi `http://localhost:8000`

## Struktur Database

Tabel `monthly_summaries`:
- `id` - Primary key
- `bulan` - Nama bulan (VARCHAR)
- `nominal` - Jumlah nominal (DECIMAL)
- `hutang` - Jumlah hutang (DECIMAL)
- `created_at` - Timestamp
- `updated_at` - Timestamp

## Cara Penggunaan

1. **Melihat Data**: Halaman utama menampilkan tabel dengan semua data bulanan
2. **Edit Data**: Klik tombol "Edit" pada baris yang ingin diubah
3. **Simpan Perubahan**: Masukkan nilai baru dan klik "Simpan Perubahan"
4. **Lihat Total**: Total otomatis dihitung dan ditampilkan di bagian bawah

## Fitur Mobile

- Tabel responsif yang menyesuaikan ukuran layar
- Form edit yang mudah digunakan di perangkat mobile
- Button dan input field yang touch-friendly
- Layout yang optimal untuk layar kecil

## Screenshot

### Desktop View
![Desktop View](https://github.com/user-attachments/assets/3209611a-f553-4ae1-85ab-41a37dff5596)

### Mobile View
![Mobile View](https://github.com/user-attachments/assets/063c7874-a17d-41e4-87de-5b67ae4b4e5d)

### Edit Form
![Edit Form](https://github.com/user-attachments/assets/4b0b5fac-5433-4d72-9459-cf29bca8c081)

## Struktur File

```
bg/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── MonthlySummaryController.php
│   └── Models/
│       └── MonthlySummary.php
├── database/
│   └── database.sqlite
├── public/
│   └── index.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.php
│       └── monthly-summary/
│           ├── index.php
│           └── edit.php
├── routes/
│   └── web.php
└── README.md
```

## Pengembangan

Aplikasi ini dibuat dengan pendekatan minimal namun lengkap, menggunakan:
- MVC pattern
- Clean and readable code
- Responsive design
- Real-time calculations
- Mobile-first approach

## Kontribusi

Silakan buat pull request untuk perbaikan atau penambahan fitur baru.

## Lisensi

MIT License