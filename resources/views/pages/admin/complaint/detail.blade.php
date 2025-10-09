@extends('layouts.admin.app')

@section('title', 'Detail Pengaduan')
@section('meta_description', 'Halaman detail pengaduan')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail Pengaduan</h4>
        </div>
        <div class="text-end">
            <a href="{{ route('admin.complaint.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Kolom Kiri -->
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Aduan</h5>
                </div>
                <div class="card-body">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <p>{{ $complaint->category }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pelapor</label>
                        <p>{{ $complaint->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">NIK</label>
                        <p>{{ $complaint->nik }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Telepon</label>
                        <p>{{ $complaint->phone }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <p>{{ $complaint->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <p>{{ $complaint->address }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Aduan</label>
                        <p>{{ $complaint->complaint }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Terkait</label>
                        @if ($complaint->complaint_link)
                            <p><a href="{{ $complaint->complaint_link }}"
                                    target="_blank">{{ $complaint->complaint_link }}</a></p>
                        @else
                            <p class="text-muted">Tidak ada link</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- Kolom Kanan -->
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Lampiran</h5>
                </div>
                <div class="card-body">
                    @if ($files->count() > 0)
                        <ul class="list-group">
                            @foreach ($files as $file)
                                <li class="list-group-item">
                                    <a href="{{ asset('storage/' . $file->complaint_file) }}" target="_blank">
                                        {{ basename($file->complaint_file) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Tidak ada file yang diupload.</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Lokasi Aduan</h5>
                </div>
                <div class="card-body">
                    <p>{{ $complaint->location }}</p>
                    <div id="map" style="height:400px; width:100%; border-radius:8px; overflow:hidden;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let lat = {{ $complaint->lat ?? 1.47483 }};
            let lng = {{ $complaint->long ?? 124.842079 }};

            let map = L.map('map').setView([lat, lng], 14);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([lat, lng]).addTo(map);

            setTimeout(() => {
                map.invalidateSize();
            }, 500);
        });
    </script>
@endpush
