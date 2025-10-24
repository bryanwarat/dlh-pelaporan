@extends('layouts.public.app')

@section('title', 'Detail Pelaporan - SiPerkasah')

@section('content')
    <main>
        {{-- Breadcrumb Area --}}
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/call/title-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Detail Pelaporan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Content Area --}}
        <section class="about-area about-p pt-100 pb-100 p-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">

                        <a href="{{ route('public.complaint.status.index') }}" class="btn btn-secondary mb-4">
                            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                        </a>

                        {{-- Card Detail Pelaporan Utama --}}
                        <div class="card shadow-sm mb-5">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0 text-white"><i class="fas fa-info-circle me-2"></i> Informasi
                                    Laporan</h5>
                            </div>
                            <div class="card-body">
                                @php
                                    // Logic penentuan status terkini
                                    $status_code = (string) $complaint->status;
                                    $status_data = match ($status_code) {
                                        '0' => ['text' => 'Menunggu Verifikasi', 'class' => 'warning'],
                                        '1' => ['text' => 'Sedang Diproses', 'class' => 'primary'],
                                        '2' => ['text' => 'Selesai / Ditindaklanjuti', 'class' => 'success'],
                                        '3' => ['text' => 'Ditolak', 'class' => 'danger'],
                                        default => ['text' => 'Tidak Dikenal', 'class' => 'secondary'],
                                    };
                                @endphp

                                <div class="row mb-3">
                                    <div class="col-md-4"><strong>Nomor Laporan:</strong></div>
                                    <div class="col-md-8">{{ $complaint->id }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><strong>Status Terkini:</strong></div>
                                    <div class="col-md-8">
                                        <span class="badge bg-{{ $status_data['class'] }}">{{ $status_data['text'] }}</span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><strong>Kategori:</strong></div>
                                    <div class="col-md-8">{{ $complaint->category->category ?? 'N/A' }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><strong>Lokasi Kejadian:</strong></div>
                                    <div class="col-md-8">{{ $complaint->location ?? '-' }}</div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4"><strong>Dilaporkan oleh:</strong></div>
                                    <div class="col-md-8">
                                        {{ $complaint->name }}
                                        ({{ $complaint->created_at->translatedFormat('d F Y, H:i') }})
                                    </div>
                                </div>

                                <hr>

                                <h6 class="mt-4 mb-3 text-danger">Detail Lengkap Laporan:</h6>
                                <div class="p-3 border rounded bg-light">
                                    <p class="mb-0">{{ $complaint->complaint }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Card Riwayat Status (History) --}}
                        <div class="card shadow-sm">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0 text-white"><i class="fas fa-history me-2"></i> Riwayat Tindak
                                    Lanjut</h5>
                            </div>
                            <div class="card-body">
                                @forelse ($complaint->histories->sortByDesc('created_at') as $history)
                                    @php
                                        // Logic penentuan status riwayat
                                        $status_text_hist = '';
                                        $status_class_hist = 'secondary';
                                        $status_code_hist = (string) $history->status;

                                        $history_status = match ($status_code_hist) {
                                            '0' => ['text' => 'Menunggu Verifikasi', 'class' => 'warning'],
                                            '1' => ['text' => 'Sedang Diproses', 'class' => 'primary'],
                                            '2' => ['text' => 'Selesai', 'class' => 'success'],
                                            '3' => ['text' => 'Ditolak', 'class' => 'danger'],
                                            default => ['text' => 'Tidak Dikenal', 'class' => 'secondary'],
                                        };
                                    @endphp
                                    <div class="timeline-item mb-4 pb-3 border-bottom">
                                        <p class="mb-1">
                                            <span
                                                class="badge bg-{{ $history_status['class'] }}">{{ $history_status['text'] }}</span>
                                            <small class="text-muted ms-3">
                                                <i class="far fa-clock"></i>
                                                {{ $history->created_at->translatedFormat('d F Y') }}
                                                pukul {{ $history->created_at->translatedFormat('H:i') }}
                                            </small>
                                        </p>

                                        @if ($history->note)
                                            <div class="alert alert-light border p-2 mt-2 mb-0">
                                                <strong>Keterangan Admin:</strong>
                                                <p class="mb-0">{{ $history->note }}</p>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-exclamation-circle me-2"></i> Belum ada tindak lanjut. Status awal:
                                        **Menunggu Verifikasi**.
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
