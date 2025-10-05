@extends('layout')

@section('content')
    <h1>Selamat Datang di Website Film</h1>
    <p>Ini adalah halaman utama.</p>

    <div class="mb-4">
        <form method="GET" action="/" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari kategori..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <h2 class="mt-4 mb-3">Kategori Film</h2>
    @if($kategoris->isEmpty())
        <p class="text-muted">Belum ada kategori tersedia.</p>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($kategoris as $kategori)
                <div class="col">
                    <div class="card h-100 shadow-sm bg-white border border-gray-200">
                        @if($kategori->media)
                            @if(Str::endsWith($kategori->media, ['.mp4', '.mov', '.avi']))
                                <video class="card-img-top" controls>
                                    <source src="{{ asset('storage/' . $kategori->media) }}" type="video/mp4">
                                    Video tidak bisa diputar
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $kategori->media) }}" class="card-img-top" alt="{{ $kategori->nama }}">
                            @endif
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $kategori->nama }}</h5>
                            <p class="card-text">{{ $kategori->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
