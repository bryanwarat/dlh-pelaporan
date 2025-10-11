@extends('layouts.public.app')

@section('title', 'Informasi')

@section('content')
    <main>
        <section class="breadcrumb-area d-flex align-items-center"
            style="background-image:url('{{ asset('assets/public/img/call/title-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>Informasi</h2>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="inner-blog b-details-p pt-100 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-details-wrap">
                            @forelse($informations as $information)
                                <div class="bsingle__post mb-50">
                                    <div class="bsingle__post-thumb">
                                        <img src="{{ Storage::url($information->thumbnail) }}"
                                            alt="{{ $information->title }}">
                                    </div>
                                    <div class="bsingle__content">
                                        <div class="meta-info">
                                            <ul>

                                                <li><i
                                                        class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($information->created_at)->translatedFormat('d F, Y') }}
                                                </li>
                                            </ul>
                                        </div>
                                        <h2><a
                                                href="{{ route('public.information.detail', $information->slug) }}">{{ $information->title }}</a>
                                        </h2>
                                        <p>{{ Str::limit(strip_tags($information->content), 200) }}</p>
                                        <div class="slider-btn">
                                            <a href="{{ route('public.information.detail', $information->slug) }}"
                                                class="btn ss-btn" data-animation="fadeInRight" data-delay=".8s">Read
                                                More</a>
                                            <div class="btn-after" data-animation="fadeInRight" data-delay=".8s"></div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center">
                                    <p>Tidak ada informasi terbaru saat ini.</p>
                                </div>
                            @endforelse
                            {{-- Tambahkan pagination jika diperlukan --}}
                            <div class="pagination-wrap mb-50">
                                <nav>
                                    {{-- {{ $informations->links() }} --}}
                                </nav>
                            </div>
                        </div>
                    </div>

                    {{-- Sidebar --}}
                    <div class="col-lg-4">

                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
