# Panduan Instalasi di XAMPP (Tanpa Node.js)

Aplikasi ini telah dikonfigurasi agar bisa berjalan langsung di folder `htdocs` XAMPP menggunakan PHP Native sebagai backend.

## Langkah 1: Build Frontend (Sekali Saja)
Anda perlu melakukan "build" frontend React menjadi file HTML/JS biasa. Lakukan ini di komputer Anda sebelum upload ke server/XAMPP.

1. Buka terminal di folder project.
2. Jalankan perintah:
   ```bash
   npm run build
   ```
3. Akan muncul folder baru bernama `dist`. Folder inilah yang berisi aplikasi jadi.

## Langkah 2: Setup Database
1. Buka **phpMyAdmin** (`http://localhost/phpmyadmin`).
2. Buat database baru bernama `isp_billing`.
3. Import file `database.sql` yang ada di root project ini ke database tersebut.

## Langkah 3: Pindahkan ke htdocs
1. Buka folder `dist` hasil build tadi.
2. Copy **seluruh isi** folder `dist` ke dalam folder baru di htdocs, misalnya `C:\xampp\htdocs\billing`.
   - Struktur folder harusnya seperti ini:
     - `htdocs\billing\index.html`
     - `htdocs\billing\assets\...`
     - `htdocs\billing\api\config.php`
     - `htdocs\billing\api\users.php`
     - dll...

## Langkah 4: Konfigurasi Database
1. Buka file `htdocs\billing\api\config.php`.
2. Sesuaikan username dan password database jika berbeda (default: root, tanpa password).

## Langkah 5: Jalankan
Buka browser dan akses: `http://localhost/billing`

Aplikasi akan menggunakan URL dengan tanda pagar (HashRouter), contoh: `http://localhost/billing/#/customers`. Ini normal dan memastikan aplikasi berjalan lancar di sub-folder.

---

## Catatan Penting
- **API Endpoint**: Frontend akan memanggil API ke folder `/api/`. Pastikan folder `api` ikut ter-copy dari `public/api` ke `dist/api` saat build (Vite otomatis melakukan ini).
- **Routing**: File `.htaccess` di root folder berfungsi agar saat Anda refresh halaman di sub-menu (misal `/customers`), tidak terjadi error 404. Pastikan module `mod_rewrite` aktif di Apache XAMPP Anda.
