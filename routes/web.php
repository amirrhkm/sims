<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::get('/', function () {
    return view('welcome')->name('welcome');
});

// ---------------------------------- Route for "Pengurus" ----------------------------------
Route::get('/pengurus/inventori', function () {
    return view('pengurus.inventori');
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
