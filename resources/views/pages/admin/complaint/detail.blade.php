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
            <a href="{{ route('admin.complaint.index') }}" class="btn btn-primary">Kembali</a>

        </div>
    </div>

    <!-- Start Main Widgets -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">Detail Pengaduan</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">{{ $complaint->category ?? '-' }}</dd>

                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $complaint->name ?? '-' }}</dd>

                        <dt class="col-sm-3">NIK</dt>
                        <dd class="col-sm-9">{{ $complaint->nik ?? '-' }}</dd>

                        <dt class="col-sm-3">Telepon</dt>
                        <dd class="col-sm-9">{{ $complaint->phone ?? '-' }}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $complaint->email ?? '-' }}</dd>

                        <dt class="col-sm-3">Alamat</dt>
                        <dd class="col-sm-9">{{ $complaint->address ?? '-' }}</dd>

                        <dt class="col-sm-3">Isi Pengaduan</dt>
                        <dd class="col-sm-9">{{ $complaint->complaint ?? '-' }}</dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9">
                            @if ($complaint->status == 0)
                                <span class="badge bg-warning"> Belum Diproses </span>
                            @elseif ($complaint->status == 1)
                                <span class="badge bg-info"> Sedang Diproses </span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Dibuat</dt>
                        <dd class="col-sm-9">{{ $complaint->created_at->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-3">Diupdate</dt>
                        <dd class="col-sm-9">{{ $complaint->updated_at->format('d M Y H:i') }}</dd>

                        <dt class="col-sm-3">Lokasi</dt>
                        <dd class="col-sm-12">
                            @if ($complaint->lat && $complaint->long)
                                <div id="map" style="height: 300px; border-radius: 8px;"></div>
                            @else
                                <span class="text-muted">Lokasi tidak tersedia</span>
                            @endif
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>



@endsection


@push('scripts')
    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @if ($complaint->lat && $complaint->long)
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var map = L.map('map').setView(
                    [{{ $complaint->lat }}, {{ $complaint->long }}],
                    15
                );

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                L.marker([{{ $complaint->lat }}, {{ $complaint->long }}]).addTo(map)
                    .bindPopup("Lokasi Pengaduan")
                    .openPopup();
            });
        </script>
    @endif
@endpush
