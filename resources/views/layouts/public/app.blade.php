<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'SiPerkasah')</title>
    <meta name="description" content="@yield('meta_description', 'SiPerkasah - Sistem Informasi dan Pelaporan Pencemaran Serta Kerusakan Lingkungan Hidup')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Favicon --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/public/img/favicon.ico') }}">

    {{-- Styles --}}
    @include('components.public.styles')
    @stack('styles')
</head>

<body>

    {{-- Header --}}
    @include('components.public.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.public.footer')

    {{-- Scripts --}}
    @include('components.public.scripts')
    @stack('scripts')
</body>

</html>
