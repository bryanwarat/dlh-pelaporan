@extends('layouts.admin.app')

@section('title', 'Edit Berita')
@section('content')
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-3">Edit Berita</h4>

        <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $news->title) }}" required>
            </div>

            <div class="mb-3">
                <label>Slug</label>
                <input type="text" name="slug" class="form-control" value="{{ old('slug', $news->slug) }}">
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select">
                    <option value="1" {{ old('status', $news->status) == 1 ? 'selected' : '' }}>Publish</option>
                    <option value="0" {{ old('status', $news->status) == 0 ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control">
                @if ($news->thumbnail)
                    <img src="{{ asset('storage/' . $news->thumbnail) }}" class="mt-2" height="100">
                @endif
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control" rows="6">{{ old('content', $news->content) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
