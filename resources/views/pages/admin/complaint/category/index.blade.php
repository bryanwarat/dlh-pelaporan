@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('meta_description', 'Halaman dashboard aplikasi admin')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Kategori Pengaduan</h4>
        </div>
        <div class="text-end">
            <a href="{{ route('admin.complaint.category.create') }}" class="btn btn-primary">Tambah</a>

        </div>
    </div>

    <!-- Start Main Widgets -->
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Basic Example</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $category->category }}</td>
                                    <td><a href="" class="btn btn-warning">Edit</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
