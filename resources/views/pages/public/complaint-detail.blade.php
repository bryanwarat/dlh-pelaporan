@extends('layouts.public.app')

@section('title', 'Detail Pelaporan #' . $complaint->id . ' - SiPerkasah')

@section('content')
    <main>
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/call/title-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Detail Pelaporan #{{ $complaint->id }}</h2>
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

                        <a href="{{ route('public.complaint.status.index') }}" class="btn btn-secondary mb-4"><i
                                class="fas fa-arrow-left"></i> Kembali ke Daftar</a>

                        {{-- Card Detail Pelaporan --}}
                        <div class="card mb-4">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0 text-white">Informasi Laporan</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Laporan:</strong>
                                    {{ \Illuminate\Support\Str::limit($complaint->complaint, 100) }}</p>
                                <p><strong>Status Terkini:</strong>
                                    @php
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
                                    <span class="badge bg-{{ $status_class }}">{{ $status_text }}</span>
                                </p>
                                <p><strong>Kategori:</strong> {{ $complaint->category->category ?? 'N/A' }}</p>
                                <p><strong>Lokasi Kejadian:</strong> {{ $complaint->location ?? '-' }}</p>
                                <p><strong>Dilaporkan oleh:</strong> {{ $complaint->name }}
                                    ({{ $complaint->created_at->translatedFormat('d F Y, H:i') }})</p>

                                <h6 class="mt-4">Detail Lengkap Laporan:</h6>
                                <p>{{ $complaint->complaint }}</p>

                            </div>
                        </div>

                        {{-- Card Riwayat Status (History) --}}
                        <div class="card">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0 text-white">Riwayat Tindak Lanjut</h5>
                            </div>
                            <div class="card-body">
                                @forelse ($complaint->histories as $history)
                                    <div class="timeline-item mb-3 p-3 border rounded">
                                        @php
                                            $status_text_hist = '';
                                            $status_class_hist = 'secondary';
                                            switch ((string) $history->status) {
                                                case '0':
                                                    $status_text_hist = 'Menunggu Verifikasi';
                                                    $status_class_hist = 'warning';
                                                    break;
                                                case '1':
                                                    $status_text_hist = 'Sedang Diproses';
                                                    $status_class_hist = 'primary';
                                                    break;
                                                case '2':
                                                    $status_text_hist = 'Selesai';
                                                    $status_class_hist = 'success';
                                                    break;
                                                case '3':
                                                    $status_text_hist = 'Ditolak';
                                                    $status_class_hist = 'danger';
                                                    break;
                                            }
                                        @endphp

                                        <p class="mb-1">
                                            <span class="badge bg-{{ $status_class_hist }}">{{ $status_text_hist }}</span>
                                            <small
                                                class="text-muted ms-2">{{ $history->created_at->translatedFormat('d F Y, H:i') }}</small>
                                        </p>

                                        @if ($history->notes)
                                            <p class="mb-0 mt-2"><strong>Keterangan:</strong></p>
                                            <p class="small text-muted">{{ $history->notes }}</p>
                                        @endif

                                    </div>
                                @empty
                                    <div class="alert alert-info">
                                        Status laporan ini belum pernah diubah oleh Admin. Status awal: Menunggu Verifikasi.
                                    </div>
                                @endforelse
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
