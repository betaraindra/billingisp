# Panduan Deployment Aplikasi ISP Billing (React + Node.js)

Aplikasi ini dibangun menggunakan teknologi modern **React (Frontend)** dan **Node.js (Backend)**. Meskipun bukan Laravel, aplikasi ini sangat fleksibel dan dapat dideploy ke berbagai environment yang Anda minta.

## 1. Localhost (Pengembangan)

### Persyaratan
- Node.js (v18 atau terbaru)
- NPM (bawaan Node.js)

### Cara Menjalankan
1. Buka terminal di folder project.
2. Install dependencies:
   ```bash
   npm install
   ```
3. Jalankan mode pengembangan:
   ```bash
   npm run dev
   ```
4. Akses di browser: `http://localhost:3000`

---

## 2. Shared Hosting (cPanel)

### Opsi A: Frontend Saja (Static)
Jika Anda hanya ingin menggunakan antarmuka (Frontend) dan menghubungkannya dengan backend lain (misal API Laravel yang sudah ada):

1. Di komputer lokal, jalankan perintah build:
   ```bash
   npm run build
   ```
2. Akan muncul folder `dist`.
3. Buka **File Manager** di cPanel.
4. Upload isi folder `dist` (index.html, assets, dll) ke folder `public_html`.
5. Aplikasi siap diakses via domain Anda.

### Opsi B: Full Stack (Node.js App)
Jika hosting Anda mendukung **Node.js Selector** (CloudLinux):

1. Upload seluruh file project (kecuali `node_modules`) ke cPanel.
2. Masuk ke menu **Setup Node.js App** di cPanel.
3. Buat aplikasi baru:
   - **Application Root**: Folder project yang diupload.
   - **Application URL**: Domain Anda.
   - **Startup File**: `server.ts` (atau compile dulu ke JS).
4. Klik **Run NPM Install**.
5. Klik **Start App**.

---

## 3. VPS (CyberPanel / OpenLiteSpeed / Ubuntu)

Ini adalah metode yang paling direkomendasikan untuk performa terbaik.

### Langkah-langkah (Ubuntu/Debian):

1. **Masuk ke VPS via SSH**.
2. **Install Node.js & PM2**:
   ```bash
   curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
   sudo apt-get install -y nodejs
   sudo npm install -g pm2
   ```
3. **Upload Project** (bisa via Git atau SCP).
4. **Install Dependencies & Build**:
   ```bash
   cd /path/to/project
   npm install
   npm run build
   ```
5. **Jalankan Aplikasi dengan PM2**:
   ```bash
   pm2 start server.ts --name "isp-billing" --interpreter node --import tsx
   ```
6. **Setup Reverse Proxy (Nginx/OpenLiteSpeed)**:
   Arahkan domain Anda ke port aplikasi (default: 3000).

   **Contoh Config Nginx:**
   ```nginx
   server {
       listen 80;
       server_name domain-anda.com;

       location / {
           proxy_pass http://localhost:3000;
           proxy_http_version 1.1;
           proxy_set_header Upgrade $http_upgrade;
           proxy_set_header Connection 'upgrade';
           proxy_set_header Host $host;
       }
   }
   ```

## 4. Localhost XAMPP (Alternatif)

Jika Anda terbiasa dengan XAMPP (Apache):

1. Lakukan **Build** project (`npm run build`).
2. Copy isi folder `dist` ke folder `htdocs/nama-folder` di XAMPP.
3. Nyalakan Apache di XAMPP Control Panel.
4. Akses `http://localhost/nama-folder`.
   *Catatan: Ini hanya menjalankan Frontend. Untuk fitur backend (API), Anda tetap perlu menjalankan Node.js secara terpisah atau migrasi backend ke PHP.*
