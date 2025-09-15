<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.meta')
</head>

<body data-menu-color="light" data-sidebar="default">

    <div id="app-layout">

        {{-- Header --}}
        @include('components.header')

        {{-- Sidebar --}}
        @include('components.sidebar')

        {{-- Konten Halaman --}}
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('components.footer')
        </div>
    </div>

    {{-- Script JS --}}
    @include('components.scripts')
    @stack('scripts')
</body>

</html>
