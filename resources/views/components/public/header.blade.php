<header class="header-area">
    {{-- <div class="header-top second-header d-none d-md-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-8 d-none d-md-block">
                    <div class="header-cta">
                        <ul>
                            <li><i class="icon dripicons-mail"></i> <span>info@example.com</span></li>
                            <li><i class="icon far fa-clock"></i> <span>Mon - Sat 8:00 - 18:00</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 d-none d-lg-block">
                    <div class="header-social text-right">
                        <span>
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </span>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 d-none d-md-block">
                    <a href="" class="top-btn">Layanan</a>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- Menu utama --}}
    <div id="header-sticky" class="menu-area">
        <div class="container">
            <div class="second-menu">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ asset('assets/public/img/logo/logo.png') }}" alt="logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="responsive">
                            <i class="icon dripicons-align-right"></i>
                        </div>
                        <div class="main-menu text-right text-xl-right">
                            <nav id="mobile-menu">
                                <ul>
                                    <li><a href="{{ url('/') }}">Home</a></li>

                                    <li><a href="{{ route('public.complaint') }}">Lapor</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 text-right">
                        {{-- optional button --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
