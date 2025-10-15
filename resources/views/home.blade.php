@extends('layout')

@section('content')
<div class="container py-4">
    <!-- Header Section -->
    <div class="text-center mb-5 fade-in">
        <h1 class="fw-bold text-warning mb-3">MoVision</h1>
        <p class="text-light opacity-75">Temukan film favoritmu dengan pengalaman yang elegan</p>
    </div>

    <!-- Search Section -->
    <div class="row justify-content-center mb-5">
        <div class="col-lg-6">
            <form method="GET" action="{{ route('home') }}" class="search-form">
                <div class="input-group">
                    <input type="text" name="search" 
                           class="form-control search-input border-0"
                           placeholder="Cari film atau kategori..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-warning search-btn">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Movies Grid -->
    <div class="mb-4">
        <h2 class="section-title text-center mb-4">Koleksi Film</h2>
        
        @if($kategoris->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-film text-muted mb-3" style="font-size: 3rem;"></i>
                <p class="text-muted">Belum ada film tersedia</p>
            </div>
        @else
            <div class="row g-4">
                @foreach($kategoris as $kategori)
                <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                    <a href="{{ route('kategori.show', $kategori->id) }}" class="movie-card">
                        <div class="card border-0 bg-transparent">
                            <!-- Movie Poster -->
                            <div class="poster-container">
                                @if($kategori->thumbnail)
                                    <img src="{{ asset('storage/' . $kategori->thumbnail) }}"
                                         alt="{{ $kategori->nama }}"
                                         class="poster-image">
                                @else
                                    <div class="poster-placeholder">
                                        <i class="fas fa-film text-light opacity-50"></i>
                                    </div>
                                @endif
                                
                                <!-- Overlay on hover -->
                                <div class="poster-overlay">
                                    <div class="overlay-content">
                                        <i class="fas fa-play-circle mb-2"></i>
                                        <small>Lihat Detail</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Movie Info -->
                            <div class="card-body px-0 pt-2">
                                <h6 class="movie-title text-light mb-1">{{ $kategori->nama }}</h6>
                                
                                @if($kategori->kategori)
                                    <div class="category-badge">
                                        {{ $kategori->kategori }}
                                    </div>
                                @endif

                                @if($kategori->deskripsi)
                                    <p class="movie-desc text-light opacity-75 mt-1 mb-0">
                                        {{ Str::limit($kategori->deskripsi, 50, '...') }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<style>
    /* Animations */
    .fade-in {
        animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Search Form */
    .search-form {
        position: relative;
    }

    .search-input {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: white;
        padding: 12px 20px;
        border-radius: 25px 0 0 25px !important;
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .search-input:focus {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.3);
        border-color: transparent;
    }

    .search-btn {
        border-radius: 0 25px 25px 0;
        padding: 12px 20px;
        border: none;
        font-weight: 500;
        min-width: 80px;
        transition: all 0.3s ease;
    }

    .search-btn:hover {
        background: #ffca2c;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
    }

    /* Section Title */
    .section-title {
        color: #ffd700;
        font-weight: 300;
        letter-spacing: 1px;
        position: relative;
        display: inline-block;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 2px;
        background: #ffd700;
    }

    /* Movie Card */
    .movie-card {
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
    }

    .movie-card:hover {
        transform: translateY(-8px);
    }

    /* Poster Container */
    .poster-container {
        position: relative;
        width: 100%;
        aspect-ratio: 2/3;
        border-radius: 12px;
        overflow: hidden;
        background: #1a1a1a;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .poster-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .poster-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }

    /* Poster Overlay */
    .poster-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 215, 0, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .overlay-content {
        text-align: center;
        color: #000;
    }

    .overlay-content i {
        font-size: 2rem;
    }

    .overlay-content small {
        font-weight: 500;
    }

    .poster-container:hover .poster-overlay {
        opacity: 1;
    }

    .poster-container:hover .poster-image {
        transform: scale(1.05);
    }

    /* Movie Info */
    .movie-title {
        font-weight: 500;
        font-size: 0.9rem;
        line-height: 1.3;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .category-badge {
        display: inline-block;
        background: rgba(255, 215, 0, 0.1);
        color: #ffd700;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.7rem;
        border: 1px solid rgba(255, 215, 0, 0.3);
    }

    .movie-desc {
        font-size: 0.75rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }
        
        .col-6 {
            padding: 0 6px;
        }

        .search-btn {
            min-width: 70px;
            padding: 12px 15px;
        }
    }
</style>
@endsection