<?php

use App\Http\Controllers\KategoriController;

Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

// Route CRUD kategori
Route::resource('kategori', KategoriController::class);

