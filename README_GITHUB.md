# Panduan Update ke GitHub Repository

Anda telah meminta untuk mengupdate sistem ke repository: `https://github.com/betaraindra/billingisp`

Karena saya bekerja di lingkungan lokal Anda dan tidak memiliki akses langsung untuk melakukan `git push` ke akun GitHub Anda, silakan ikuti langkah-langkah berikut untuk mengunggah kode terbaru ini.

## Prasyarat
Pastikan Anda sudah menginstall Git di komputer Anda.

## Langkah-langkah

1.  **Buka Terminal / Command Prompt**
    Arahkan ke folder project ini.

2.  **Inisialisasi Git (Jika belum)**
    ```bash
    git init
    ```

3.  **Tambahkan Remote Repository**
    ```bash
    git remote add origin https://github.com/betaraindra/billingisp.git
    ```
    *Jika error "remote origin already exists", abaikan langkah ini.*

4.  **Tambahkan Semua File**
    ```bash
    git add .
    ```

5.  **Commit Perubahan**
    ```bash
    git commit -m "Update: Implementasi Login Aman, System Logs, dan CSRF Protection"
    ```

6.  **Push ke GitHub**
    ```bash
    git push -u origin main
    ```
    *Anda mungkin diminta memasukkan username dan password (atau Personal Access Token) GitHub Anda.*

## Fitur Keamanan Baru
Update ini mencakup:
- **Login System**: Menggunakan `password_verify` dan session management.
- **CSRF Protection**: Token CSRF pada form login untuk mencegah serangan Cross-Site Request Forgery.
- **System Logs**: Mencatat aktivitas login, logout, dan manajemen user ke database.
- **Role Based Access**: Menu "System Logs" hanya terlihat oleh admin.
