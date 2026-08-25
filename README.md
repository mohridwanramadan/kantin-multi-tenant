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

2. Environment & Application Key
   Bash
   cp .env.example .env
   php artisan key:generate

3. Konfigurasi Environment (.env)
   Sesuaikan variabel berikut pada file .env kamu

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
