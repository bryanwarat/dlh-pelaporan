@extends('layouts.admin.app')

@section('title', 'Pelaporan')
@section('meta_description', 'Halaman daftar pengaduan aplikasi admin')
@section('meta_author', 'Admin')

@section('content')
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Daftar Pelaporan</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Data Laporan</h5>
                </div>
                <div class="card-body">
                    {{-- FORM FILTER REKAPAN --}}
                    <form id="filter-form" class="row g-3 align-items-end mb-4">
                        {{-- Tanggal Mulai (HTML Native Picker) --}}
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>

                        {{-- Tanggal Akhir (HTML Native Picker) --}}
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>

                        <div class="col-md-3">
                            <label for="filter_status" class="form-label">Status Laporan</label>
                            <select class="form-select" id="filter_status" name="status">
                                <option value="">Semua Status</option>
                                <option value="0">Belum Diproses</option>
                                <option value="1">Sedang Diproses</option>
                                <option value="2">Selesai</option>
                                <option value="3">Ditolak</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <button type="button" id="apply-filter" class="btn btn-primary me-2"><i
                                    class="fas fa-filter me-1"></i> Terapkan Filter</button>
                            <button type="button" id="reset-filter" class="btn btn-secondary"><i
                                    class="fas fa-redo me-1"></i> Reset</button>
                        </div>
                    </form>
                    {{-- END FORM FILTER --}}

                    <div class="table-responsive">
                        <table id="complaints-table" class="table table-bordered table-striped align-middle w-100">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Kategori</th>
                                    <th>Aduan</th>
                                    <th>Lokasi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        /* Gaya kursor untuk tombol */
        #apply-filter,
        #reset-filter,
        #complaints-table tbody tr {
            cursor: pointer;
        }
    </style>
@endpush


@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <script
        src="https://www.google.com/search?q=https://cdn.jsdelivr.net/npm/bootstrap%405.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

    <script>
        $(function() {
            // 1. Inisialisasi DataTables
            var table = $('#complaints-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.complaint.data') }}",
                    data: function(d) {
                        // Mengirim parameter filter ke Controller
                        d.status = $('#filter_status').val();
                        // Mengambil nilai dari input type="date"
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'nik',
                        name: 'nik'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'category',
                        name: 'complaint_categories.category'
                    },
                    {
                        data: 'complaint',
                        name: 'complaint'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                order: [
                    [1, 'desc']
                ],
                pageLength: 10
            });

            // 2. Event Listener untuk Tombol Filter dan Reset

            // Terapkan Filter
            $('#apply-filter').click(function() {
                table.draw(); // Muat ulang DataTables dengan parameter baru
            });

            // Reset Filter
            $('#reset-filter').click(function() {
                $('#filter_status').val('');
                $('#start_date').val(''); // Reset input type="date"
                $('#end_date').val(''); // Reset input type="date"
                table.draw(); // Muat ulang DataTables tanpa filter
            });

            // Otomatis terapkan filter saat status diubah
            $('#filter_status').on('change', function() {
                $('#apply-filter').click();
            });
        });
    </script>
@endpush
