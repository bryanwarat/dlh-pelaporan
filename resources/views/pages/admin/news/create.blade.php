@extends('layouts.admin.app')

@section('title', 'Tambah Informasi')

@section('content')
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-3">Tambah Informasi</h4>

        <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
            </div>


            <input hidden type="text" name="slug" id="slug" class="form-control" value="{{ old('slug') }}">

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Draft</option>
                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Publish</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="thumbnail" class="form-label">Thumbnail</label>
                <input type="file" name="thumbnail" id="thumbnail" class="form-control">
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Isi Informasi</label>
                <textarea name="content" id="editor">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <style>
        .ck-editor__editable_inline {
            min-height: 500px;
        }
    </style>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });

        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const slugInput = document.getElementById('slug');

            if (titleInput && slugInput) {
                function slugify(text) {
                    return text.toString().toLowerCase() // Mengubah ke huruf kecil semua
                        .trim()
                        .replace(/\s+/g, '-')
                        .replace(/[^\w\-]+/g, '')
                        .replace(/\-\-+/g, '-')
                        .substring(0, 250);
                }

                titleInput.addEventListener('keyup', function() {
                    if (!slugInput.dataset.manualEdit) {
                        slugInput.value = slugify(titleInput.value);
                    }
                });

                slugInput.addEventListener('change', function() {
                    slugInput.dataset.manualEdit = 'true';
                });
            }
        });
    </script>
@endpush
