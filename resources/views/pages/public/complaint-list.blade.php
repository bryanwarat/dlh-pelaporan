@extends('layouts.public.app')

@section('title', 'Daftar Pelaporan - SiPerkasah')

@section('content')
    <main>
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/call/title-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Daftar Pelaporan Publik</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about-area about-p pt-100 pb-100 p-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0 text-white">Laporan Terbaru</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No. Laporan</th>
                                                <th>Judul / Ringkasan</th>
                                                <th>Pelapor</th>
                                                <th>Status</th>
                                                <th>Tanggal Lapor</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($complaints as $complaint)
                                                <tr>
                                                    <td>#{{ $complaint->id }}</td>
                                                    <td>
                                                        {{ \Illuminate\Support\Str::limit($complaint->complaint, 50, '...') }}
                                                    </td>
                                                    <td>{{ $complaint->name }}</td>
                                                    <td>
                                                        @php
                                                            // Asumsi status adalah field langsung di model Complaint
                                                            $status_code = $complaint->status;
                                                            $status_text = '';
                                                            $status_class = 'secondary';

                                                            switch ((string) $status_code) {
                                                                case '0':
                                                                    $status_text = 'Menunggu Verifikasi';
                                                                    $status_class = 'warning';
                                                                    break;
                                                                case '1':
                                                                    $status_text = 'Sedang Diproses';
                                                                    $status_class = 'primary';
                                                                    break;
                                                                case '2':
                                                                    $status_text = 'Selesai / Ditindaklanjuti';
                                                                    $status_class = 'success';
                                                                    break;
                                                                case '3':
                                                                    $status_text = 'Ditolak';
                                                                    $status_class = 'danger';
                                                                    break;
                                                                default:
                                                                    $status_text = 'Tidak Dikenal';
                                                                    $status_class = 'secondary';
                                                                    break;
                                                            }
                                                        @endphp
                                                        <span
                                                            class="badge bg-{{ $status_class }}">{{ $status_text }}</span>
                                                    </td>
                                                    <td>{{ $complaint->created_at->translatedFormat('d M Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('public.complaint.status.show', $complaint->id) }}"
                                                            class="btn btn-sm btn-info">Detail</a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Belum ada pelaporan publik yang
                                                        tersedia.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $complaints->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
