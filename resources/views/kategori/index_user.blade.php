@extends('layout')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-white">📂 Daftar Kategori</h2>
    </div>

    {{-- Filter dropdown --}}
    <div class="mb-4">
        <select id="categoryFilter" class="form-select shadow-sm">
            <option value="">🔍 Semua Kategori</option>
            @foreach($allCategories as $cat)
                <option value="{{ strtolower($cat) }}">{{ $cat }}</option>
            @endforeach
        </select>
    </div>

    {{-- Loop per kategori --}}
    @foreach($allCategories as $cat)
        @php
            $catLower = strtolower($cat);
            $items = $kategoris->where('kategori', $cat);
        @endphp

        <div class="category-section mb-5" data-category="{{ $catLower }}">
            <h4 class="text-warning mb-3">{{ $cat }}</h4>

            <div class="row g-4">
                @forelse($items as $kategori)
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 kategori-item">
                        <div class="card bg-dark text-white shadow-sm border-0 h-100 overflow-hidden">
                            {{-- Thumbnail --}}
                            @if ($kategori->thumbnail)
                                <img src="{{ asset('storage/' . $kategori->thumbnail) }}"
                                    class="card-img-top" style="height: 200px; object-fit: cover; object-position: center;"
                                    alt="{{ $kategori->nama }}">
                            @else
                                <div class="bg-secondary d-flex align-items-center justify-content-center" style="height:200px;">
                                    <span class="text-white fst-italic">Tidak ada thumbnail</span>
                                </div>
                            @endif

                            <div class="card-body p-2">
                                <h6 class="card-title fw-semibold text-truncate mb-1">{{ $kategori->nama }}</h6>
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
                    <div class="col-12 text-center text-muted py-3">
                        <i>Tidak ada film di kategori ini.</i>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach
</div>

{{-- Filter script --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterSelect = document.getElementById("categoryFilter");
    const categorySections = document.querySelectorAll(".category-section");

    filterSelect.addEventListener("change", function() {
        const query = this.value.toLowerCase();

        categorySections.forEach(section => {
            const sectionCategory = section.dataset.category;
            if(query === '' || sectionCategory === query) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
    });
});
</script>

<style>
.card:hover { transform: scale(1.05); }
</style>
@endsection
