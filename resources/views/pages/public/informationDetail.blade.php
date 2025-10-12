@extends('layouts.public.app')

@section('title', $information->title . ' - SiPerkasah')
@section('meta_description', $information->title . ' - SiPerkasah')

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
            style="background-image:url('{{ asset('assets/public/img/testimonial/test-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="breadcrumb-wrap text-center">
                            <div class="breadcrumb-title mb-30">
                                <h2>{{ $information->title }}</h2>
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
                            <div class="bsingle__post-thumb mb-30">
                                <img src="{{ Storage::url($information->thumbnail) }}" alt="{{ $information->title }}">
                            </div>
                            <div class="meta__info">
                                <ul>

                                    <li><i
                                            class="far fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($information->created_at)->translatedFormat('d F, Y') }}
                                    </li>
                                    {{-- Kolom komentar bisa ditambahkan jika ada di tabel --}}
                                    {{-- <li><i class="far fa-comments"></i>35 Comments</li> --}}
                                </ul>
                            </div>
                            <div class="details__content pb-50">
                                <h2>{{ $information->title }}</h2>
                                <p>{!! $information->content !!}</p>
                            </div>


                        </div>
                    </div>
                    <div class="col-lg-4">
                        <aside>
                            <div class="widget mb-40">
                                <div class="widget-title text-center">
                                    <h4>Terbaru</h4>
                                </div>
                                <div class="widget__post">
                                    <ul>
                                        @forelse ($latestNews as $item)
                                            <li>
                                                <div class="widget__post-thumb">
                                                    <img src="{{ Storage::url($item->thumbnail) }}" style="max-width: 100px"
                                                        alt="{{ $item->title }}">
                                                </div>
                                                <div class="widget__post-content">
                                                    <h6><a
                                                            href="{{ route('public.information.detail', $item->slug) }}">{{ Str::limit($item->title, 35) }}</a>
                                                    </h6>
                                                    <span><i
                                                            class="far fa-clock"></i>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                                </div>
                                            </li>
                                        @empty
                                            <li>Tidak ada berita terbaru.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
