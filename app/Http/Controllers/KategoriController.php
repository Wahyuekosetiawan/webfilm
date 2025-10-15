<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    public function index()
    {
        $search = request('search');

        // Query kategori dengan search
        $kategoris = Kategori::when($search, function ($query, $search) {
            $query->where('kategori', 'LIKE', "%{$search}%")
                ->orWhere('nama', 'LIKE', "%{$search}%");
        })->paginate(10);

        // Ambil semua kategori unik untuk filter dropdown
        $allCategories = Kategori::pluck('kategori')->unique()->sort()->toArray();

        // Pilih view berdasarkan role user
        if (Auth::user()->role === 'admin') {
            return view('kategori.index_admin', compact('kategoris'));
        }

        return view('kategori.index_user', compact('kategoris', 'allCategories'));
    }
    public function create()
    {
        $kategoris = Kategori::all();
        return view('kategori.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:adventure,horror,comedy,drama,action,romance',
            'deskripsi' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'video' => 'nullable|mimetypes:video/mp4,video/avi,video/mov|max:204800', // max 200MB
        ]);

        $thumbnailPath = null;
        $videoPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
        }

        \App\Models\Kategori::create([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'thumbnail' => $thumbnailPath,
            'video' => $videoPath,
        ]);

        return redirect('/')->with('success', 'Data kategori berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|in:adventure,horror,comedy,drama,action,romance',
            'deskripsi' => 'nullable|string',
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:20480',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        // update data
        $kategori->update([
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
    }


    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    public function home(Request $request)
    {
        $search = $request->input('search');

        $kategoris = Kategori::when($search, function ($query, $search) {
            $query->where('kategori', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        })->get();

        return view('home', compact('kategoris'));
    }

    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.show', compact('kategori'));
    }
}
