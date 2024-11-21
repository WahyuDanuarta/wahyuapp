<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Teknik Informatika | KSI</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">KSI</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('product') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.product') }}">
                    <i class="fas fa-box"></i>
                    <span>Produk</span></a>
            </li>
            <li class="{{ route::is('admin.distributor') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.distributor') }}">
                    <i class="fas fa-people-carry"></i>
                    <span>Distributor</span></a>
            </li>
            <li class="{{ Route::is('admin.flashsale') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.flashsale') }}">
                    <i class="fas fa-solid fa-tags"></i>
                    <span>Produk Flash Sale</span></a>
            </li>
            <li class="{{ Route::is('admin.user.index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.user.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Kelola Pengguna</span>
                </a>
            </li>
            <li class="{{ Request::is('admins*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <i class="fas fa-user-shield"></i>
                    <span>Admin</span>
                </a>
            <li class="{{ Request::is('history*') ? 'active' : '' }}">
                <a class="nav-link"href="{{ route('admin.history') }}">
                    <i class="fas fa-book"></i>
                    <span>Riwayat Pembelian</span></a></li>
                </a>
            </li>
        </ul>
    </aside>
</div>