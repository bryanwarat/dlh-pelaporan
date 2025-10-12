@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('meta_description', 'Halaman dashboard aplikasi admin')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Kategori Pelaporan</h4>
        </div>
    </div>

    <!-- Start Main Widgets -->
    <div class="row">
        <div class="card">

            <div class="card-header">
                <h5 class="card-title mb-0">Tambah Kategori</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <form method="POST" action="{{ route('admin.complaint.category.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputKategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" name="category" id="inputKategori"
                            placeholder="Kategori">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>


@endsection
