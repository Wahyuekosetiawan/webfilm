@extends('layout')

@section('content')
<div class="text-center fade-in">
    <h2 class="fw-bold text-warning mb-4">{{ $kategori->nama }}</h2>

    @php
        // Ambil nama file media (bisa video atau thumbnail)
        $videoPath = $kategori->video ? asset('storage/' . $kategori->video) : null;
        $thumbPath = $kategori->thumbnail ? asset('storage/' . $kategori->thumbnail) : null;
    @endphp

    @if($kategori->video && Str::endsWith($kategori->video, ['.mp4', '.mov', '.avi']))
        <video width="70%" controls controlsList="nodownload" class="rounded shadow-lg mt-3" preload="metadata">
            <source src="{{ $videoPath }}" type="video/mp4">
            Browser kamu tidak mendukung pemutaran video.
        </video>
    @elseif($kategori->thumbnail)
        <img src="{{ $thumbPath }}" alt="{{ $kategori->nama }}" class="rounded shadow mt-3" width="60%">
    @else
        <div class="mt-4 text-muted fst-italic">Tidak ada media tersedia</div>
    @endif

    <div class="mt-4">
        <a href="{{ route('home') }}" class="btn btn-warning text-dark fw-semibold px-4">⬅ Kembali</a>
    </div>
</div>

<style>
.fade-in {
    animation: fadeIn 0.8s ease-in-out;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection
