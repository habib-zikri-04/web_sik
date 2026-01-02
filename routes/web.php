<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminPresensiController;
use App\Http\Controllers\SantriPresensiController;
use App\Http\Controllers\Admin\RekapAbsensiController;
use App\Http\Controllers\SantriDashboardController;
use App\Http\Controllers\GuruDashboardController;
use App\Http\Controllers\GuruSantriController;
use App\Http\Controllers\GuruNilaiController;
use App\Http\Controllers\GuruPresensiController;
use App\Http\Controllers\Admin\RekapNilaiController;
use App\Http\Controllers\SantriNilaiController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\UserController;

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
    Route::get('/admin/presensi/qr/{jadwal_id}', [AdminPresensiController::class, 'getQr'])
        ->name('admin.presensi.qr');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/rekap-absensi', [RekapAbsensiController::class, 'index'])
            ->name('admin.rekap-absensi');
    Route::get(
    '/admin/rekap-absensi/pdf/{role}',
    [RekapAbsensiController::class, 'downloadPdf']
)->name('admin.rekap-absensi.pdf');

});

// Admin Kelas, Jadwal & User Management
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('admin/kelas', KelasController::class)->names('admin.kelas');
    Route::resource('admin/jadwal', JadwalController::class)->names('admin.jadwal');
    Route::resource('admin/users', UserController::class)->names('admin.users');
});

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::get('/admin/rekap-nilai',
        [RekapNilaiController::class, 'index']
    )->name('admin.rekap-nilai');

    Route::get('/admin/rekap-nilai/pdf',
        [RekapNilaiController::class, 'downloadPdf']
    )->name('admin.rekap-nilai.pdf');

});

// GURU
Route::middleware(['auth', 'verified', 'role:guru'])->group(function () {
    Route::get('/guru/dashboard', [GuruDashboardController::class, 'index'])
        ->name('guru.dashboard');
    Route::get('/guru/santri', [GuruSantriController::class, 'index'])
        ->name('guru.santri');
    // ✅ NILAI HARUS PAKAI JADWAL
    Route::get('/guru/nilai/{jadwal_id}', [GuruNilaiController::class, 'index'])
        ->name('guru.nilai');
    
    // Guru Presensi - Show QR codes for classes they teach
    Route::get('/guru/presensi', [GuruPresensiController::class, 'index'])
        ->name('guru.presensi');
    Route::get('/guru/presensi/qr/{jadwal_id}', [GuruPresensiController::class, 'getQr'])
        ->name('guru.presensi.qr');


    Route::post('/guru/nilai/simpan', [GuruNilaiController::class, 'store'])
        ->name('guru.nilai.store');
});

// SANTRI
Route::middleware(['auth', 'verified', 'role:santri'])->group(function () {
    Route::get('/santri/dashboard', [SantriDashboardController::class, 'index'])
        ->name('santri.dashboard');
});

Route::middleware(['auth', 'verified', 'role:santri'])->group(function () {
    Route::get('/santri/nilai', [SantriNilaiController::class, 'index'])
        ->name('santri.nilai');

    Route::get('/santri/sertifikat/{subject}', [SantriNilaiController::class, 'downloadSertifikat'])
        ->name('santri.sertifikat');
});


// Civitas - Dashboard & Presensi Mengaji
Route::middleware(['auth', 'verified', 'role:civitas'])->group(function () {
    Route::get('/civitas/dashboard', [\App\Http\Controllers\CivitasDashboardController::class, 'index'])
        ->name('civitas.dashboard');
    Route::get('/civitas/presensi', [\App\Http\Controllers\CivitasPresensiController::class, 'index'])
        ->name('civitas.presensi');
});

// Dema - Dashboard & Presensi Mengaji
Route::middleware(['auth', 'verified', 'role:dema'])->group(function () {
    Route::get('/dema/dashboard', [\App\Http\Controllers\DemaDashboardController::class, 'index'])
        ->name('dema.dashboard');
    Route::get('/dema/presensi', [\App\Http\Controllers\DemaPresensiController::class, 'index'])
        ->name('dema.presensi');
});

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.photo.delete');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// halaman scan QR & submit presensi untuk SANTRI
Route::middleware(['auth', 'verified', 'role:santri,guru,civitas,dema'])->group(function () {

    // halaman setelah scan QR
    Route::get('/presensi/scan', [PresensiController::class, 'scan'])
        // ->middleware('signed') // UNCOMMENT untuk production (QR harus signed)
        ->name('presensi.scan');

    // aksi simpan presensi
    Route::post('/presensi', [PresensiController::class, 'store'])
        ->name('presensi.store');
});

// Route khusus untuk Admin/Guru mengambil QR Code baru via AJAX
Route::middleware(['auth', 'verified', 'role:admin,guru'])->group(function () {
    Route::get('/admin/presensi/qr/{jadwal_id}', [AdminPresensiController::class, 'getQr'])
        ->name('admin.presensi.qr');
});

// PENGADUAN (Complaint System)
// 1. Guru & Civitas: Create & View Own
Route::middleware(['auth', 'verified', 'role:guru,civitas'])->group(function () {
    Route::resource('pengaduan', \App\Http\Controllers\PengaduanController::class)
        ->only(['index', 'create', 'store', 'show']);
});

// 2. Admin: View All & Update Status
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    // Admin pakai controller yang sama tapi logic index-nya beda (lihat controller)
    // Kita reuse route 'pengaduan.index' dan 'pengaduan.show' dari group atas jika admin akses?
    // Tapi admin prefixnya biasanya /admin.
    // Mari buat route khusus admin agar rapi, atau gabung.
    // Opsi gabung: Admin akses /pengaduan juga.
    // Agar konsisten dengan menu lain, kita buat alias /admin/pengaduan -> controller index
    
    Route::get('/admin/pengaduan', [\App\Http\Controllers\PengaduanController::class, 'index'])
        ->name('admin.pengaduan.index');
    
    Route::get('/admin/pengaduan/{pengaduan}', [\App\Http\Controllers\PengaduanController::class, 'show'])
        ->name('admin.pengaduan.show');

    Route::put('/admin/pengaduan/{pengaduan}', [\App\Http\Controllers\PengaduanController::class, 'update'])
        ->name('admin.pengaduan.update');
});


require __DIR__.'/auth.php';
