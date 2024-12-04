<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;

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
        });
    
        Route::get('/inventori', function () {
            return view('pengurus.inventori-main');
        });
    
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
        });
    });

    // ---------------------------------- Route for "Pemohon" ----------------------------------
    Route::middleware(['handle:pemohon'])->prefix('pemohon')->group(function () {
        Route::get('/dashboard', function () {
            return view('pemohon.dashboard');
        });
    
        Route::get('/inventori', function () {
            return view('pemohon.inventori-main');
        });
    
        Route::get('/inventori/borang-permohonan', function () {
            return view('pemohon.inventori-borang-permohonan');
        });
    
        Route::get('/inventori/lihat-permohonan', function () {
            return view('pemohon.inventori-lihat-permohonan');
        });
    
        Route::get('/inventori/lihat-inventori', [InventoryController::class, 'index'])
            ->name('pemohon.inventori.lihat');
    });
});