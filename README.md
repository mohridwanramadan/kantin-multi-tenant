# Kantin Multi-Tenant

Sistem aplikasi kantin multi-tenant berbasis Laravel untuk pengelolaan tenant, meja, dan pemesanan berbasis QR Code.

## 🚀 Panduan Setup

Jalankan perintah berikut di terminal untuk memulai proyek:

````bash
# 1. Install dependensi
composer install
npm install

# 2. Konfigurasi Environment
cp .env.example .env
php artisan key:generate

# 3. Database & Assets
php artisan migrate:fresh --seed
npm run build
💻 Menjalankan Aplikasi
Bash
# Jalankan server lokal
php artisan serve

# Jalankan pengujian
php artisan test
Akses aplikasi melalui browser di http://127.0.0.1:8000.


---

### Langkah Update ke GitHub:

1. Buka file **`README.md`** di VS Code.
2. Tempelkan teks di atas untuk menggantikan isi lama, lalu **Simpan** (`Ctrl + S`).
3. Jalankan perintah ini di terminal VS Code:

```bash
git add README.md
git commit -m "docs: update simpel README"
git push
````
