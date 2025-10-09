@extends('layouts.public.app')

@section('title', 'Homepage')

@section('content')
    <main>

        <!-- search-popup -->
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
        <!-- /search-popup -->

        <!-- breadcrumb-area -->
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/testimonial/test-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Sistem Informasi dan Pelaporan Kerusakan Lingkungan Hidup</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb-area-end -->

        <!-- about-area -->
        <section id="about" class="about-area about-p pt-100 pb-160 p-relative">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="about-content s-about-content">
                            <div class="about-title second-atitle">
                                <h2>Dinas Lingkungan Hidup Kota Manado</h2>
                            </div>
                            <p>Dinas Lingkungan Hidup Kota Manado siap menerima laporan terkait kerusakan lingkungan dan
                                memastikan tindak lanjut yang cepat dan tepat.</p>
                            <p>Melalui sistem ini, masyarakat dapat dengan mudah melaporkan permasalahan lingkungan secara
                                transparan dan aman.</p>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda, libero ut placeat quasi,
                                tenetur aspernatur velit repellat blanditiis impedit officiis corporis, magnam aperiam. A
                                minima explicabo nemo! Officiis, possimus harum? Lorem ipsum dolor sit amet consectetur
                                adipisicing elit. Repellendus dolorem consequatur corrupti dolor minima voluptatem? Dolore
                                id quae eveniet, nisi eaque necessitatibus illo consectetur odio debitis? Aspernatur rem
                                laudantium sapiente?</p>
                            <ul class="ab-coutner">
                                {{-- <li>
                                    <div class="single-counter ">
                                        <div class="counter p-relative">
                                            <span class="count">879</span><small>+</small>
                                        </div>
                                        <p>Laporan Diterima</p>
                                    </div>
                                </li> --}}
                                {{-- <li>
                                    <div class="single-counter ">
                                        <div class="counter p-relative">
                                            <span class="count">9874</span><small>+</small>
                                        </div>
                                        <p>Masyarakat Terlayani</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-counter ">
                                        <div class="counter p-relative">
                                            <span class="count">50</span><small>+</small>
                                        </div>
                                        <p>Tahun Pengalaman</p>
                                    </div>
                                </li> --}}
                            </ul>
                            {{-- <div class="slider-btn mt-30">
                                <a href="{{ route('public.complaint') }}" class="btn ss-btn" data-animation="fadeInRight"
                                    data-delay=".8s">Laporkan Sekarang</a>
                                <div class="btn-after" data-animation="fadeInRight" data-delay=".8s"></div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12 pl-70">
                        <div class="s-about-img p-relative">
                            <img src="{{ asset('assets/public/img/features/about_img.png') }}" alt="img">
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- about-area-end -->

        <!-- call-to-action-area -->
        <div class="call-area pt-95 pb-85"
            style="background-image:url('{{ asset('assets/public/img/call/call-bg.png') }}'); background-repeat: no-repeat; background-position: center; background-size: cover;">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <h2><span> Laporkan Masalah Lingkungan di Kota Manado</span></h2>
                        <p>Jika Anda menemukan permasalahan lingkungan, silakan laporkan agar segera ditindaklanjuti oleh
                            Dinas Lingkungan Hidup Kota Manado.</p>
                        <a href="{{ route('public.complaint') }}" class="btn ss-btn mt-3">Laporkan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- call-to-action-area-end -->

        <!-- blog-area -->
        <section id="blog" class="blog-area  p-relative pt-95 pb-90 fix">
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

                    <!-- Berita 1 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="#"><img src="{{ asset('assets/public/img/blog/inner_b1.jpg') }}"
                                        alt="DLH Manado"></a>
                                <div class="b-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <i class="far fa-calendar-alt"></i> 15 September, 2025
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <i class="fas fa-user"></i> DLH Manado
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content text-center">
                                <h4><a href="#">Kegiatan Bersih Pantai di Kota Manado</a></h4>
                                <p>DLH Manado mengadakan kegiatan bersih pantai untuk menjaga kebersihan lingkungan pesisir
                                    dan meningkatkan kesadaran masyarakat.</p>
                                <div class="blog-btn"><a href="#">Read More<i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Berita 2 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="#"><img src="{{ asset('assets/public/img/blog/inner_b2.jpg') }}"
                                        alt="DLH Manado"></a>
                                <div class="b-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <i class="far fa-calendar-alt"></i> 10 September, 2025
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <i class="fas fa-user"></i> DLH Manado
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content text-center">
                                <h4><a href="#">Pengelolaan Sampah di Pasar Tradisional</a></h4>
                                <p>Tim DLH Manado melakukan pengelolaan sampah di pasar tradisional untuk mengurangi
                                    pencemaran dan meningkatkan kebersihan lingkungan.</p>
                                <div class="blog-btn"><a href="#">Read More<i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Berita 3 -->
                    <div class="col-lg-4 col-md-12">
                        <div class="single-post mb-30">
                            <div class="blog-thumb">
                                <a href="#"><img src="{{ asset('assets/public/img/blog/inner_b3.jpg') }}"
                                        alt="DLH Manado"></a>
                                <div class="b-meta">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <i class="far fa-calendar-alt"></i> 5 September, 2025
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <i class="fas fa-user"></i> DLH Manado
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-content text-center">
                                <h4><a href="#">Sosialisasi Pentingnya Penghijauan Kota</a></h4>
                                <p>DLH Manado mengajak masyarakat untuk melakukan penghijauan di lingkungan masing-masing
                                    sebagai upaya menjaga udara bersih dan sejuk.</p>
                                <div class="blog-btn"><a href="#">Read More<i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- blog-area-end -->

    </main>
    <!-- main-area-end -->
@endsection
