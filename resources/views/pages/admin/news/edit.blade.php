@extends('layouts.admin.app')

@section('title', 'Edit Berita')
@section('content')
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-3">Edit Berita</h4>

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control"
                    value="{{ old('title', $news->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control"
                    value="{{ old('slug', $news->slug) }}">
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="1" {{ old('status', $news->status) == 1 ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('status', $news->status) == 0 ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                @if ($news->thumbnail)
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" class="mt-2" height="100">
                @endif
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" id="editor">{{ old('content', $news->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable_inline {
            min-height: 500px;
            /* Menambah tinggi minimum editor */
        }
    </style>

    <script>
        // 1. INISIALISASI CKEDITOR
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        // 2. LOGIKA OTOMATIS SLUG (JavaScript)
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');
            const originalSlug = '{{ $news->slug }}';

            if (titleInput && slugInput) {
                function slugify(text) {
                    return text.toString().toLowerCase()
                        .trim()
                        .replace(/\s+/g, '-')
                        .replace(/[^\w\-]+/g, '')
                        .replace(/\-\-+/g, '-')
                        .substring(0, 250);
                }

                // Gunakan event input untuk respons lebih cepat
                titleInput.addEventListener('input', function() {
                    // Hanya otomatisasi jika kolom slug masih kosong
                    if (slugInput.value === '') {
                        slugInput.value = slugify(titleInput.value);
                    }
                });

                // Perbarui slug jika judul berubah dan slug belum dimodifikasi manual
                titleInput.addEventListener('keyup', function() {
                    if (slugInput.value === '') {
                        slugInput.value = slugify(titleInput.value);
                    }
                });

                // Jika user mengedit slug secara manual, setel flag
                slugInput.addEventListener('input', function() {
                    if (slugInput.value !== originalSlug) {
                        slugInput.dataset.manualEdit = 'true';
                    } else {
                        slugInput.dataset.manualEdit = '';
                    }
                });

                // Jika input slug kosong, kembalikan ke slug otomatis saat judul diubah
                slugInput.addEventListener('blur', function() {
                    if (this.value === '') {
                        this.removeAttribute('data-manual-edit');
                        this.value = slugify(titleInput.value);
                    }
                });
            }
        });
    </script>
@endpush
