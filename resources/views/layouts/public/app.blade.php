<!doctype html>
<html lang="en">

<head>
    {{-- Meta & Title --}}
    @include('components.public.meta')
    <title>@yield('title', 'Laravel Template')</title>

    {{-- CSS --}}
    <link rel="icon" type="image/png" href="{{ asset('assets/public/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/modal-video/modal-video.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/lightbox/dist/css/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/public/css/style.css') }}">
    @stack('styles')
</head>

<body class="@yield('body-class', 'home')">



    <div id="page" class="full-page">

        {{-- Header --}}
        @include('components.public.header')

        {{-- Content --}}
        <main id="content" class="site-main">
            @yield('content')
        </main>

        {{-- Footer --}}
        @include('components.public.footer')
    </div>

    {{-- Back To Top --}}
    <a id="backTotop" href="#" class="to-top-icon">
        <i class="fas fa-chevron-up"></i>
    </a>

    {{-- Search Form --}}
    <div class="header-search-form">
        <div class="container">
            <div class="header-search-container">
                <form class="search-form" role="search" method="get">
                    <input type="text" name="s" placeholder="Enter your text...">
                </form>
                <a href="#" class="search-close"><i class="fas fa-times"></i></a>
            </div>
        </div>
    </div>

    {{-- Script --}}
    @include('components.public.scripts')
    @stack('scripts')
</body>

</html>
