@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">📂 Daftar Kategori</h1>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    <div class="mb-3">
        <form method="GET" action="{{ route('kategori.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <div class="card shadow-sm bg-white">
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Media</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategoris as $i => $kategori)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        <td>{{ $kategori->nama }}</td>
                        <td>{{ $kategori->deskripsi }}</td>
                        <td class="text-center">
                            @if($kategori->media)
                                @if(Str::endsWith($kategori->media, ['.mp4', '.mov', '.avi']))
                                    <video width="120" height="80" controls class="rounded">
                                        <source src="{{ asset('storage/' . $kategori->media) }}" type="video/mp4">
                                        Video tidak bisa diputar
                                    </video>
                                @else
                                    <img src="{{ asset('storage/' . $kategori->media) }}" alt="gambar" width="120" class="rounded shadow-sm">
                                @endif
                            @else
                                <span class="text-muted">Tidak ada media</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">✏ Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin mau hapus?')" class="btn btn-sm btn-danger">🗑 Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada kategori</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
