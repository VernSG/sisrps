<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard.admin', [
                'totalMahasiswa' => \App\Models\MahasiswaProfile::count(),
                'totalDosen' => \App\Models\DosenProfile::count(),
                'totalMatkul' => \App\Models\Matkul::count(),
                'totalUsers' => \App\Models\User::count()
            ]);
        })->name('admin.dashboard');

        // User Management Routes
        Route::resource('admin/users', \App\Http\Controllers\UserController::class, [
            'names' => [
                'index' => 'admin.users.index',
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
                'show' => 'admin.users.show',
                'edit' => 'admin.users.edit',
                'update' => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]
        ]);

        // Dosen Mata Kuliah Assignment Routes
        Route::get('/admin/dosen-matkul', [\App\Http\Controllers\DosenMatkulController::class, 'index'])
            ->name('admin.dosen-matkul.index');
        Route::get('/admin/dosen-matkul/{dosen}', [\App\Http\Controllers\DosenMatkulController::class, 'show'])
            ->name('admin.dosen-matkul.show');
        Route::put('/admin/dosen-matkul/{dosen}', [\App\Http\Controllers\DosenMatkulController::class, 'update'])
            ->name('admin.dosen-matkul.update');
    });

    // Route group untuk Dosen
    Route::middleware(['dosen'])->prefix('dosen')->name('dosen.')->group(function () {
        // Dosen Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\DosenDashboardController::class, 'index'])->name('dashboard');
        
        // Daftar mata kuliah yang dia ajar
        Route::get('/matkul', [\App\Http\Controllers\DosenMatkulController::class, 'dosenIndex'])->name('matkul.index');
        
        // Upload RPS
        Route::get('/matkul/{matkul}/rps', [\App\Http\Controllers\DosenRpsController::class, 'create'])->name('rps.create');
        Route::post('/matkul/{matkul}/rps', [\App\Http\Controllers\DosenRpsController::class, 'store'])->name('rps.store');
        Route::get('/rps/{rps}/download', [\App\Http\Controllers\DosenRpsController::class, 'download'])->name('rps.download');
        
        // Input nilai
        Route::get('/matkul/{matkul}/nilai', [\App\Http\Controllers\DosenNilaiController::class, 'index'])->name('nilai.index');
        Route::post('/matkul/{matkul}/nilai', [\App\Http\Controllers\DosenNilaiController::class, 'store'])->name('nilai.store');
    });

    // Route group untuk Mahasiswa
    Route::middleware(['mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\MahasiswaDashboardController::class, 'index'])->name('dashboard');

        // KRS
        Route::get('/krs', [\App\Http\Controllers\MahasiswaKrsController::class, 'index'])->name('krs.index'); // daftar matkul untuk dipilih
        Route::post('/krs', [\App\Http\Controllers\MahasiswaKrsController::class, 'store'])->name('krs.store'); // ambil matkul

        // Lihat matkul yang sudah diambil
        Route::get('/krs/list', [\App\Http\Controllers\MahasiswaKrsController::class, 'list'])->name('krs.list');

        // Lihat RPS
        Route::get('/rps', [\App\Http\Controllers\MahasiswaRpsController::class, 'index'])->name('rps.index');

        // Lihat nilai (KHS)
        Route::get('/khs', [\App\Http\Controllers\MahasiswaKhsController::class, 'index'])->name('khs.index');
    });
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
