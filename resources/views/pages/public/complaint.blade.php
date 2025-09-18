<!doctype html>
<html lang="en">

<head>
    <!-- Meta dan Bootstrap CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form dengan Peta Leaflet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Leaflet Geocoder -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        #map {
            height: 100vh;
            /* Fullscreen dalam modal */
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Pengaduan</h2>
        <form method="POST" action="{{ route('public.complaint.store') }}">
            @csrf

            <!-- Input Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="name" placeholder="Masukkan nama">
            </div>

            <div class="mb-3">
                <label class="form-label">NIK</label>
                <input type="text" class="form-control" name="nik" placeholder="Masukkan NIK">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" placeholder="Masukkan nomor telepon">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" name="address" placeholder="Masukkan alamat">
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Email</label>
                <input type="email" class="form-control" name="email" placeholder="Masukkan email">
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori Pengaduan</label>
                <select class="form-select" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Aduan</label>
                <textarea class="form-control" name="complaint" placeholder="Tuliskan aduan"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Link Aduan</label>
                <input type="text" class="form-control" name="complaint_link" placeholder="Masukkan link aduan">
            </div>

            <div class="mb-3">
                <label class="form-label">Lokasi Aduan</label>
                <input type="text" class="form-control" name="location" placeholder="Deskripsi lokasi">
            </div>

            <!-- Input Lat Long -->
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Latitude</label>
                    <input type="text" class="form-control" id="lat" name="lat" value="1.474830" readonly>
                </div>
                <div class="col">
                    <label class="form-label">Longitude</label>
                    <input type="text" class="form-control" id="long" name="long" value="124.842079"
                        readonly>
                </div>
            </div>

            <!-- Tombol untuk buka peta -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#mapModal">
                Pilih Lokasi di Peta
            </button>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Modal Fullscreen untuk peta -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Lokasi di Peta (Sulawesi Utara)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Leaflet Geocoder -->
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        let map, marker;

        // Koordinat default: Manado (pusat kota)
        const defaultLat = 1.474830;
        const defaultLng = 124.842079;

        // Bounding box Sulawesi Utara (kurang lebih)
        const boundsSulut = L.latLngBounds(
            [0.3000, 123.0000], // Southwest
            [5.0000, 126.0000] // Northeast
        );

        // Saat modal ditampilkan
        const mapModal = document.getElementById('mapModal');
        mapModal.addEventListener('shown.bs.modal', function() {
            if (!map) {
                // Inisialisasi Map (default ke Manado)
                map = L.map('map').setView([defaultLat, defaultLng], 9);

                // Tile layer
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                // Marker default
                marker = L.marker([defaultLat, defaultLng]).addTo(map);

                // Search bar dengan geocoder
                L.Control.geocoder({
                        defaultMarkGeocode: false,
                        geocoder: L.Control.Geocoder.nominatim({
                            geocodingQueryParams: {
                                countrycodes: 'id', // hanya Indonesia
                            }
                        })
                    })
                    .on('markgeocode', function(e) {
                        var latlng = e.geocode.center;

                        // Cek apakah hasil masih dalam Sulut
                        if (boundsSulut.contains(latlng)) {
                            map.setView(latlng, 14);
                            marker.setLatLng(latlng);

                            document.getElementById('lat').value = latlng.lat.toFixed(6);
                            document.getElementById('long').value = latlng.lng.toFixed(6);
                        } else {
                            alert("Lokasi harus di dalam Sulawesi Utara!");
                        }
                    })
                    .addTo(map);

                // Event klik di peta
                map.on('click', function(e) {
                    var lat = e.latlng.lat.toFixed(6);
                    var lng = e.latlng.lng.toFixed(6);

                    // Hanya izinkan jika dalam Sulawesi Utara
                    if (boundsSulut.contains(e.latlng)) {
                        marker.setLatLng([lat, lng]);
                        document.getElementById('lat').value = lat;
                        document.getElementById('long').value = lng;
                    } else {
                        alert("Lokasi harus di dalam Sulawesi Utara!");
                    }
                });
            } else {
                map.invalidateSize();
            }
        });
    </script>
</body>

</html>
