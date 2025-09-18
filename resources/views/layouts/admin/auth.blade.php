<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.admin.meta')
</head>

<body>
    <!-- Begin page -->
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0 px-3 py-3 vh-100">
                {{-- Konten login --}}
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END wrapper -->

    {{-- Script JS --}}
    @include('components.admin.scripts')
    @stack('scripts')
</body>

</html>
