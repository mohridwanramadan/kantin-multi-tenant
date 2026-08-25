<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class TenantCommission extends Model
{
    // Keterangan: protected $guarded = [] digunakan agar semua kolom di tabel database boleh diisi data
    protected $guarded = [];

    /**
     * Keterangan: Fungsi boot() ini otomatis berjalan setiap kali ada data komisi baru yang mau disimpan.
     * Berfungsi sebagai detektif otomatis untuk mencegah tanggal potongan yang tabrakan (anti-overlap).
     */
    protected static function boot()
    {
        parent::boot();

        // Keterangan: Fungsi ini mendeteksi sesaat sebelum data masuk ke database (saving)
        static::saving(function ($commission) {

            // 1. Robot mencari di database: Apakah ada tenant_id (lapak kantin) yang sama?
            $overlap = self::where('tenant_id', $commission->tenant_id)
                ->where(function ($query) use ($commission) {

                    // 2. Robot mengecek kondisi tanggal pertama
                    $query->where(function ($q) use ($commission) {
                        // Cek jika tanggal mulai baru berada di dalam rentang tanggal yang sudah terdaftar
                        $q->where('valid_from', '<=', $commission->valid_from)
                            ->where('valid_to', '>=', $commission->valid_from);
                    })

                    // 3. Robot mengecek kondisi tanggal kedua
                        ->orWhere(function ($q) use ($commission) {
                            // Cek jika tanggal selesai baru berada di dalam rentang tanggal yang sudah terdaftar
                            if ($commission->valid_to) {
                                $q->where('valid_from', '<=', $commission->valid_to)
                                    ->where('valid_to', '>=', $commission->valid_to);
                            }
                        });
                })

                // 4. Pengaman tambahan: Jika kita hanya mengedit data lama, jangan bandingkan dengan diri sendiri
                ->when($commission->exists, function ($query) use ($commission) {
                    $query->where('id', '!=', $commission->id);
                })
                ->exists(); // Keterangan: Menghasilkan nilai true jika ada yang tabrakan

            // 5. Keputusan akhir: Jika detektif menemukan tanggal yang tabrakan, batalkan penyimpanan data
            if ($overlap) {
                throw ValidationException::withMessages([
                    'valid_from' => 'Gagal menyimpan! Periode tanggal potongan komisi untuk kantin ini sudah ada yang aktif dan saling bertabrakan ya bosh (overlap).',
                ]);
            }
        });
    }
}
