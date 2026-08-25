# 🍽️ Kantin Multi-Tenant

Aplikasi kantin multi-tenant berbasis **Laravel 13** dan **Livewire 4**.

---

## 📋 Requirements

| Kebutuhan     | Versi         |
| ------------- | ------------- |
| PHP           | 8.3+          |
| Composer      | Terbaru       |
| Node.js & NPM | 18+ / Terbaru |
| Database      | MariaDB 10.x+ |
| Cache & Queue | Redis         |

**Ekstensi PHP Wajib:**
`pdo_mysql`, `mbstring`, `openssl`, `ctype`, `curl`, `fileinfo`, `xml`, `tokenizer`

---

## ⚙️ Setup

### 1. Clone Repository & Install Dependencies

```bash
git clone https://github.com/mohridwanramadan/kantin-multi-tenant.git
cd kantin-multi-tenant
composer install
npm install
```

### 2. Environment & Key Configuration

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Environment (`.env`)

Buka file `.env` dan sesuaikan kredensial berikut:

```env
DB_CONNECTION=mysql
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
REVERB_SCHEME=http
```

### 4. Database Migration & Asset Build

> **Catatan:** Buat database kosong terlebih dahulu di MariaDB sesuai `DB_DATABASE`.

```bash
php artisan migrate:fresh --seed
npm run build
```

---

## 🚀 Run

Jalankan server lokal, Vite, dan queue worker secara bersamaan dengan satu perintah:

```bash
composer run dev
```

Akses aplikasi di browser: **http://localhost:8000**

> **(Opsional)** Jika Reverb tidak berjalan otomatis, jalankan di terminal terpisah:
>
> ```bash
> php artisan reverb:start
> ```

---

## 🧪 Test

Jalankan pengujian unit dan periksa format kode sebelum melakukan commit:

```bash
# Pengujian fitur
php artisan test

# Cek format kode
./vendor/bin/pint --test

# Perbaiki format kode otomatis
./vendor/bin/pint
```

---

## ❓ Troubleshooting

| Gejala                               | Kemungkinan Penyebab                 | Perbaikan                                                                        |
| ------------------------------------ | ------------------------------------ | -------------------------------------------------------------------------------- |
| `could not find driver`              | Ekstensi `pdo_mysql` belum aktif     | Aktifkan `extension=pdo_mysql` di `php.ini`, lalu restart PHP                    |
| Port `3306` / `6379` bentrok         | Terpakai oleh service lain           | Ubah port di `.env` dan konfigurasi service                                      |
| Vite manifest tidak ada / no styling | Aset frontend belum dibangun         | Jalankan `npm install && npm run build`                                          |
| Error Reverb / WebSocket             | Variabel `REVERB_*` di `.env` kosong | Lengkapi variabel `REVERB_*` di `.env`, lalu jalankan `php artisan config:clear` |
