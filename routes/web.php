<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;

use App\Models\Kategori;

Route::get('/', function () {
    $search = request('search');
    $kategoris = Kategori::when($search, function ($query) use ($search) {
        return $query->where('nama', 'LIKE', '%' . $search . '%');
    })->get();
    return view('home', compact('kategoris'));
});

Route::get('/about', function () {
    return view('about');
});

// Route CRUD kategori
Route::resource('kategori', KategoriController::class);

