@extends('layouts.admin.app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="card mt-3">
        <div class="card-header">Edit Kategori</div>
        <div class="card-body">
            <form action="{{ route('admin.complaint.category.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="category" value="{{ $category->category }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.complaint.category.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection
