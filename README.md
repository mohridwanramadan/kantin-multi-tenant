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

2. Environment & Application KeyBashcp .env.example .env
   php artisan key:generate
3. Konfigurasi Environment (.env)Buka file .env dan sesuaikan variabel berikut dengan environment lokal Anda:Ini, TOMLDB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379

SESSION_DRIVER=redis
CACHE_STORE=redis
QUEUE_CONNECTION=redis

BROADCAST_CONNECTION=reverb
REVERB_APP_ID=
REVERB_APP_KEY=
REVERB_APP_SECRET=
REVERB_HOST=localhost
REVERB_PORT=8080
REVERB_SCHEME=http 4. Database Migration & BuildPenting: Buat database kosong terlebih dahulu di MariaDB/MySQL sesuai nama DB_DATABASE pada file .env.Bashphp artisan migrate:fresh --seed
npm run build
🚀 Menjalankan AplikasiJalankan server lokal, Vite, dan queue worker secara bersamaan dengan satu perintah:Bashcomposer run dev
Akses aplikasi melalui browser di: http://localhost:8000Jika fitur realtime Reverb tidak otomatis berjalan, jalankan di terminal terpisah:Bashphp artisan reverb:start
🧪 Testing & Quality GateSebelum melakukan commit, pastikan seluruh pemeriksaan berjalan sukses (exit code 0):Bash# Jalankan pengujian unit & fitur
php artisan test

# Cek format kode

./vendor/bin/pint --test

# Re-build aset frontend

npm run build
Jika ./vendor/bin/pint --test menemukan error format, jalankan ./vendor/bin/pint tanpa flag untuk merapikannya secara otomatis.🏗️ Struktur EnvironmentLayananKegunaanMariaDBData transaksional yang butuh integritas tinggi (tenant, order, payment, stok, ledger)RedisData berumur pendek atau berkecepatan tinggi (session, cache, cart, lock, queue)ReverbBroadcasting event realtime melalui WebSocket❓ TroubleshootingGejalaKemungkinan PenyebabPerbaikancould not find driverEkstensi pdo*mysql belum aktifAktifkan extension=pdo_mysql di file php.ini, lalu restart PHP.Port 3306 atau 6379 bentrokPort sedang digunakan service lainUbah port di konfigurasi service dan file .env, lalu verifikasi via redis-cli ping.Vite manifest tidak ditemukanAset frontend belum dibangunJalankan npm install && npm run build.Error broadcasting / ReverbVariabel REVERB*_ di .env kosongLengkapi kredensial REVERB\__, lalu jalankan php artisan config:clear.
