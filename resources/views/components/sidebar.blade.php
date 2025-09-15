<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="24">
                    </span>
                </a>
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="24">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li class="menu-title">Menu</li>
                <li><a href="{{ route('admin.dashboard.index') }}"><i data-feather="home"></i><span>Dashboard</span></a>
                </li>
                <li><a href="{{ route('admin.news.index') }}"><i data-feather="file"></i><span>Berita</span></a>
                </li>
                <li><a href="{{ route('admin.complaint.index') }}"><i
                            data-feather="file-text"></i><span>Pengaduan</span></a>
                </li>
            </ul>

            <ul id="side-menu">
                <li class="menu-title">Konfigurasi</li>
                <li><a href="{{ route('admin.dashboard.index') }}"><i data-feather="file"></i><span>Kategori
                            Pengaduan</span></a>
                </li>

            </ul>
        </div>
    </div>
</div>
