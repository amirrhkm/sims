<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

// Route::get('/', function () {
//     return view('login')->name('login');
// });

// ---------------------------------- Route for "Pengurus" ----------------------------------
Route::get('/pengurus/dashboard', function () {
    return view('pengurus.dashboard');
});

Route::get('/pengurus/inventori', function () {
    return view('pengurus.inventori-main');
});

Route::get('/pengurus/inventori/kemaskini-inventori',
    [InventoryController::class, 'kemaskini'])
    ->name('pengurus.inventori-kemaskini');

Route::get('/pengurus/inventori/kemaskini-inventori/item/add', 
    [InventoryController::class, 'create'])
    ->name('pengurus.inventori-kemaskini-item-add');

Route::post('/pengurus/inventori/kemaskini-inventori/item/add',
    [InventoryController::class, 'store'])
    ->name('pengurus.inventori-kemaskini-item-add');

Route::get('/pengurus/inventori/kemaskini-inventori/item/edit/{id}',
    [InventoryController::class, 'edit'])
    ->name('pengurus.inventori-kemaskini-item-edit');

Route::put('/pengurus/inventori/kemaskini-inventori/item/edit/{id}',
    [InventoryController::class, 'update'])
    ->name('pengurus.inventori-kemaskini-item-edit');

Route::delete('/pengurus/inventori/kemaskini-inventori/item/hapus/{id}',
    [InventoryController::class, 'destroy'])
    ->name('pengurus.inventori-kemaskini-item-hapus');

Route::get('/pengurus/inventori/semak-permohonan', function () {
    return view('pengurus.inventori-semak-permohonan');
});

// ---------------------------------- Route for "Pemohon" ----------------------------------
Route::get('/pemohon/dashboard', function () {
    return view('pemohon.dashboard');
});

Route::get('/pemohon/inventori', function () {
    return view('pemohon.inventori-main');
});

Route::get('/pemohon/inventori/borang-permohonan', function () {
    return view('pemohon.inventori-borang-permohonan');
});

Route::get('/pemohon/inventori/lihat-permohonan', function () {
    return view('pemohon.inventori-lihat-permohonan');
});

Route::get('/pemohon/inventori/lihat-inventori', [InventoryController::class, 'index'])
    ->name('pemohon.inventori.lihat');
