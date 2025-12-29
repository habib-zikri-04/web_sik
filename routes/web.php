<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPresensiController;
use App\Http\Controllers\SantriPresensiController;
use App\Http\Controllers\Admin\RekapAbsensiController;

use App\Http\Controllers\PresensiController;
use Illuminate\Http\Request;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    return match($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'guru'  => redirect()->route('guru.dashboard'),
        'santri' => redirect()->route('santri.dashboard'),
        'civitas'  => redirect()->route('civitas.dashboard'),
        'dema'  => redirect()->route('dema.dashboard'),
        default => redirect('/'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');


// ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/presensi', [AdminPresensiController::class, 'index'])
        ->name('admin.presensi');
    Route::get('/admin/rekap-absensi', [RekapAbsensiController::class, 'index'])
            ->name('admin.rekap-absensi');
    Route::get(
    '/admin/rekap-absensi/pdf/{role}',
    [RekapAbsensiController::class, 'downloadPdf']
)->name('admin.rekap-absensi.pdf');

});

// GURU
Route::middleware(['auth', 'verified', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', function () {
        return view('guru.dashboard');
    })->name('guru.dashboard');
});

// SANTRI
Route::middleware(['auth', 'verified', 'role:santri'])->group(function () {

    Route::get('/santri/dashboard', function () {
        return view('santri.dashboard');
    })->name('santri.dashboard');
});


// Civitas
Route::middleware(['auth', 'verified', 'role:civitas'])->group(function () {
    Route::get('/civitas/dashboard', function () {
        return view('civitas.dashboard');
    })->name('civitas.dashboard');
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// halaman scan QR & submit presensi untuk SANTRI
Route::middleware(['auth', 'verified', 'role:santri,guru,civitas'])->group(function () {

    // halaman setelah scan QR
    Route::get('/presensi/scan', [PresensiController::class, 'scan'])
        ->name('presensi.scan');

    // aksi simpan presensi
    Route::post('/presensi', [PresensiController::class, 'store'])
        ->name('presensi.store');
});


require __DIR__.'/auth.php';
