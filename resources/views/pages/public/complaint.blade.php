@extends('layouts.public.app')

@section('title', 'Form Pengaduan')

@section('content')
    <main>
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/call/title-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Form Pelaporan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="about-area about-p pt-100 pb-100 p-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="about-content s-about-content">

                            <form method="POST" action="{{ route('public.complaint.store') }}"
                                enctype="multipart/form-data" class="contact-form">
                                @csrf

                                <p class="text-muted mb-4"><span class="text-danger">*</span> Wajib diisi</p>



                                <div class="card mb-4">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="card-title mb-0 text-white">1. Detail Pengaduan</h5>
                                    </div>
                                    <div class="card-body row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label">Kategori Pengaduan <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                name="category_id">
                                                <option value="">-- Pilih Kategori --</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">Lampiran (Foto/PDF)</label>
                                            <input type="file" class="form-control @error('files') is-invalid @enderror"
                                                name="files[]" multiple>
                                            <small class="text-muted">Boleh lebih dari satu file (jpg, png, pdf, max
                                                2MB)</small>
                                            @error('files')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Link Terkait</label>
                                            <input type="text"
                                                class="form-control @error('complaint_link') is-invalid @enderror"
                                                name="complaint_link" value="{{ old('complaint_link') }}"
                                                placeholder="(opsional) contoh : link google drive, youtube, facebook, dll">
                                            @error('complaint_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Aduan <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('complaint') is-invalid @enderror" name="complaint" rows="5"
                                                placeholder="Jelaskan detail pengaduan Anda">{{ old('complaint') }}</textarea>
                                            @error('complaint')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Lokasi Aduan <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('location') is-invalid @enderror" name="location"
                                                value="{{ old('location') }}" placeholder="Deskripsi lokasi aduan">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Pilih Lokasi di Peta</label>
                                            <div id="map"
                                                style="height:400px; width:100%; border-radius:8px; overflow:hidden;">
                                            </div>
                                            <input type="hidden" id="lat" name="lat"
                                                value="{{ old('lat', '1.474830') }}">
                                            <input type="hidden" id="long" name="long"
                                                value="{{ old('long', '124.842079') }}">
                                        </div>



                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="card-title mb-0 text-white">2. Data Pelapor</h5>
                                    </div>
                                    <div class="card-body row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Lengkap <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" placeholder="Masukkan nama">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">NIK <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('nik') is-invalid @enderror"
                                                name="nik" value="{{ old('nik') }}" placeholder="Masukkan NIK">
                                            @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Nomor Telepon <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                name="phone" value="{{ old('phone') }}"
                                                placeholder="Masukkan nomor telepon">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" placeholder="Masukkan alamat email">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3"
                                                placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg">Kirim Aduan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        let map, marker;
        const defaultLat = 1.474830;
        const defaultLng = 124.842079;
        const boundsSulut = L.latLngBounds([0.3000, 123.0000], [5.0000, 126.0000]);

        document.addEventListener("DOMContentLoaded", function() {
            map = L.map('map').setView([defaultLat, defaultLng], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            marker = L.marker([defaultLat, defaultLng]).addTo(map);

            setTimeout(() => {
                map.invalidateSize();
            }, 500);

            L.Control.geocoder({
                    defaultMarkGeocode: false,
                    geocoder: L.Control.Geocoder.nominatim({
                        geocodingQueryParams: {
                            countrycodes: 'id'
                        }
                    })
                })
                .on('markgeocode', function(e) {
                    var latlng = e.geocode.center;
                    if (boundsSulut.contains(latlng)) {
                        map.setView(latlng, 14);
                        marker.setLatLng(latlng);
                        document.getElementById('lat').value = latlng.lat.toFixed(6);
                        document.getElementById('long').value = latlng.lng.toFixed(6);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Lokasi Tidak Valid',
                            text: 'Lokasi harus di dalam area Sulawesi Utara!'
                        });
                    }
                })
                .addTo(map);

            map.on('click', function(e) {
                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);
                if (boundsSulut.contains(e.latlng)) {
                    marker.setLatLng([lat, lng]);
                    document.getElementById('lat').value = lat;
                    document.getElementById('long').value = lng;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Lokasi Tidak Valid',
                        text: 'Lokasi harus di dalam area Sulawesi Utara!'
                    });
                }
            });
        });
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endpush
