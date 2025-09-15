@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('meta_description', 'Halaman dashboard aplikasi admin')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
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
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Warren Jackson</td>
                                <td>Jackson</td>
                                <td>336-508-2157</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Amy</td>
                                <td>Cunha</td>
                                <td>646-473-2057</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Steven</td>
                                <td>Loch</td>
                                <td>281-308-0793</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
