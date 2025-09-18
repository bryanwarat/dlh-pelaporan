<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.admin.meta')
</head>

<body data-menu-color="light" data-sidebar="default">

    <div id="app-layout">

        {{-- Header --}}
        @include('components.admin.header')

        {{-- Sidebar --}}
        @include('components.admin.sidebar')

        {{-- Konten Halaman --}}
        <div class="content-page">
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>

            {{-- Footer --}}
            @include('components.admin.footer')
        </div>
    </div>

    {{-- Script JS --}}
    @include('components.admin.scripts')
    @stack('scripts')
</body>

</html>
