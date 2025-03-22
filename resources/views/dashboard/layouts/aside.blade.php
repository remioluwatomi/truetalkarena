<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link gap-2">
            <span class=" demo" style="display:flex; align-items:center;justify-content: center;width:100%">
                <img src="/images/logo/logo.png" alt="logo" style="width: 50%">
            </span>
            {{-- <span class="app-brand-text demo text-body fw-bolder">
            <img src="/assets/img/01.png" alt="" width="50%"></span> --}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item @if (request()->is('admin') || request()->is('admin/dashboard')) active @endif">
            <a href="/admin/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Pages</span>
        </li>
        <li class="menu-item @if (request()->is('admin/profile') || request()->is('admin/settings')) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/profile')) active @endif">
                    <a href="/admin/profile" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>
                @if ($admin['admin'] <= 2)
                    <li class="menu-item @if (request()->is('admin/settings')) active @endif">
                        <a href="/admin/settings" class="menu-link">
                            <div data-i18n="Settings">Settings</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
        <li class="menu-item @if (request()->is('admin/blog') ||
            request()->is('admin/videos') ||
            request()->is('admin/gallery') ||
            request()->is('admin/adverts')) active open @endif">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-box"></i>
                <div data-i18n="Posts">Posts</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item @if (request()->is('admin/blog')) active @endif">
                    <a href="/admin/blog" class="menu-link">
                        <div data-i18n="Blog">Blog</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/videos')) active @endif">
                    <a href="/admin/videos" class="menu-link">
                        <div data-i18n="Videos">Videos</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/gallery')) active @endif">
                    <a href="/admin/gallery" class="menu-link">
                        <div data-i18n="Gallery">Gallery</div>
                    </a>
                </li>
                <li class="menu-item @if (request()->is('admin/adverts')) active @endif">
                    <a href="/admin/adverts" class="menu-link">
                        <div data-i18n="Adverts">Adverts</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item @if (request()->is('admin/books')) active @endif">
            <a href="/admin/books" class="menu-link">
                <i class="menu-icon tf-icons bx bx-book"></i>
                <div data-i18n="Books">Books</div>
            </a>
        </li>

        @if ($admin['adm_level'] <= 2)
            <li class="menu-item @if (request()->is('admin/admins')) active @endif">
                <a href="/admin/admins" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-collection"></i>
                    <div data-i18n="Admins">Admins</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
