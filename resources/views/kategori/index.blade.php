@extends('layout')

@section('content')
    <h1>Daftar Kategori</h1>
    <a href="{{ route('kategori.create') }}">Tambah Kategori</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Deskripsi</th>
            <th>Media</th>
            <th>Aksi</th>
        </tr>
        @foreach ($kategoris as $i => $kategori)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $kategori->nama }}</td>
            <td>{{ $kategori->deskripsi }}</td>
            <td>
                @if($kategori->media)
                    @if(strpos($kategori->media, '.mp4') !== false || strpos($kategori->media, '.mov') !== false || strpos($kategori->media, '.avi') !== false)
                        <video width="100" height="75" controls>
                            <source src="{{ asset('storage/' . $kategori->media) }}" type="video/mp4">
                            Video
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $kategori->media) }}" alt="gambar" width="100">
                    @endif
                @else
                    Tidak ada media
                @endif
            </td>
            <td>
                <a href="{{ route('kategori.edit', $kategori->id) }}">Edit</a> |
                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
@endsection
