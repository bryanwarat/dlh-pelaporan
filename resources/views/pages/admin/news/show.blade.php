@extends('layouts.admin.app')

@section('title', 'Detail Berita')
@section('content')
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-3">{{ $news->title }}</h4>

        <div class="mb-3">
            <strong>Status:</strong> {{ $news->status ? 'Publish' : 'Draft' }}
        </div>

        <div class="mb-3">
            <strong>Created By:</strong> {{ $news->creator ? $news->creator->name : '-' }}
        </div>

        @if ($news->thumbnail)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $news->thumbnail) }}" height="150">
            </div>
        @endif

        <div class="mb-3">
            {!! $news->content !!}
        </div>

        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
