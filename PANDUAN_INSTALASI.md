# Panduan Instalasi di Localhost (XAMPP)

Aplikasi ini saat ini berjalan dalam mode **Node.js + React** di lingkungan preview ini. Namun, file `database.sql` telah disediakan agar Anda dapat membangun backend menggunakan PHP (Laravel/Native) di komputer lokal Anda.

## Persyaratan Sistem
- **XAMPP / Laragon** (untuk menjalankan PHP & MySQL di Windows)
- **PHP Version:** 8.0 - 8.3
- **MySQL / MariaDB**

## Cara Import Database

1.  Buka **XAMPP Control Panel** dan start **Apache** & **MySQL**.
2.  Buka browser dan akses `http://localhost/phpmyadmin`.
3.  Buat database baru dengan nama `isp_billing`.
4.  Klik tab **Import**.
5.  Pilih file `database.sql` yang telah dibuat.
6.  Klik **Go** / **Kirim**.

## Struktur Tabel
Database ini mencakup tabel-tabel berikut yang siap digunakan untuk aplikasi ISP Billing:

1.  **users**: Untuk login admin, teknisi, dan kasir.
2.  **customers**: Data pelanggan, alamat, dan paket yang dipilih.
3.  **packages**: Daftar paket internet (Kecepatan, Harga).
4.  **invoices**: Tagihan bulanan pelanggan.
5.  **payments**: Riwayat pembayaran tagihan.
6.  **routers**: Data perangkat jaringan (Mikrotik/OLT).

## Catatan Penting
Karena lingkungan preview ini menggunakan Node.js, kode PHP tidak dapat dijalankan secara langsung di sini. Anda perlu membuat script koneksi PHP (misalnya `koneksi.php` atau `.env` di Laravel) di komputer lokal Anda untuk menghubungkan script PHP Anda ke database `isp_billing` ini.
