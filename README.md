# Panduan Instalasi (Versi Tanpa Build / Native PHP)

Versi ini dirancang agar Anda bisa langsung upload ke hosting (cPanel/CyberPanel/XAMPP) tanpa perlu install Node.js atau menjalankan perintah build.

## Struktur Folder
- `index.php`: File utama aplikasi.
- `views/`: Berisi halaman-halaman (Dashboard, Customers, dll).
- `api/`: Berisi backend PHP untuk koneksi database.
- `database.sql`: File database yang harus diimport.

## Cara Instalasi

1. **Upload File**
   Upload semua file dan folder (kecuali `node_modules`, `src`, `dist`) ke folder `public_html` atau `htdocs` di hosting Anda.
   
   Pastikan file-file berikut ada di root folder hosting Anda:
   - `index.php`
   - `views/` (folder)
   - `api/` (folder)

2. **Buat Database**
   - Buka phpMyAdmin.
   - Buat database baru, misal: `isp_billing`.
   - Import file `database.sql` ke database tersebut.

3. **Konfigurasi Database**
   - Buka file `api/config.php`.
   - Edit bagian berikut sesuai detail database Anda:
     ```php
     $host = "localhost";
     $db_name = "isp_billing";
     $username = "root"; // Ganti dengan user database Anda
     $password = "";     // Ganti dengan password database Anda
     ```

4. **Selesai**
   Buka domain Anda di browser. Aplikasi siap digunakan!

## Catatan
- Aplikasi ini menggunakan **Tailwind CSS** dan **Alpine.js** via CDN (Internet diperlukan saat pertama kali load).
- Jika Anda ingin mengubah tampilan, edit file di folder `views/`.
- Jika Anda ingin mengubah logika backend, edit file di folder `api/`.
