@extends('layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning text-dark text-center">
                    <h4>Tambah Film Baru</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Judul Film</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="adventure">Adventure</option>
                                <option value="horror">Horror</option>
                                <option value="comedy">Comedy</option>
                                <option value="drama">Drama</option>
                                <option value="action">Action</option>
                                <option value="romance">Romance</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="thumbnail" class="form-label">Thumbnail (Gambar)</label>
                            <input type="file" name="thumbnail" id="thumbnail" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="video" class="form-label">Video</label>
                            <input type="file" name="video" id="video" class="form-control" accept="video/*">
                            <small class="text-muted">Maksimal ukuran: 200 MB</small>
                        </div>

                        <button type="submit" class="btn btn-warning w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
