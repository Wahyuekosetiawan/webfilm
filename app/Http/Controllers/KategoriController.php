<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $search = request('search');
        $kategoris = Kategori::when($search, function ($query) use ($search) {
            return $query->where('kategori', 'LIKE', '%' . $search . '%');
        })->paginate(10);
        return view('kategori.index', compact('kategoris'));
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
        'kategori' => 'required|string|max:100',
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
        'nama' => 'required',
        'deskripsi' => 'nullable',
        'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480' // max 20MB
    ]);

    $data = $request->only(['nama', 'deskripsi']);

    if ($request->hasFile('media')) {
        $file = $request->file('media');
        $filename = time() . '_' . $file->getClientOriginalName();

        // simpan di storage/app/public/media
        $path = $file->storeAs('media', $filename, 'public');

        // simpan path relatif ke database
        $data['media'] = $path; // hasil: media/namafile.jpg
    }

    $kategori->update($data);

    return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui!');
}

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success','Kategori berhasil dihapus!');
    }

    public function home(Request $request)
{
    $search = $request->input('search');

    $kategoris = Kategori::when($search, function($query, $search) {
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

