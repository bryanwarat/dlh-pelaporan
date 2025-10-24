@extends('layouts.public.app')

@section('title', 'SiPerkasah')
@section('meta_description', 'SiPerkasah - Sistem Informasi dan Pelaporan Pencemaran Serta Kerusakan Lingkungan Hidup')

@section('content')
    <main>

        <section class="modal fade bs-example-modal-lg search-bg popup1" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content search-popup">
                    <div class="text-center">
                        <a href="#" class="close2" data-dismiss="modal" aria-label="Close">× close</a>
                    </div>
                    <div class="row search-outer">
                        <div class="col-md-11"><input type="text" placeholder="Search for products..." /></div>
                        <div class="col-md-1 text-right"><a href="#"><i class="fa fa-search"
                                    aria-hidden="true"></i></a></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/call/title-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Sistem Informasi dan Pelaporan Pencemaran Serta Kerusakan Lingkungan Hidup</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="about" class="about-area about-p pt-100 pb-160 p-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="about-content s-about-content">
                            <div class="about-title second-atitle">
                                <h2>Dinas Lingkungan Hidup Kota Manado</h2>
                            </div>
                            <p>Dinas Lingkungan Hidup Kota Manado siap menerima laporan terkait pencemaran dan kerusakan
                                lingkungan dan
                                memastikan tindak lanjut yang cepat dan tepat.</p>
                            <p>Dinas Lingkungan Hidup Kota Manado berkomitmen untuk menjaga kebersihan dan kelestarian
                                lingkungan dengan menyediakan sistem pelaporan yang mudah diakses oleh masyarakat. Melalui
                                platform digital ini, warga dapat melaporkan berbagai isu kerusakan atau pencemaran
                                lingkungan secara cepat, transparan, dan aman. Setiap laporan yang masuk akan segera
                                ditindaklanjuti oleh tim terkait untuk memastikan penanganan yang tepat dan efektif.</p>

                            <ul class="ab-coutner">
                                {{-- Counter akan ditambahkan di sini jika ada data --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 pl-50 pr-30">
                        <div class="s-about-img p-relative">
                            <img src="{{ asset('assets/public/img/features/about_img.jpg') }}" alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="call-area pt-95 pb-85"
            style="background-image:url('{{ asset('assets/public/img/testimonial/test-bg.jpg') }}'); background-repeat: no-repeat; background-position: center; background-size: cover;">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h2><span class="text-white"> Laporkan Masalah Lingkungan di Kota Manado</span></h2>
                        <p>Jika Anda menemukan permasalahan lingkungan, silakan laporkan agar segera ditindaklanjuti oleh
                            Dinas Lingkungan Hidup Kota Manado.</p>
                        <a href="{{ route('public.complaint') }}" class="btn ss-btn mt-3">Laporkan Sekarang</a><br><br>
                        <b class="text-white mb-0 pb-0"><a class="text-white"
                                href="{{ route('public.complaint.status.index') }}" class="mt-3">Lihat
                                Laporan
                                Masuk</a></b>
                    </div>
                </div>
            </div>
        </div>
        <section id="blog" class="blog-area p-relative pt-95 pb-150 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-10">
                        <div class="section-title text-center mb-80">
                            <h2>Informasi</h2>
                            <img src="{{ asset('assets/public/img/bg/t-c-line.png') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse($informations as $information)
                        <div class="col-lg-4 col-md-12">
                            <div class="single-post mb-30">
                                <div class="blog-thumb">
                                    <a href="{{ route('public.information.detail', $information->slug) }}">
                                        <img src="{{ Storage::url($information->thumbnail) }}"
                                            alt="{{ $information->title }}">
                                    </a>
                                    <div class="b-meta bg-danger">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <i class="far fa-calendar-alt"></i>
                                                {{ \Carbon\Carbon::parse($information->created_at)->translatedFormat('d F, Y') }}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="blog-content text-center">
                                    <h4><a
                                            href="{{ route('public.information.detail', $information->slug) }}">{{ $information->title }}</a>
                                    </h4>
                                    <p>{{ Str::limit(strip_tags($information->content), 100) }}</p>
                                    <div class="blog-btn"><a
                                            href="{{ route('public.information.detail', $information->slug) }}">Selengkapnya<i
                                                class="fas fa-chevron-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>Tidak ada informasi terbaru saat ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>



    </main>
@endsection
