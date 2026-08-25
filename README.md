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

Install dependency PHP dan JavaScript:

Bash
composer install
npm install

Salin file environment dan generate application key:

Bash
cp .env.example .env
php artisan key:generate
