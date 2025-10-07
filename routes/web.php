<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    $search = request('search');
    $kategoris = Kategori::when($search, function ($query) use ($search) {
        return $query->where('nama', 'LIKE', '%' . $search . '%');
    })->paginate(10);

    return view('home', compact('kategoris'));
})->middleware('auth');

Route::get('/about', function () {
    return view('about');
})->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::middleware('can:isAdmin')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['index']);
    });
});
