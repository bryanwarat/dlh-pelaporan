@extends('layouts.public.app')

@section('title', 'Pelaporan - SiPerkasah')

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

                                <p class="text-muted mb-4">Catatan : Tanda <span class="text-danger">*</span> Wajib diisi
                                </p>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="card mb-4">
                                    <div class="card-header bg-danger text-white">
                                        <h5 class="card-title mb-0 text-white">1. Detail Laporan</h5>
                                    </div>
                                    <div class="card-body row g-3">
                                        <div class="col-md-12">
                                            <label class="form-label text-black">Kategori Laporan <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('category_id') is-invalid @enderror"
                                                name="category_id" id="category_id" required>
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
                                            <label class="form-label text-black">Bukti (Foto/PDF)</label>
                                            <input type="file" class="form-control @error('files') is-invalid @enderror"
                                                name="files[]" multiple>
                                            <small class="text-muted">Boleh lebih dari satu file (jpg, png, pdf, max
                                                2MB)</small>
                                            @error('files')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label text-black">Link Terkait</label>
                                            <input type="text"
                                                class="form-control @error('complaint_link') is-invalid @enderror"
                                                name="complaint_link" value="{{ old('complaint_link') }}"
                                                placeholder="(opsional) contoh : link google drive, youtube, facebook, dll">
                                            @error('complaint_link')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-black">Laporan <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('complaint') is-invalid @enderror" name="complaint" rows="5"
                                                placeholder="Jelaskan detail laporan Anda">{{ old('complaint') }}</textarea>
                                            @error('complaint')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label text-black">Lokasi Kejadian <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control @error('location') is-invalid @enderror" name="location"
                                                value="{{ old('location') }}" placeholder="Deskripsi lokasi aduan">
                                            @error('location')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label text-black">Pilih Lokasi di Peta</label>
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
                                        <div class="col-12">

                                            <div class="alert alert-info" role="alert">
                                                <div class="d-flex align-items-start mb-2">
                                                    <i class="fas fa-check-circle me-2 mt-1"></i>
                                                    <span>Harap berikan data yang benar, karena kami akan menghubungi Anda
                                                        terkait perkembangan laporan berdasarkan data kontak yang
                                                        diberikan.
                                                    </span>
                                                </div>
                                                <div class="d-flex align-items-start mb-2">
                                                    <i class="fas fa-check-circle me-2 mt-1"></i>
                                                    <span>Kami memastikan data yang Anda kirimkan aman dan
                                                        dirahasiakan.</span>
                                                </div>
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-check-circle me-2 mt-1"></i>
                                                    <span>Jika anda mencentang "Laporkan secara anonim", maka data yang
                                                        diminta hanya nomor telepon.</span>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="anonim-checkbox"
                                                    name="is_anonim" value="1"
                                                    {{ old('is_anonim') ? 'checked' : '' }}>
                                                <label class="form-check-label fw-bold" for="anonim-checkbox">
                                                    Laporkan secara anonim
                                                </label>
                                            </div>
                                        </div>
                                        <div id="pelapor-fields" class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label" for="name">Nama Lengkap <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    name="name" id="name" value="{{ old('name') }}"
                                                    placeholder="Masukkan nama" required>
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="nik">NIK <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('nik') is-invalid @enderror" name="nik"
                                                    id="nik" value="{{ old('nik') }}"
                                                    placeholder="Masukkan NIK" required>
                                                @error('nik')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="phone">Nomor Telepon (Whatsapp) <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" id="phone" value="{{ old('phone') }}"
                                                    placeholder="Masukkan nomor telepon" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label" for="email">Alamat Email <span
                                                        class="text-danger">*</span></label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" id="email" value="{{ old('email') }}"
                                                    placeholder="Masukkan alamat email" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label" for="address">Alamat <span
                                                        class="text-danger">*</span></label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"
                                                    placeholder="Masukkan alamat lengkap" required>{{ old('address') }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-success btn-lg">Kirim Laporan</button>
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

            // LOGIKA ANOMIM
            const anonimCheckbox = document.getElementById('anonim-checkbox');
            const nameInput = document.getElementById('name');
            const nikInput = document.getElementById('nik');
            const phoneInput = document.getElementById('phone');
            const emailInput = document.getElementById('email');
            const addressTextarea = document.getElementById('address');

            // Simpan nilai awal atribut 'required'
            const initialRequired = {
                name: nameInput.hasAttribute('required'),
                nik: nikInput.hasAttribute('required'),
                phone: phoneInput.hasAttribute('required'),
                email: emailInput.hasAttribute('required'),
                address: addressTextarea.hasAttribute('required')
            };

            anonimCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    // Simpan nilai input saat ini sebelum diubah
                    nameInput.dataset.originalValue = nameInput.value;
                    nikInput.dataset.originalValue = nikInput.value;
                    emailInput.dataset.originalValue = emailInput.value;
                    addressTextarea.dataset.originalValue = addressTextarea.value;
                    phoneInput.dataset.originalValue = phoneInput.value; // Simpan nilai phone juga

                    // Ubah nilai dan set readonly
                    nameInput.value = 'Anonim';
                    nikInput.value = '-';
                    emailInput.value = '-';
                    addressTextarea.value = '-';

                    nameInput.readOnly = true;
                    nikInput.readOnly = true;
                    emailInput.readOnly = true;
                    addressTextarea.readOnly = true;

                    // Hapus required, kecuali untuk phone
                    nameInput.removeAttribute('required');
                    nikInput.removeAttribute('required');
                    emailInput.removeAttribute('required');
                    addressTextarea.removeAttribute('required');

                } else {
                    // Kembalikan nilai dan hapus readonly
                    nameInput.readOnly = false;
                    nikInput.readOnly = false;
                    emailInput.readOnly = false;
                    addressTextarea.readOnly = false;

                    nameInput.value = nameInput.dataset.originalValue || '';
                    nikInput.value = nikInput.dataset.originalValue || '';
                    emailInput.value = emailInput.dataset.originalValue || '';
                    addressTextarea.value = addressTextarea.dataset.originalValue || '';
                    phoneInput.value = phoneInput.dataset.originalValue || '';

                    // Kembalikan atribut required ke field yang seharusnya
                    if (initialRequired.name) nameInput.setAttribute('required', '');
                    if (initialRequired.nik) nikInput.setAttribute('required', '');
                    if (initialRequired.email) emailInput.setAttribute('required', '');
                    if (initialRequired.address) addressTextarea.setAttribute('required', '');
                }
            });

            // Tangani kondisi saat halaman direfresh dengan old input yang anonim
            if (anonimCheckbox.checked) {
                anonimCheckbox.dispatchEvent(new Event('change'));
            }
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
