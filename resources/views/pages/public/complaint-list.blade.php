@extends('layouts.public.app')

@section('title', 'Daftar Pelaporan - SiPerkasah')

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
                                <h2>Daftar Pelaporan Publik</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Daftar Laporan --}}
        <section class="about-area about-p pt-100 pb-100 p-relative">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">



                        {{-- Card Daftar Laporan --}}
                        <div class="card shadow-lg">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0 text-white"><i class="fas fa-list-ul me-2"></i> Laporan
                                    Masyarakat</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th scope="col" style="width: 60%;">Laporan Singkat</th>
                                                <th scope="col" style="width: 25%;">Status</th>
                                                <th scope="col" style="width: 15%;">Tanggal Lapor</th>
                                                {{-- Menghapus kolom Aksi/Detail --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($complaints as $key => $complaint)
                                                @php
                                                    // Logic penentuan status menggunakan Match
                                                    $status_code = (string) $complaint->status;
                                                    $status_data = match ($status_code) {
                                                        '0' => [
                                                            'text' => 'Menunggu Verifikasi',
                                                            'class' => 'warning',
                                                            'icon' => 'hourglass-half',
                                                        ],
                                                        '1' => [
                                                            'text' => 'Sedang Diproses',
                                                            'class' => 'primary',
                                                            'icon' => 'spinner',
                                                        ],
                                                        '2' => [
                                                            'text' => 'Selesai / Ditindaklanjuti',
                                                            'class' => 'success',
                                                            'icon' => 'check-circle',
                                                        ],
                                                        '3' => [
                                                            'text' => 'Ditolak',
                                                            'class' => 'danger',
                                                            'icon' => 'times-circle',
                                                        ],
                                                        default => [
                                                            'text' => 'Tidak Dikenal',
                                                            'class' => 'secondary',
                                                            'icon' => 'question-circle',
                                                        ],
                                                    };
                                                @endphp
                                                {{-- BARIS YANG DAPAT DIKLIK --}}
                                                <tr onclick="window.location='{{ route('public.complaint.status.show', $complaint->id) }}'"
                                                    style="cursor: pointer;">
                                                    <td>
                                                        <strong
                                                            class="text-dark">{{ $complaint->category ?? 'N/A' }}</strong><br>
                                                        <small
                                                            class="text-muted">{{ \Illuminate\Support\Str::limit($complaint->complaint, 80, '...') }}</small>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-{{ $status_data['class'] }}">
                                                            <i class="fas fa-{{ $status_data['icon'] }} me-1"></i>
                                                            {{ $status_data['text'] }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <i class="far fa-calendar-alt me-1 text-muted"></i>
                                                        {{ $complaint->created_at->translatedFormat('d M Y') }}
                                                    </td>
                                                    {{-- Kolom Aksi dihilangkan --}}
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center py-4">
                                                        <p class="text-muted mb-0"><i class="fas fa-inbox me-2"></i> Belum
                                                            ada laporan yang sesuai dengan kriteria Anda.</p>
                                                        <p class="text-muted"><small>Silakan coba kata kunci atau filter
                                                                status yang lain.</small></p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- Pagination --}}
                            <div class="card-footer bg-white border-0">
                                <div class="d-flex justify-content-center">
                                    {{ $complaints->links('pagination::bootstrap-5') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
