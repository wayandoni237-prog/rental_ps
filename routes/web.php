<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController, BerandaController, TamuController, AdminController};

// --- Halaman Utama ---
Route::get('/', [BerandaController::class, 'index'])->name('beranda');

// --- Autentikasi (Login & Register) ---
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- Area Tamu (PPLG Style) ---
Route::middleware(['auth', 'tamu'])->prefix('tamu')->name('tamu.')->group(function () {
    Route::get('/dashboard', [TamuController::class, 'dashboard'])->name('dashboard');
    Route::get('/ruangan', [TamuController::class, 'ruangan'])->name('ruangan');
    Route::get('/ruangan/{ruangan}', [TamuController::class, 'detailRuangan'])->name('detail-ruangan');
    Route::get('/booking/{ruangan}', [TamuController::class, 'showBooking'])->name('booking');
    Route::post('/booking/{ruangan}', [TamuController::class, 'storeBooking'])->name('booking.store');
    Route::get('/my-bookings', [TamuController::class, 'myBookings'])->name('my-bookings');
    Route::post('/booking/cancel/{booking}', [TamuController::class, 'cancelBooking'])->name('booking.cancel');
});

// --- Area Admin ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::controller(AdminController::class)->group(function () {
        // Manajemen User
        Route::get('/user', 'daftarUser')->name('user');
        Route::get('/user/tambah', 'tambahUser')->name('user.tambah');
        Route::post('/user/tambah', 'simpanUser')->name('user.simpan');
        Route::get('/user/edit/{user}', 'editUser')->name('user.edit'); 
        Route::put('/user/edit/{user}', 'updateUser')->name('user.update');
        Route::delete('/user/hapus/{user}', 'hapusUser')->name('user.hapus');

        // Manajemen Ruangan
        Route::get('/ruangan', 'daftarRuangan')->name('ruangan');
        Route::get('/ruangan/tambah', 'tambahRuangan')->name('ruangan.tambah');
        Route::post('/ruangan/tambah', 'simpanRuangan')->name('ruangan.simpan');
        Route::get('/ruangan/edit/{ruangan}', 'editRuangan')->name('ruangan.edit'); 
        Route::put('/ruangan/edit/{ruangan}', 'updateRuangan')->name('ruangan.update');
        Route::delete('/ruangan/hapus/{ruangan}', 'hapusRuangan')->name('ruangan.hapus');

        // Manajemen Booking
        Route::get('/booking', 'daftarBooking')->name('booking');
        Route::get('/booking/{booking}', 'detailBooking')->name('booking.detail'); 
        Route::put('/booking/status/{booking}', 'updateStatusBooking')->name('booking.status');
    });
});