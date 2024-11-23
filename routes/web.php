<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome')->name('welcome');
});

// Inventori route for "Pengurus"
Route::get('/pengurus/inventori', function () {
    return view('pengurus.inventori');
});

// Route for "Pemohon"
Route::get('/pemohon/dashboard', function () {
    return view('pemohon.dashboard');
});

Route::get('/pemohon/inventori', function () {
    return view('pemohon.inventori');
});

Route::get('/pemohon/inventori/borang-permohonan', function () {
    return view('pemohon.borang-permohonan');
});

Route::get('/pemohon/inventori/lihat-permohonan', function () {
    return view('pemohon.lihat-permohonan');
});

Route::get('/pemohon/inventori/lihat-inventori', function () {
    return view('pemohon.lihat-inventori');
});
