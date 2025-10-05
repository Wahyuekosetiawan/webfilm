<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->middleware('guest');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
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

// Route CRUD kategori with admin middleware for create, store, edit, update, destroy
Route::middleware('auth')->group(function () {
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::middleware('can:isAdmin')->group(function () {
        Route::resource('kategori', KategoriController::class)->except(['index']);
    });
});

