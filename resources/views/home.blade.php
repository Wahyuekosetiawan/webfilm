@extends('layout')

@section('content')
<div class="text-center mb-5 fade-in">
    <h1 class="fw-bold text-warning">Selamat Datang di MoVision</h1>
    <p class="text-light">Temukan film favoritmu dan nikmati pengalaman menonton terbaik.</p>
</div>

<!-- 🔍 Form Pencarian -->
<div class="mb-4">
    <form method="GET" action="{{ route('home') }}" class="d-flex justify-content-center">
        <input type="text" name="search" class="form-control w-50 me-2 shadow-sm"
            placeholder="Cari film atau kategori..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-warning text-dark fw-semibold shadow-sm">Cari</button>
    </form>
</div>

<h2 class="mt-4 mb-3 text-center text-warning">Daftar Film</h2>

@if($kategoris->isEmpty())
    <p class="text-center text-muted">Belum ada film tersedia.</p>
@else
    <div class="row row-cols-2 row-cols-md-5 g-3 fade-in"> <!-- 🔹 Lebih kecil dan rapat -->
        @foreach($kategoris as $kategori)
        <div class="col">
            <a href="{{ route('kategori.show', $kategori->id) }}" class="text-decoration-none">
                <div class="card h-100 shadow-sm border-0 bg-dark text-light rounded-4 overflow-hidden card-hover">
                    <div class="media-container position-relative">
                        @if($kategori->thumbnail)
                            <img src="{{ asset('storage/' . $kategori->thumbnail) }}"
                                 alt="{{ $kategori->nama }}"
                                 class="media-content">
                        @else
                            <div class="d-flex align-items-center justify-content-center media-placeholder">
                                <span class="text-muted small">Tidak ada thumbnail</span>
                            </div>
                        @endif
                    </div>

                    <div class="card-body text-center p-2"> <!-- 🔹 Padding lebih kecil -->
                        <h6 class="card-title fw-bold text-warning mb-1">{{ $kategori->nama }}</h6>

                        @if($kategori->kategori)
                            <span class="badge bg-warning text-dark mb-2 px-2 py-1 rounded-pill small">
                                🎬 {{ $kategori->kategori }}
                            </span>
                        @endif

                        <p class="card-text small text-light opacity-75 mb-0">
                            {{ Str::limit($kategori->deskripsi, 60, '...') }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endif

<style>
    .media-container {
        position: relative;
        width: 100%;
        aspect-ratio: 3 / 4; /* 🔹 Lebih kecil vertikal */
        overflow: hidden;
        background: #222;
    }

    .media-content {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease, filter 0.4s ease;
    }

    .media-placeholder {
        width: 100%;
        height: 100%;
        background: #333;
        font-size: 0.8rem;
        color: #aaa;
    }

    .card-hover:hover .media-content {
        transform: scale(1.06);
        filter: brightness(1.1);
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        font-size: 0.85rem; /* 🔹 Teks sedikit lebih kecil */
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.25);
    }

    a {
        color: inherit;
    }

    a:hover {
        color: inherit;
    }

    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
