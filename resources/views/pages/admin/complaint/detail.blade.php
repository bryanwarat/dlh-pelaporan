@extends('layouts.admin.app')

@section('title', 'Detail Laporan')
@section('meta_description', 'Halaman detail Laporan')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Detail Laporan</h4>
        </div>
        <div class="text-end">
            <a href="{{ route('admin.complaint.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Informasi Aduan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Pengaduan</label>

                        <p>{{ \carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F, Y') }}</p>
                    </div>
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
                        <p>
                            {{ $complaint->phone }}
                            {{-- Tombol WhatsApp --}}
                            @if ($complaint->phone)
                                @php
                                    // Hilangkan karakter non-digit dan tambahkan kode negara
                                    $whatsappNumber = preg_replace('/[^0-9]/', '', $complaint->phone);
                                    if (substr($whatsappNumber, 0, 1) === '0') {
                                        $whatsappNumber = '62' . substr($whatsappNumber, 1);
                                    }
                                    $whatsappLink = 'https://wa.me/' . $whatsappNumber;
                                @endphp
                                <a href="{{ $whatsappLink }}" target="_blank" class="btn btn-sm btn-success ms-2">
                                    <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                                </a>
                            @endif
                        </p>
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

        <div class="col-lg-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Status Pengaduan</h5>
                </div>
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        Status Saat Ini:
                        @if ($complaint->status == 1)
                            <span class="badge bg-info fs-14">Sedang Diproses</span>
                        @elseif ($complaint->status == 2)
                            <span class="badge bg-success fs-14">Selesai</span>
                        @elseif ($complaint->status == 3)
                            <span class="badge bg-danger fs-14">Ditolak</span>
                        @else
                            <span class="badge bg-warning fs-14">Belum Diproses</span>
                        @endif
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#updateStatusModal">
                        Ubah Status
                    </button>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Lokasi Aduan</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Lokasi</label>
                        <p>{{ $complaint->location }}</p>
                    </div>
                    <div id="map" style="height:400px; width:100%; border-radius:8px; overflow:hidden;"></div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Lampiran</h5>
                </div>
                <div class="card-body">
                    @if ($files->count() > 0)
                        <ul class="list-group">
                            @foreach ($files as $file)
                                @php
                                    $fileUrl = asset('storage/' . $file->complaint_file);
                                    $fileName = basename($file->complaint_file);
                                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                                    $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png']);
                                @endphp
                                <li class="list-group-item">
                                    <a href="{{ $fileUrl }}" target="_blank"
                                        class="text-decoration-none d-flex align-items-center">
                                        @if ($isImage)
                                            <img src="{{ $fileUrl }}" alt="{{ $fileName }}"
                                                style="max-width: 100px; max-height: 100px; margin-right: 15px; border-radius: 4px; object-fit: cover; border: 1px solid #ddd;">
                                            <span>{{ $fileName }} (Gambar)</span>
                                        @else
                                            <i class="fas fa-file-alt me-2 text-primary fs-4"></i>
                                            <span>{{ $fileName }}</span>
                                        @endif
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
                    <h5 class="card-title mb-0">Riwayat Status</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Status Baru</th>
                                    <th>Catatan</th>
                                    <th>Diubah Oleh</th>
                                    <th>Aksi</th> {{-- Kolom baru untuk tombol edit --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr>
                                        <td>{{ $history->created_at->translatedFormat('d F Y, H:i') }}</td>
                                        <td>
                                            @if ($history->status == 1)
                                                <span class="badge bg-info">Sedang Diproses</span>
                                            @elseif ($history->status == 2)
                                                <span class="badge bg-success">Selesai</span>
                                            @elseif ($history->status == 3)
                                                <span class="badge bg-danger">Ditolak</span>
                                            @else
                                                <span class="badge bg-warning">Belum Diproses</span>
                                            @endif
                                        </td>
                                        {{-- Tambahkan ID untuk memudahkan update catatan --}}
                                        <td id="note-{{ $history->id }}">{{ $history->note ?? '-' }}</td>
                                        <td>{{ $history->user_name ?? 'Admin' }}</td>
                                        <td>
                                            {{-- Tombol untuk membuka modal edit catatan --}}
                                            <button type="button" class="btn btn-sm btn-warning edit-note-btn"
                                                data-bs-toggle="modal" data-bs-target="#editNoteModal"
                                                data-id="{{ $history->id }}" data-note="{{ $history->note ?? '' }}">
                                                Edit Catatan
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada riwayat perubahan status.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal untuk Update Status Utama --}}
    <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="updateStatusForm" action="{{ route('admin.complaint.update_status', $complaint->id) }}"
                method="POST" class="modal-content">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Pengaduan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Pilih Status Baru</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="0" {{ $complaint->status == 0 ? 'selected' : '' }}>Belum Diproses</option>
                            <option value="1" {{ $complaint->status == 1 ? 'selected' : '' }}>Sedang Diproses
                            </option>
                            <option value="2" {{ $complaint->status == 2 ? 'selected' : '' }}>Selesai</option>
                            <option value="3" {{ $complaint->status == 3 ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Catatan</label>
                        <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL BARU UNTUK EDIT CATATAN RIWAYAT --}}
    <div class="modal fade" id="editNoteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editNoteForm" method="POST" class="modal-content">
                @csrf
                @method('PUT') {{-- Method spoofing untuk PUT request --}}
                {{-- Kita tidak perlu input hidden history_id di sini, 
                     karena action URL akan diatur secara dinamis oleh JS --}}
                <div class="modal-header">
                    <h5 class="modal-title">Edit Catatan Riwayat Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_note" class="form-label">Catatan</label>
                        {{-- ID 'edit_note' akan digunakan oleh JavaScript --}}
                        <textarea class="form-control" id="edit_note" name="note" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // LOGIKA UPDATE STATUS UTAMA
        document.getElementById('updateStatusForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const actionUrl = form.getAttribute('action');

            // Tambahkan _method=PUT ke FormData
            formData.append('_method', 'PUT');

            fetch(actionUrl, {
                    method: 'POST', // Menggunakan POST karena _method=PUT di body
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            // Mengambil pesan error dari JSON response jika ada
                            throw new Error(errorData.message || 'Gagal terhubung ke server.');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat memperbarui status.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Koneksi ke server gagal atau terjadi kesalahan pada server: ' + error
                            .message,
                    });
                });
        });

        // =========================================================================================
        // LOGIKA EDIT CATATAN RIWAYAT STATUS (HISTORY NOTE)
        // =========================================================================================

        // 1. Setup modal saat tombol edit diklik
        const editNoteModal = document.getElementById('editNoteModal');
        const editNoteForm = document.getElementById('editNoteForm');
        const editNoteTextarea = document.getElementById('edit_note');

        // Asumsi rute untuk update history adalah 'admin.complaint.history.update'
        // Pastikan Anda telah mendefinisikan rute ini di web.php
        const updateHistoryRoute = "{{ route('admin.complaint.history.update', ['id' => ':id']) }}";

        editNoteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // Tombol Edit yang diklik
            const historyId = button.getAttribute('data-id');
            // Menggunakan data-note. Mengganti null/undefined menjadi string kosong
            const currentNote = button.getAttribute('data-note') || '';

            // Isi textarea dan atur action form
            editNoteTextarea.value = currentNote;

            // Atur action form menggunakan ID yang diambil
            editNoteForm.setAttribute('action', updateHistoryRoute.replace(':id', historyId));
        });

        // 2. Kirim update catatan via AJAX
        editNoteForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);
            const actionUrl = form.getAttribute('action');

            // Tambahkan _method=PUT karena form menggunakan method POST
            formData.append('_method', 'PUT');

            fetch(actionUrl, {
                    method: 'POST', // Menggunakan POST karena _method=PUT di body
                    body: formData,
                    headers: {
                        // KOREKSI: Mengganti 'csrf-csrf-token' menjadi 'csrf-token'
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error(errorData.message || 'Gagal terhubung ke server.');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload(); // Reload halaman untuk melihat perubahan
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan saat menyimpan catatan.'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Koneksi ke server gagal atau terjadi kesalahan pada server: ' + error
                            .message,
                    });
                });
        });
    </script>
@endpush
