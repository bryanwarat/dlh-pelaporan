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

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden bg-primary">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-1">
                            <span
                                class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                    <path fill="#108dff" fill-rule="evenodd"
                                        d="M2.545 8.73C2 9.8 2 11.2 2 14s0 4.2.545 5.27a5 5 0 0 0 2.185 2.185C5.8 22 7.2 22 10 22h4c2.8 0 4.2 0 5.27-.545a5 5 0 0 0 2.185-2.185C22 18.2 22 16.8 22 14s0-4.2-.545-5.27a5 5 0 0 0-2.185-2.185C18.2 6 16.8 6 14 6h-4c-2.8 0-4.2 0-5.27.545A5 5 0 0 0 2.545 8.73M15.06 12.5a.75.75 0 0 0-1.12-1l-3.011 3.374l-.87-.974a.75.75 0 0 0-1.118 1l1.428 1.6a.75.75 0 0 0 1.119 0z"
                                        clip-rule="evenodd" />
                                    <path fill="#108dff"
                                        d="M12 2c4.713 0 7.07 0 8.535 1.464c.757.758 1.123 1.754 1.3 3.192V10H2.164V6.656c.176-1.438.541-2.434 1.299-3.192C4.928 2 7.285 2 11.999 2"
                                        opacity="0.5" />
                                </svg>
                            </span>
                            <div>
                                <p class="mb-2 text-white fs-15 fw-medium">Total Pengaduan</p>
                                <h3 class="mb-0 fs-22 text-white me-3">{{ $totalComplaints }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-1">
                            <span
                                class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                    <path fill="#28a745" fill-rule="evenodd"
                                        d="M2.545 8.73C2 9.8 2 11.2 2 14s0 4.2.545 5.27a5 5 0 0 0 2.185 2.185C5.8 22 7.2 22 10 22h4c2.8 0 4.2 0 5.27-.545a5 5 0 0 0 2.185-2.185C22 18.2 22 16.8 22 14s0-4.2-.545-5.27a5 5 0 0 0-2.185-2.185C18.2 6 16.8 6 14 6h-4c-2.8 0-4.2 0-5.27.545A5 5 0 0 0 2.545 8.73M15.06 12.5a.75.75 0 0 0-1.12-1l-3.011 3.374l-.87-.974a.75.75 0 0 0-1.118 1l1.428 1.6a.75.75 0 0 0 1.119 0z"
                                        clip-rule="evenodd" />
                                    <path fill="#28a745"
                                        d="M12 2c4.713 0 7.07 0 8.535 1.464c.757.758 1.123 1.754 1.3 3.192V10H2.164V6.656c.176-1.438.541-2.434 1.299-3.192C4.928 2 7.285 2 11.999 2"
                                        opacity="0.5" />
                                </svg>
                            </span>
                            <div>
                                <p class="mb-2 text-dark fs-15 fw-medium">Pengaduan Selesai</p>
                                <h3 class="mb-0 fs-22 text-dark me-3">{{ $totalSelesai }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-1">
                            <span
                                class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                    <path fill="#ffc107" fill-rule="evenodd"
                                        d="M2.545 8.73C2 9.8 2 11.2 2 14s0 4.2.545 5.27a5 5 0 0 0 2.185 2.185C5.8 22 7.2 22 10 22h4c2.8 0 4.2 0 5.27-.545a5 5 0 0 0 2.185-2.185C22 18.2 22 16.8 22 14s0-4.2-.545-5.27a5 5 0 0 0-2.185-2.185C18.2 6 16.8 6 14 6h-4c-2.8 0-4.2 0-5.27.545A5 5 0 0 0 2.545 8.73M15.06 12.5a.75.75 0 0 0-1.12-1l-3.011 3.374l-.87-.974a.75.75 0 0 0-1.118 1l1.428 1.6a.75.75 0 0 0 1.119 0z"
                                        clip-rule="evenodd" />
                                    <path fill="#ffc107"
                                        d="M12 2c4.713 0 7.07 0 8.535 1.464c.757.758 1.123 1.754 1.3 3.192V10H2.164V6.656c.176-1.438.541-2.434 1.299-3.192C4.928 2 7.285 2 11.999 2"
                                        opacity="0.5" />
                                </svg>
                            </span>
                            <div>
                                <p class="mb-2 text-dark fs-15 fw-medium">Sedang Diproses</p>
                                <h3 class="mb-0 fs-22 text-dark me-3">{{ $totalDiproses }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-1">
                            <span
                                class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                    <path fill="#dc3545" fill-rule="evenodd"
                                        d="M2.545 8.73C2 9.8 2 11.2 2 14s0 4.2.545 5.27a5 5 0 0 0 2.185 2.185C5.8 22 7.2 22 10 22h4c2.8 0 4.2 0 5.27-.545a5 5 0 0 0 2.185-2.185C22 18.2 22 16.8 22 14s0-4.2-.545-5.27a5 5 0 0 0-2.185-2.185C18.2 6 16.8 6 14 6h-4c-2.8 0-4.2 0-5.27.545A5 5 0 0 0 2.545 8.73M15.06 12.5a.75.75 0 0 0-1.12-1l-3.011 3.374l-.87-.974a.75.75 0 0 0-1.118 1l1.428 1.6a.75.75 0 0 0 1.119 0z"
                                        clip-rule="evenodd" />
                                    <path fill="#dc3545"
                                        d="M12 2c4.713 0 7.07 0 8.535 1.464c.757.758 1.123 1.754 1.3 3.192V10H2.164V6.656c.176-1.438.541-2.434 1.299-3.192C4.928 2 7.285 2 11.999 2"
                                        opacity="0.5" />
                                </svg>
                            </span>
                            <div>
                                <p class="mb-2 text-dark fs-15 fw-medium">Pengaduan Ditolak</p>
                                <h3 class="mb-0 fs-22 text-dark me-3">{{ $totalDitolak }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
