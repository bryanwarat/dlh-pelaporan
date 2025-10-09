@extends('layouts.admin.app')

@section('title', 'Tambah Berita')
@section('content')
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-3">Tambah Berita</h4>

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
                <small class="text-muted">Jika kosong, slug akan dibuat otomatis.</small>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control">
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control" rows="6">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
