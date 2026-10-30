# BersihNegeri
Platform Pengelolaan Sampah dan Pelestarian Lingkungan Indonesia.

## Fitur utama
- Portal publik dengan ringkasan statistik pengelolaan sampah.
- Pelaporan titik penumpukan sampah oleh masyarakat, dilengkapi lokasi dan foto opsional (URL).
- Pelacakan status laporan: Menunggu, Diverifikasi, Ditangani, Selesai, Ditolak.
- Direktori bank sampah dan tempat daur ulang.
- Jadwal pengangkutan sampah.
- Edukasi pemilahan sampah organik, anorganik, dan B3 rumah tangga.
- Dashboard admin/petugas untuk mengelola laporan, lokasi daur ulang, dan jadwal.
- Autentikasi berbasis session, password hashing, PDO prepared statements, CSRF token, dan validasi input.

## Teknologi
PHP 8+, MySQL/MariaDB, HTML5, CSS3, JavaScript, PDO.

## Instalasi XAMPP
1. Ekstrak folder `BersihNegeri` ke `C:\xampp\htdocs\`.
2. Jalankan Apache dan MySQL.
3. Buka phpMyAdmin, lalu import `database/bersih_negeri.sql`.
4. Periksa konfigurasi `config/database.php` (default XAMPP: user root tanpa password).
5. Buka `http://localhost/BersihNegeri/`.

## Akun demo
Admin:
- Email: `admin@bersihnegeri.id`
- Password: `password`

Petugas:
- Email: `petugas@bersihnegeri.id`
- Password: `password`

Ganti password demo sebelum penggunaan nyata.

## Catatan
- Data lokasi, jadwal, dan statistik pada database merupakan data contoh/demonstrasi, bukan informasi resmi pemerintah.
- Form laporan menyimpan lokasi berupa teks alamat/area dan koordinat opsional. Peta interaktif menggunakan OpenStreetMap melalui Leaflet dan memerlukan koneksi internet.
- Foto laporan pada versi ini disimpan sebagai URL gambar opsional; unggah file lokal dapat ditambahkan pada pengembangan lanjutan.
- Prototype ini belum terhubung dengan sistem persampahan pemerintah atau API resmi.
