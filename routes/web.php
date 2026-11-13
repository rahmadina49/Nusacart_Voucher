<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoucherController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Halaman Utama / Welcome
Route::get('/', function () {
    return view('welcome');
});

// Route untuk Modul Voucher (Dilindungi Middleware Auth & Role)
Route::middleware(['auth'])->group(function () {
    
    // Lihat Data (Admin & Staff)
    Route::get('/vouchers', [VoucherController::class, 'index'])->name('vouchers.index');
    
    // Tambah Data (Admin & Staff)
    Route::get('/vouchers/create', [VoucherController::class, 'create'])->name('vouchers.create');
    Route::post('/vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
    
    // Ubah Data (Admin & Staff)
    Route::get('/vouchers/{id}/edit', [VoucherController::class, 'edit'])->name('vouchers.edit');
    Route::put('/vouchers/{id}', [VoucherController::class, 'update'])->name('vouchers.update');
    
    // Hapus Data (KHUSUS ADMIN)
    Route::delete('/vouchers/{id}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');

});

// Rute Instan untuk Login Otomatis (Keperluan Screenshot Tugas)
Route::get('/login-admin', function () {
    $admin = User::where('role', 'admin')->first();
    if ($admin) {
        Auth::login($admin);
        return redirect('/vouchers');
    }
    return 'Akun admin belum ada di database!';
});

Route::get('/login-staff', function () {
    $staff = User::where('role', 'staff')->first();
    if ($staff) {
        Auth::login($staff);
        return redirect('/vouchers');
    }
    return 'Akun staff belum ada di database!';
});

// Route bawaan autentikasi Laravel (Laravel Breeze / Jetstream)
// require __DIR__.'/auth.php';