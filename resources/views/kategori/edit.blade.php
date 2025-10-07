@extends('layout')

@section('content')
    {{-- ALERT SECTION --}}
    @if (session('success'))
        <div style="max-width: 600px; margin: 20px auto; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; text-align: center;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="max-width: 600px; margin: 20px auto; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; border-radius: 5px; text-align: center;">
            {{ session('error') }}
        </div>
    @endif

    {{-- FORM EDIT --}}
    <div style="max-width: 600px; margin: 30px auto; background: #f9f9f9; padding: 25px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); color: black;">
        <h1 style="text-align: center; color: #333;">Edit Kategori</h1>
        <hr style="margin: 15px 0;">

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Nama</label><br>
                <input type="text" name="nama" value="{{ $kategori->nama }}" required
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Deskripsi</label><br>
                <textarea name="deskripsi" rows="3"
                    style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">{{ $kategori->deskripsi }}</textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-weight: bold;">Media (Gambar/Video)</label><br>
                <input type="file" name="media" accept="image/*,video/*" style="margin-top: 5px;">
            </div>

            @if($kategori->media)
                <div style="margin-top: 20px; text-align: center;">
                    @php
                        $ext = strtolower(pathinfo($kategori->media, PATHINFO_EXTENSION));
                    @endphp

                    @if(in_array($ext, ['mp4', 'mov', 'avi']))
                        <video width="320" height="240" controls style="border-radius: 10px;">
                            <source src="{{ asset('storage/' . $kategori->media) }}" type="video/{{ $ext }}">
                            Browser kamu tidak mendukung video.
                        </video>
                    @else
                        <img src="{{ asset('storage/' . $kategori->media) }}" alt="Media" width="250"
                            style="border-radius: 10px; border: 1px solid #ccc;">
                    @endif
                </div>
            @endif

            <div style="margin-top: 25px; text-align: center;">
                <button type="submit"
                    style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Update
                </button>

                <button type="button" onclick="window.location='{{ route('kategori.index') }}'"
                    style="padding: 10px 20px; background: red; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
                    Kembali
                </button>
            </div>
        </form>
    </div>
@endsection
