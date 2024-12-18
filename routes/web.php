<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

// Public routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ---------------------------------- Route for "Pengurus" ----------------------------------
    Route::middleware(['handle:pengurus'])->prefix('pengurus')->group(function () {
        Route::get('/dashboard', function () {
            return view('pengurus.dashboard');
        })->name('pengurus.dashboard');
    
        Route::get('/inventori', function () {
            return view('pengurus.inventori-main');
        })->name('pengurus.inventori');
        
        Route::get('/inventori/kemaskini-inventori',
            [InventoryController::class, 'kemaskini'])
            ->name('pengurus.inventori-kemaskini');
    
        Route::get('/inventori/kemaskini-inventori/item/add', 
            [InventoryController::class, 'create'])
            ->name('pengurus.inventori-kemaskini-item-add');
    
        Route::post('/inventori/kemaskini-inventori/item/add',
            [InventoryController::class, 'store'])
            ->name('pengurus.inventori-kemaskini-item-add');
    
        Route::get('/inventori/kemaskini-inventori/item/edit/{id}',
            [InventoryController::class, 'edit'])
            ->name('pengurus.inventori-kemaskini-item-edit');
    
        Route::put('/inventori/kemaskini-inventori/item/edit/{id}',
            [InventoryController::class, 'update'])
            ->name('pengurus.inventori-kemaskini-item-edit');
    
        Route::delete('/inventori/kemaskini-inventori/item/hapus/{id}',
            [InventoryController::class, 'destroy'])
            ->name('pengurus.inventori-kemaskini-item-hapus');
    
        Route::get('/inventori/semak-permohonan', function () {
            return view('pengurus.inventori-semak-permohonan');
        })->name('pengurus.inventori-semak-permohonan');

        Route::get('/pengguna',
            [AccountController::class, 'index'])
            ->name('pengurus.pengguna');

        Route::get('/pengguna/tambah-pengguna',
            [AccountController::class, 'create'])
            ->name('pengurus.pengguna-add');

        Route::post('/pengguna/tambah-pengguna',
            [AccountController::class, 'store'])
            ->name('pengurus.pengguna-add');

        Route::get('/pengguna/edit/{id}',
            [AccountController::class, 'edit'])
            ->name('pengurus.pengguna-edit');

        Route::put('/pengguna/edit/{id}',
            [AccountController::class, 'update'])
            ->name('pengurus.pengguna-edit');

        Route::delete('/pengguna/hapus/{id}',
            [AccountController::class, 'destroy'])
            ->name('pengurus.pengguna-hapus');

        Route::get('/pengguna/show/{id}',
            [AccountController::class, 'show'])
            ->name('pengurus.pengguna-show');

        Route::get('/pengurus/inventori/permohonan',
            [InventoryController::class, 'reviewRequest'])
            ->name('pengurus.inventori.permohonan.index');

        Route::get('/pengurus/inventori/permohonan/{id}',
            [InventoryController::class, 'showRequest'])
            ->name('pengurus.inventori.permohonan.show');

        Route::put('/pengurus/inventori/permohonan/{id}',
            [InventoryController::class, 'updateRequest'])
            ->name('pengurus.inventori.permohonan.update');

        Route::get('/pengurus/inventori/permohonan/returned/{id}',
            [InventoryController::class, 'returnedRequest'])
            ->name('pengurus.inventori.permohonan.returned');
    });

    // ---------------------------------- Route for "Pemohon" ----------------------------------
    Route::middleware(['handle:pemohon'])->prefix('pemohon')->group(function () {
        Route::get('/dashboard', function () {
            return view('pemohon.dashboard');
        })->name('pemohon.dashboard');
    
        Route::get('/inventori', function () {
            return view('pemohon.inventori-main');
        })->name('pemohon.inventori');
    
        Route::get('/inventori/borang-permohonan',
            [InventoryController::class, 'showBorrowingRequestForm'])
            ->name('pemohon.inventori-borang-permohonan');
    
        Route::post('/inventori/borang-permohonan',
            [InventoryController::class, 'simpanPermohonan'])
            ->name('pemohon.inventori-borang-permohonan');
    
        Route::get('/inventori/lihat-permohonan',
            [InventoryController::class, 'lihatPermohonan'])
            ->name('pemohon.inventori-lihat-permohonan');

        Route::delete('/inventori/hapus-permohonan/{id}', 
            [InventoryController::class, 'hapusPermohonan'])
            ->name('pemohon.inventori-hapus-permohonan');
    
        Route::get('/inventori/lihat-inventori', [InventoryController::class, 'index'])
            ->name('pemohon.inventori.lihat');

        Route::get('/pengguna/show/{id}',
            [AccountController::class, 'show'])
            ->name('pemohon.pengguna-show');
    });
});
