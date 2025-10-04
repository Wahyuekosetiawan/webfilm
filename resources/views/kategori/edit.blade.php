@extends('layout')

@section('content')
    <h1>Edit Kategori</h1>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama</label>
        <input type="text" name="nama" value="{{ $kategori->nama }}" required>
        <br>

        <label>Deskripsi</label>
        <textarea name="deskripsi">{{ $kategori->deskripsi }}</textarea>
        <br>

        <label>Media (Gambar/Video)</label>
        <input type="file" name="media" accept="image/*,video/*">
        <br>

        @if($kategori->media)
            <p>Media Saat Ini:</p>

            {{-- Debug: tampilkan path dari database --}}
            <small>Path DB: {{ $kategori->media }}</small><br>
            <small>URL: {{ asset('storage/' . $kategori->media) }}</small><br><br>

            @php
                $ext = strtolower(pathinfo($kategori->media, PATHINFO_EXTENSION));
            @endphp

            @if(in_array($ext, ['mp4', 'mov', 'avi']))
                <video width="320" height="240" controls>
                    <source src="{{ asset('storage/' . $kategori->media) }}" type="video/{{ $ext }}">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ asset('storage/' . $kategori->media) }}" alt="Media" width="200">
            @endif
        @endif

        <br><br>
        <button type="submit">Update</button>
    </form>
@endsection
