<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// --- ROUTE BAWAAN PROYEK ---
Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// --- TAHAP 5: RESOLVE SCAN & ANONYMOUS SESSION ---
Route::get('/q/{token}', function ($token) {
    // A. Ubah token mentah dari URL menjadi Hash SHA-256
    $hashedToken = hash('sha256', $token);

    // B. Lookup ke database (tabel qr_tokens)
    $qrData = DB::table('qr_tokens')
        ->join('tables', 'qr_tokens.table_id', '=', 'tables.id')
        ->join('canteens', 'tables.canteen_id', '=', 'canteens.id')
        ->where('qr_tokens.token_hash', $hashedToken)
        ->where('qr_tokens.is_active', true)
        ->where('qr_tokens.expires_at', '>', now())
        ->where('tables.is_active', true)
        ->where('canteens.is_active', true)
        ->select(
            'qr_tokens.id as qr_id',
            'tables.id as table_id',
            'tables.name as table_name',
            'canteens.id as canteen_id',
            'canteens.name as canteen_name',
            'canteens.slug as canteen_slug'
        )
        ->first();

    if (! $qrData) {
        return response()->json([
            'status' => 'error',
            'message' => 'QR Code tidak valid, sudah kadaluwarsa, atau meja tidak aktif.',
        ], 404);
    }

    // C. Buat ULID Anonim
    if (! session()->has('guest_ulid')) {
        session(['guest_ulid' => (string) Str::ulid()]);
    }

    // D. Simpan konteks meja ke Session
    session([
        'canteen_id' => $qrData->canteen_id,
        'canteen_slug' => $qrData->canteen_slug,
        'table_id' => $qrData->table_id,
        'table_name' => $qrData->table_name,
        'qr_id' => $qrData->qr_id,
    ]);

    return response()->json([
        'status' => 'success',
        'message' => 'Sesi pengunjung berhasil dibuat',
        'guest_session' => [
            'guest_ulid' => session('guest_ulid'),
            'canteen_name' => $qrData->canteen_name,
            'table_name' => $qrData->table_name,
            'redirect_to' => route('home'),
        ],
    ]);
})->middleware('throttle:10,1');

require __DIR__.'/settings.php';
