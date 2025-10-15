@extends('layout')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">📂 Daftar Kategori</h2>
    </div>

    {{-- Filter berdasarkan kategori --}}
    <div class="mb-4">
        <select id="categoryFilter" class="form-select shadow-sm">
            <option value="">🔍 Semua Kategori</option>
            @foreach($allCategories as $cat)
                <option value="{{ strtolower($cat) }}">{{ $cat }}</option>
            @endforeach
        </select>
    </div>

    {{-- Grid ala Netflix --}}
    <div class="row g-4" id="kategoriList">
        @forelse ($kategoris as $kategori)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 kategori-item">
                <div class="card bg-dark text-white shadow-sm border-0 h-100 overflow-hidden"
                    style="cursor:pointer; transition: transform 0.3s;">
                    {{-- Thumbnail --}}
                    @if ($kategori->thumbnail)
                        <img src="{{ asset('storage/' . $kategori->thumbnail) }}"
                            class="card-img-top" style="height: 250px; object-fit: cover; object-position: center;"
                            alt="{{ $kategori->nama }}">
                    @else
                        <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:250px;">
                            <span class="text-white fst-italic">Tidak ada thumbnail</span>
                        </div>
                    @endif

                    <div class="card-body p-2">
                        <h6 class="card-title fw-semibold text-truncate mb-1">{{ $kategori->nama }}</h6>
                        <small class="text-warning kategori-text">{{ $kategori->kategori ?? '-' }}</small>
                        <p class="text-light mt-1 mb-0" style="font-size:0.8rem;">
                            {{ Str::limit($kategori->deskripsi ?? '-', 50, '...') }}
                        </p>
                        @if ($kategori->video)
                            <small class="d-block text-info mt-1">Video tersedia 🎬</small>
                        @endif
                    </div>

                    @auth
                        @if (auth()->user()->isAdmin())
                        <div class="card-footer bg-dark d-flex justify-content-between p-1">
                            <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-outline-warning">✏</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">🗑</button>
                            </form>
                        </div>
                        @endif
                    @endauth
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">
                <i>Tidak ada kategori ditemukan.</i>
            </div>
        @endforelse
    </div>

    {{-- Placeholder live search --}}
    <div id="noResult" class="text-center py-5 d-none">
        <i class="fas fa-search text-muted mb-3" style="font-size: 3rem;"></i>
        <p>Kategori yang kamu pilih tidak ditemukan 😢</p>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $kategoris->links() }}
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterSelect = document.getElementById("categoryFilter");
    const kategoriItems = document.querySelectorAll(".kategori-item");
    const noResult = document.getElementById("noResult");

    filterSelect.addEventListener("change", function() {
        const query = this.value.toLowerCase();
        let anyVisible = false;

        kategoriItems.forEach(item => {
            const categoryBadge = item.querySelector(".kategori-text");
            const categoryText = categoryBadge ? categoryBadge.textContent.toLowerCase() : '';
            const isMatch = query === '' || categoryText === query;

            item.style.display = isMatch ? "block" : "none";
            if (isMatch) anyVisible = true;
        });

        if (anyVisible) {
            noResult.classList.add("d-none");
        } else {
            noResult.classList.remove("d-none");
        }
    });
});
</script>

{{-- Hover effect --}}
<style>
.card:hover { transform: scale(1.05); }
</style>
@endsection
