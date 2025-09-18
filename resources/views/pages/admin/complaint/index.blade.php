@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('meta_description', 'Halaman dashboard aplikasi admin')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Pengaduan</h4>
        </div>
        <div class="text-end">
            <a href="{{ route('admin.complaint.category.create') }}" class="btn btn-primary">Tambah</a>

        </div>
    </div>

    <!-- Start Main Widgets -->
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Pengaduan</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Aduan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaints as $complaint)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $complaint->complaint }}</td>
                                    <td><a href="{{ route('admin.complaint.detail', $complaint->id) }}"
                                            class="btn btn-warning">Detail</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
