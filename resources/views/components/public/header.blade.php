<header id="masthead" class="site-header header-primary">
    {{-- Top Header --}}
    <div class="top-header">
        <div class="container">
            <div class="row">
                {{-- Kontak Kiri --}}
                <div class="col-lg-8 d-none d-lg-block">
                    <ul class="header-contact-info">
                        <li><a href="#"><i class="fas fa-phone-alt"></i> +01 (977) 2599 12</a></li>
                        <li><a href="mailto:info@domain.com"><i class="fas fa-envelope"></i> company@domain.com</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> 3146 Koontz Lane, California</li>
                    </ul>
                </div>

                {{-- Sosmed & Search --}}
                <div class="col-lg-4 d-flex justify-content-lg-end justify-content-between">
                    <div class="header-social social-links">
                        <ul>
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="header-search-icon">
                        <button class="search-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Header --}}
    <div class="bottom-header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="site-identity">
                <h1 class="site-title">
                    <a href="{{ url('/') }}">
                        <img class="white-logo" src="{{ asset('assets/public/images/travele-logo.png') }}"
                            alt="logo">
                        <img class="black-logo" src="{{ asset('assets/public/images/travele-logo1.png') }}"
                            alt="logo">
                    </a>
                </h1>
            </div>
            {{-- Navigation --}}
            <div class="main-navigation d-none d-lg-block">
                <nav id="navigation" class="navigation">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="#">Tour</a></li>
                        <li><a href="#">Pages</a></li>
                        <li><a href="#">Shop</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Dashboard</a></li>
                    </ul>
                </nav>
            </div>
            <div class="header-btn">
                <a href="#" class="button-primary">BOOK NOW</a>
            </div>
        </div>
    </div>
    <div class="mobile-menu-container"></div>
</header>
