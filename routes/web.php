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
    // Semua user login bisa lihat daftar dan detail kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');

    // Hanya admin bisa CRUD (create, edit, update, delete)
    Route::middleware('can:isAdmin')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['index', 'show']);
    });
});
