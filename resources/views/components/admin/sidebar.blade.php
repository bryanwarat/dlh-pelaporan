<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <div class="logo-box">
                {{-- <a href="{{ url('/') }}" class="logo logo-light">
                    SI ALPHA

                </a> --}}
                {{-- <a href="{{ url('/') }}" class="logo logo-dark">
                    SI ALPHA
                </a> --}}
                <h1>SIPERKASAH</h1>
            </div>

            <ul id="side-menu">
                <li class="menu-title">Menu</li>

                <li class="{{ request()->routeIs('admin.dashboard.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard.index') }}">
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.news.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}"
                        href="{{ route('admin.news.index') }}">
                        <i data-feather="file"></i>
                        <span>Berita</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.complaint.index') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.complaint.*') ? 'active' : '' }}"
                        href="{{ route('admin.complaint.index') }}">
                        <i data-feather="file-text"></i>
                        <span>Pengaduan</span>
                    </a>
                </li>
            </ul>

            <ul id="side-menu">
                <li class="menu-title">Konfigurasi</li>

                <li class="{{ request()->routeIs('admin.complaint.category.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.complaint.category.*') ? 'active' : '' }}"
                        href="{{ route('admin.complaint.category.index') }}">
                        <i data-feather="file"></i>
                        <span>Kategori Pengaduan</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
