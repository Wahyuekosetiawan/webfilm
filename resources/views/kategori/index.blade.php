@extends('layout')

@section('content')
    <div class="container py-4">
        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-white">📂 Daftar Kategori</h2>
            @if (auth()->user() && auth()->user()->isAdmin())
                <a href="{{ route('kategori.create') }}" class="btn btn-warning text-dark fw-semibold shadow-sm">
                    + Tambah Kategori
                </a>
            @endif
        </div>

        {{-- Pencarian --}}
        <form method="GET" action="{{ route('kategori.index') }}" class="d-flex mb-4">
            <input type="text" name="search" class="form-control me-2 shadow-sm" placeholder="🔍 Cari kategori..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-warning fw-semibold text-dark shadow-sm">Cari</button>
        </form>

        {{-- Card utama --}}
        <div class="card border-0 shadow-lg rounded-4 bg-light">
            <div class="card-body">
                <table class="table table-hover align-middle text-center">
                    <thead class="bg-warning text-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Film</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Video</th>
                            <th>Thumbnail</th>
                            @if (auth()->user() && auth()->user()->isAdmin())
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategoris as $i => $kategori)
                            <tr class="align-middle">
                                <td>{{ $kategoris->firstItem() + $i }}</td>
                                <td class="fw-semibold">{{ $kategori->nama }}</td>
                                <td>{{ $kategori->kategori ?? '-' }}</td>
                                <td>{{ $kategori->deskripsi ?? '-' }}</td>
                                {{-- Kolom Video --}}
                                <td>
                                    @if ($kategori->video && Str::endsWith($kategori->video, ['.mp4', '.mov', '.avi']))
                                        <video width="150" height="90" controls class="rounded shadow-sm">
                                            <source src="{{ asset('storage/' . $kategori->video) }}" type="video/mp4">
                                            Video tidak bisa diputar
                                        </video>
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada video</span>
                                    @endif
                                </td>

                                {{-- Kolom Thumbnail --}}
                                <td>
                                    @if ($kategori->thumbnail && Str::endsWith($kategori->thumbnail, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                        <img src="{{ asset(
                                            Str::startsWith($kategori->thumbnail, 'thumbnails/')
                                                ? 'storage/' . $kategori->thumbnail
                                                : 'storage/thumbnails/' . $kategori->thumbnail,
                                        ) }}"
                                            alt="gambar" class="rounded-3 shadow-sm border"
                                            style="width: 120px; height: 80px; object-fit: cover; object-position: center;">
                                    @else
                                        <span class="text-muted fst-italic">Tidak ada thumbnail</span>
                                    @endif
                                </td>

                                @if (auth()->user() && auth()->user()->isAdmin())
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                                                class="btn btn-sm btn-outline-warning fw-semibold">✏ Edit</a>
                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin mau hapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger fw-semibold">🗑
                                                    Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="@if (auth()->user() && auth()->user()->isAdmin()) 5 @else 4 @endif"
                                    class="text-center text-muted py-4">
                                    <i>Tidak ada kategori ditemukan.</i>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center mt-3">
                    {{ $kategoris->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- ALERT (versi modern dengan SweetAlert bawaan JS biasa) --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#facc15', // kuning
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#facc15',
            });
        </script>
    @endif

    {{-- Tambahkan CDN SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
