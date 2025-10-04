@extends('layout')

@section('content')
    <h1>Tambah Kategori</h1>
    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Nama</label>
        <input type="text" name="nama" required>
        <br>
        <label>Deskripsi</label>
        <textarea name="deskripsi"></textarea>
        <br>
        <label>Media (Gambar/Video)</label>
        <input type="file" name="media" accept="image/*,video/*">
        <br>
        <button type="submit">Simpan</button>
    </form>
@endsection
