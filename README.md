# Kantin Multi-Tenant

Aplikasi kantin multi-tenant berbasis Laravel 13 dan Livewire 4, dikembangkan untuk praktikum mata kuliah Pemrograman Web Lanjut, Politeknik Negeri Banyuwangi.

## Tech Stack

- **Backend:** Laravel 13, PHP 8.4
- **Frontend:** Livewire 4 (single-file components)
- **Database:** MariaDB 12.0
- **Cache / Session / Queue:** Redis
- **Realtime:** Laravel Reverb
- **Testing:** PHPUnit
- **Code Style:** Laravel Pint

## Requirements

| Tool         | Versi Minimal |
| :----------- | :------------ |
| **PHP**      | 8.3+          |
| **Composer** | Terbaru       |
| **Node.js**  | 18+           |
| **NPM**      | Terbaru       |
| **MariaDB**  | 10.x+         |
| **Redis**    | Terbaru       |
| **Git**      | Terbaru       |

> Ekstensi PHP wajib aktif: `pdo_mysql`, `mbstring`, `openssl`, `ctype`, `curl`, `fileinfo`, `xml`, `tokenizer`.

## Instalasi & Setup

```bash
# 1. Clone repository & masuk folder
git clone [https://github.com/mohridwanramadan/kantin-multi-tenant.git](https://github.com/mohridwanramadan/kantin-multi-tenant.git)
cd kantin-multi-tenant

# 2. Install dependency PHP & Node.js
composer install
npm install

# 3. Environment & Key
cp .env.example .env
php artisan key:generate

# 4. Migrasi Database & Build Aset
php artisan migrate:fresh --seed
npm run build
```
