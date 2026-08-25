# 🍽️ Kantin Multi-Tenant

Aplikasi kantin multi-tenant berbasis **Laravel 13** dan **Livewire 4**, dikembangkan untuk praktikum mata kuliah **Pemrograman Web Lanjut**, Politeknik Negeri Banyuwangi.

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=flat&logo=php&logoColor=white)
![Livewire](https://img.shields.io/badge/Livewire-4-4E56A6?style=flat&logo=livewire&logoColor=white)
![MariaDB](https://img.shields.io/badge/MariaDB-12.0-003545?style=flat&logo=mariadb&logoColor=white)
![Redis](https://img.shields.io/badge/Redis-Cache%2FQueue-DC382D?style=flat&logo=redis&logoColor=white)
![License](https://img.shields.io/badge/License-Academic-blue)

---

## 📖 Daftar Isi

- [Tech Stack](#️-tech-stack)
- [Requirements](#-requirements)
- [Panduan Instalasi](#-panduan-instalasi)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Testing & Quality Gate](#-testing--quality-gate)
- [Struktur Environment](#️-struktur-environment)
- [Troubleshooting](#-troubleshooting)
- [Catatan Zona Waktu](#-catatan-zona-waktu)
- [Lisensi](#-lisensi)

---

## 🛠️ Tech Stack

| Layer                       | Teknologi                           |
| :-------------------------- | :---------------------------------- |
| **Backend**                 | Laravel 13, PHP 8.4                 |
| **Frontend**                | Livewire 4 (single-file components) |
| **Database**                | MariaDB 12.0                        |
| **Cache / Session / Queue** | Redis                               |
| **Realtime**                | Laravel Reverb (WebSocket)          |
| **Testing**                 | PHPUnit                             |
| **Code Style**              | Laravel Pint                        |

---

## 📋 Requirements

Pastikan environment lokal sudah memenuhi kebutuhan berikut sebelum instalasi:

| Tool     | Versi Minimal |
| :------- | :------------ |
| PHP      | 8.3+          |
| Composer | Terbaru       |
| Node.js  | 18+           |
| NPM      | Terbaru       |
| MariaDB  | 10.x+         |
| Redis    | Terbaru       |
| Git      | Terbaru       |

> ⚠️ **Ekstensi PHP wajib aktif:** `pdo_mysql`, `mbstring`, `openssl`, `ctype`, `curl`, `fileinfo`, `xml`, `tokenizer`

---

## 🚀 Panduan Instalasi

### 1️⃣ Clone Repository

```bash
git clone https://github.com/mohridwanramadan/kantin-multi-tenant.git
cd kantin-multi-tenant
```

### 2️⃣ Install Dependencies

Install seluruh dependency PHP dan JavaScript:

```bash
composer install
npm install
```

### 3️⃣ Konfigurasi Environment & Key

Salin file `.env.example` menjadi `.env`, lalu generate application key:

```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Sesuaikan File `.env`

Buka file `.env` dan pastikan pengaturan database, Redis, serta Reverb sudah sesuai dengan environment lokal:

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

### 5️⃣ Migrasi Database & Seeder

> ⚠️ **Penting:** Buat database kosong terlebih dahulu sesuai nama yang diisi pada `DB_DATABASE`, sebelum menjalankan perintah migrasi.

Jalankan migrasi beserta seeder awal:

```bash
php artisan migrate:fresh --seed
```

### 6️⃣ Build Asset Frontend

Kompilasi aset frontend menggunakan Vite:

```bash
npm run build
```

### 7️⃣ Menjalankan Aplikasi

Jalankan HTTP server, Vite, dan queue worker sekaligus dengan satu perintah:

```bash
composer run dev
```

Aplikasi dapat diakses melalui browser di:

```
http://localhost:8000
```

> 📡 **Catatan Realtime:** Jika Reverb tidak berjalan otomatis, buka terminal terpisah dan jalankan:
>
> ```bash
> php artisan reverb:start
> ```

---

## 🧪 Testing & Quality Gate

Sebelum melakukan commit, pastikan seluruh pemeriksaan berikut berhasil (exit code `0`):

```bash
# 1. Jalankan pengujian unit & fitur
php artisan test

# 2. Cek format kode dengan Laravel Pint
./vendor/bin/pint --test

# 3. Build asset frontend
npm run build
```

Jika `pint --test` menemukan masalah format, jalankan tanpa flag `--test` untuk memperbaiki otomatis:

```bash
./vendor/bin/pint
```

---

## 🏗️ Struktur Environment

| Layanan     | Kegunaan                                                                                        |
| :---------- | :---------------------------------------------------------------------------------------------- |
| **MariaDB** | Data transaksional yang butuh integritas dan tahan gagal (tenant, order, payment, stok, ledger) |
| **Redis**   | Data berumur pendek atau berkecepatan tinggi (session, cache, cart, lock, queue)                |
| **Reverb**  | Broadcasting event realtime melalui WebSocket                                                   |

> 💡 Gunakan database dan kredensial **terpisah** antara environment _development_ dan _testing_, agar `migrate:fresh` atau flush Redis tidak memengaruhi data kerja.

---

## ❓ Troubleshooting

| Gejala                                                | Kemungkinan Penyebab                 | Perbaikan                                                                                                 |
| :---------------------------------------------------- | :----------------------------------- | :-------------------------------------------------------------------------------------------------------- |
| `could not find driver`                               | Ekstensi `pdo_mysql` belum aktif     | Aktifkan `extension=pdo_mysql` di `php.ini`, lalu restart PHP                                             |
| Port `3306`/`6379` bentrok                            | Port sudah dipakai service lain      | Ganti port di konfigurasi service dan `.env`, verifikasi dengan `db:show` dan `redis-cli ping`            |
| Vite manifest tidak ditemukan / halaman tanpa styling | Asset belum diinstal atau dibangun   | Jalankan `npm install` lalu `npm run build`                                                               |
| Error saat broadcasting/Reverb                        | Variabel `REVERB_*` kosong di `.env` | Lengkapi `REVERB_APP_ID`, `REVERB_APP_KEY`, `REVERB_APP_SECRET`, lalu jalankan `php artisan config:clear` |

---

## ⏰ Catatan Zona Waktu

Waktu transaksi disimpan dalam **UTC** pada database, dan dikonversi ke **Asia/Jakarta (WIB)** hanya pada batas presentasi (tampilan ke pengguna).

---

## 📄 Lisensi

Project ini dibuat untuk keperluan **akademik** praktikum Pemrograman Web Lanjut dan **bukan untuk produksi**.
