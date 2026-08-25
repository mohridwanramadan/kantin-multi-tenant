<?php

namespace Database\Seeders;

use App\Models\TenantCommission;
use Illuminate\Database\Seeder;

class TenantCommissionSeeder extends Seeder
{
    /**
     * Menjalankan proses pengisian data contoh ke database.
     */
    public function run(): void
    {
        // 1. Mengisi contoh data komisi pertama untuk Kantin Nomor 1 (Lapak Soto)
        TenantCommission::create([
            'tenant_id' => 1,
            'rate' => 10.00, // Potongan 10%
            'valid_from' => '2026-01-01', // Berlaku mulai 1 Januari 2026
            'valid_to' => '2026-01-15', // Berakhir tanggal 15 Januari 2026
            'note' => 'Tarif komisi promo awal tahun untuk Lapak Soto daging unta',
        ]);

        // 2. Mengisi contoh data komisi kedua untuk Kantin Nomor 1 (Lapak Soto)
        // Tanggal ini aman karena dimulai tanggal 16 Januari (setelah promo pertama selesai)
        TenantCommission::create([
            'tenant_id' => 1,
            'rate' => 15.00, // Potongan naik jadi 15%
            'valid_from' => '2026-01-16', // Berlaku mulai 16 Januari 2026
            'valid_to' => '2026-02-28', // Berakhir tanggal 28 Februari 2026
            'note' => 'Tarif komisi normal pasca promo',
        ]);
    }
}
