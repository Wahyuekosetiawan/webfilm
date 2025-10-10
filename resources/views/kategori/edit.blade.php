@extends('layout')

@section('content')
<div class="container py-5">
    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success text-center shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger text-center shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    {{-- CARD FORM EDIT --}}
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 650px; margin: 0 auto; background: #fffbea;">
        <div class="card-header text-center bg-warning text-dark fw-bold fs-4 rounded-top-4">
            ✏ Edit Kategori
        </div>
        <div class="card-body px-4 py-4">
            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Film</label>
                    <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}" class="form-control shadow-sm" required>
                </div>

                {{-- Kategori --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori</label>
                    <input type="text" name="kategori" value="{{ old('kategori', $kategori->kategori) }}" class="form-control shadow-sm" required>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control shadow-sm">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>

                {{-- Video --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ganti Video (opsional)</label>
                    <input type="file" name="video" accept="video/*" class="form-control shadow-sm">
                    @if($kategori->video)
                        <div class="text-center mt-3">
                            <video width="260" height="160" controls class="rounded shadow-sm border">
                                <source src="{{ asset('storage/' . $kategori->video) }}" type="video/mp4">
                                Browser tidak mendukung video.
                            </video>
                        </div>
                    @endif
                </div>

                {{-- Thumbnail --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Ganti Thumbnail (opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*" class="form-control shadow-sm">
                    @if($kategori->thumbnail)
                        <div class="text-center mt-3">
                            <img src="{{ asset('storage/' . $kategori->thumbnail) }}" alt="Thumbnail"
                                style="width: 200px; height: 120px; object-fit: cover; border-radius: 10px; border: 1px solid #ccc;"
                                class="shadow-sm">
                        </div>
                    @endif
                </div>

                {{-- Tombol --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-warning text-dark fw-semibold px-4">
                        💾 Update
                    </button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary fw-semibold px-4 ms-2">
                        ⬅ Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
