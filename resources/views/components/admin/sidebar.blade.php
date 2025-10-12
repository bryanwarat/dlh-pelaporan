<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>
        <div id="sidebar-menu">
            <div class="logo-box">
                <div class="logo-box">
                    <a href="{{ route('admin.dashboard.index') }}" class="logo logo-light">
                        <img src="{{ asset('assets/public/img/logo/logo-admin.png') }}" alt="logo">

                    </a>
                    <a href="{{ route('admin.dashboard.index') }}" class="logo logo-dark">
                        <img src="{{ asset('assets/public/img/logo/logo-admin.png') }}" alt="logo">
                    </a>

                </div>
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
                        <span>Informasi</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.complaint.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.complaint.*') ? 'active' : '' }}"
                        href="{{ route('admin.complaint.index') }}">
                        <i data-feather="file-text"></i>
                        <span>Pelaporan</span>
                    </a>
                </li>
            </ul>

            <ul id="side-menu">
                <li class="menu-title">Konfigurasi</li>



                <li class="{{ request()->routeIs('admin.complaint.category.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.complaint.category.*') ? 'active' : '' }}"
                        href="{{ route('admin.complaint.category.index') }}">
                        <i data-feather="file"></i>
                        <span>Kategori Pelaporan</span>
                    </a>
                </li>

                <li class="{{ request()->routeIs('admin.users.*') ? 'menuitem-active' : '' }}">
                    <a class="tp-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                        href="{{ route('admin.users.index') }}">
                        <i data-feather="users"></i>
                        <span>User</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
