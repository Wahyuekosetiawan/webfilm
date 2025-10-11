<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/')
            ->with('success', 'Login berhasil! Selamat datang 👋');
    }

    return back()->with('error', 'Email atau password salah!');
})->middleware('guest');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login')->with('success', 'Logout berhasil!');
})->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| HOME ROUTE (Daftar kategori + search)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $search = request('search');

    $kategoris = Kategori::when($search, function ($query, $search) {
        $query->where('kategori', 'like', "%{$search}%")
              ->orWhere('nama', 'like', "%{$search}%");
    })->get();

    return view('home', compact('kategoris'));
})->name('home')->middleware('auth');

/*
|--------------------------------------------------------------------------
| ABOUT PAGE
|--------------------------------------------------------------------------
*/
Route::get('/about', function () {
    return view('about');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| KATEGORI ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // 🔹 Semua user bisa melihat daftar & detail kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    // 🔹 Khusus admin: CRUD (create, store, edit, update, destroy)
    Route::middleware('can:isAdmin')->group(function () {
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // 🔹 Route ini harus DITARUH PALING BAWAH biar gak bentrok dengan `/create` & `/edit`
    Route::get('/kategori/{id}', [KategoriController::class, 'show'])
        ->where('id', '[0-9]+') // biar 'create' gak keanggep ID
        ->name('kategori.show');
});
