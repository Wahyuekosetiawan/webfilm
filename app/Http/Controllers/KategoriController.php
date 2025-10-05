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
            return $query->where('nama', 'LIKE', '%' . $search . '%');
        })->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'nullable',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480' // max 20MB
        ]);

        $data = $request->all();

       if ($request->hasFile('media')) {
    // Simpan file ke storage/app/public/media
    $path = $request->file('media')->store('media', 'public');
    $data['media'] = $path; // hasil: "media/namafile.jpg"
}

        Kategori::create($data);
        return redirect()->route('kategori.index')->with('success','Kategori berhasil ditambahkan!');
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
}

