# Website Universitas Muhammadiyah Bengkulu

Website data mahasiswa per program studi bertema Web Semantik, dibuat dengan PHP + MySQL.

## Cara menjalankan
1. Salin `config.example.php` menjadi `config.php`
2. Isi 4 variabel (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`) sesuai database MySQL Anda
3. Upload semua file ke server (mendukung hosting PHP + MySQL, misalnya InfinityFree)
4. Tabel dan akun demo akan dibuat otomatis saat pertama kali diakses

## Akun demo
- Admin: `admin` / `admin123`
- Mahasiswa: `2101001` / `mhs123`

## Struktur halaman
- `index.php` — Beranda
- `login.php` — Login (pilih peran: Mahasiswa/Admin)
- `admin.php` — Dashboard Admin (kelola program studi & akun mahasiswa)
- `mahasiswa.php` — Dashboard Mahasiswa (profil & grafik sebaran)
