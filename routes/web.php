<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// semua yang login & verified
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });

    // GURU
    Route::middleware('role:guru')->group(function () {
        Route::get('/guru/dashboard', function () {
            return view('guru.dashboard');
        })->name('guru.dashboard');
    });

    // SISWA
    Route::middleware('role:siswa')->group(function () {
        Route::get('/siswa/dashboard', function () {
            return view('siswa.dashboard');
        })->name('siswa.dashboard');
    });

    // SEMA
    Route::middleware('role:sema')->group(function () {
        Route::get('/sema/dashboard', function () {
            return view('sema.dashboard');
        })->name('sema.dashboard');
    });

    // DEMA
    Route::middleware('role:dema')->group(function () {
        Route::get('/dema/dashboard', function () {
            return view('dema.dashboard');
        })->name('dema.dashboard');
    });
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
