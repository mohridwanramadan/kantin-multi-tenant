# Kantin Multi-Tenant

Aplikasi kantin multi-tenant berbasis Laravel 13 dan Livewire 4, dikembangkan untuk praktikum mata kuliah Pemrograman Web Lanjut, Politeknik Negeri Banyuwangi.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 13, PHP 8.4
- **Frontend:** Livewire 4 (single-file components)
- **Database:** MariaDB 12.0
- **Cache / Session / Queue:** Redis
- **Realtime:** Laravel Reverb
- **Testing:** PHPUnit
- **Code Style:** Laravel Pint

---

## 📋 Requirements

Pastikan environment lokal sudah memenuhi kebutuhan berikut sebelum instalasi:

| Tool         | Versi Minimal |
| :----------- | :------------ |
| **PHP**      | 8.3+          |
| **Composer** | Terbaru       |
| **Node.js**  | 18+           |
| **NPM**      | Terbaru       |
| **MariaDB**  | 10.x+         |
| **Redis**    | Terbaru       |
| **Git**      | Terbaru       |

> **Ekstensi PHP wajib aktif:** `pdo_mysql`, `mbstring`, `openssl`, `ctype`, `curl`, `fileinfo`, `xml`, `tokenizer`.

---

## ⚙️ Instalasi & Setup

1. **Clone repository ini dan masuk ke foldernya:**
    ```bash
    git clone [https://github.com/mohridwanramadan/kantin-multi-tenant.git](https://github.com/mohridwanramadan/kantin-multi-tenant.git)
    cd kantin-multi-tenant
    Install dependency PHP dan JavaScript:Bashcomposer install
    npm install
    Salin file environment dan generate application key:Bashcp .env.example .env
    php artisan key:generate
    Konfigurasi Environment (.env):Buka file .env, lalu sesuaikan konfigurasi berikut dengan environment lokal Anda:Ini, TOMLDB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

SESSION_DRIVER=redis
CACHE_STORE=redis
QUEUE_CONNECTION=redis

BROADCAST*CONNECTION=reverb
REVERB_APP_ID=
REVERB_APP_KEY=
REVERB_APP_SECRET=
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http
Migrasi Database & Seeder:Buat database kosong terlebih dahulu sesuai nama yang diisi pada DB_DATABASE, kemudian jalankan:Bashphp artisan migrate:fresh --seed
Build asset frontend:Bashnpm run build
🚀 Menjalankan AplikasiJalankan seluruh proses pengembangan (HTTP server, Vite, queue worker) dengan satu perintah:Bashcomposer run dev
Aplikasi dapat diakses di http://localhost:8000.Jika Reverb tidak ikut berjalan otomatis, jalankan di terminal terpisah:Bashphp artisan reverb:start
🧪 Testing dan Quality GateSebelum melakukan commit, pastikan seluruh pemeriksaan berikut berhasil (exit code 0):Bashphp artisan test
./vendor/bin/pint --test
npm run build
Jika ./vendor/bin/pint --test menemukan masalah format, jalankan tanpa flag --test untuk memperbaiki otomatis:Bash./vendor/bin/pint
🏗️ Struktur EnvironmentLayananKegunaanMariaDBData transaksional yang butuh integritas dan tahan gagal (tenant, order, payment, stok, ledger)RedisData berumur pendek atau berkecepatan tinggi (session, cache, cart, lock, queue)ReverbBroadcasting event realtime melalui WebSocketCatatan: Gunakan database dan kredensial terpisah antara environment development dan testing, agar migrate:fresh atau flush Redis tidak memengaruhi data kerja.❓ TroubleshootingGejalaKemungkinan PenyebabPerbaikancould not find driverEkstensi pdo_mysql belum aktifAktifkan ekstensi di php.ini, lalu restart PHPPort 3306 atau 6379 bentrokService lain sudah memakai port tersebutGanti port di konfigurasi service dan .env, lalu verifikasi dengan db:show dan redis-cli pingVite manifest tidak ditemukan / halaman tanpa stylingAsset belum diinstal atau dibangunJalankan npm install lalu npm run buildError saat broadcasting / ReverbVariabel REVERB*\* kosong di .envLengkapi REVERB_APP_ID, REVERB_APP_KEY, REVERB_APP_SECRET, lalu jalankan php artisan config:clear⏰ Catatan Zona WaktuWaktu transaksi disimpan dalam UTC pada database, dan dikonversi ke Asia/Jakarta (WIB) hanya pada batas presentasi (tampilan ke pengguna).📄 LisensiProject ini dibuat untuk keperluan akademik dan bukan untuk produksi.
