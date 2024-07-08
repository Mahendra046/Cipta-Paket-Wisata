<aside class="main-sidebar sidebar-dark-light elevation-4 position-fixed" style="background-color: #15779b;">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link" style="background-color: rgb(254, 254, 254); color:black;">
        <img src="{{ url('public/admin/login/img/cpw-logo.png') }}" alt="Cpw Logo" class="brand-image ml-3">
        @if (auth()->guard('user')->check())
            <span class="brand-text font-weight-bold ml-2" style="border:0; font-size: 1rem;">Cipta Paket Wisata</span>
        @elseif (auth()->guard('admin')->check())
            <span class="brand-text font-weight-bold ml-2" style="border:0;">Admin CPW</span>
        @endif
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar" style="border:0;">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                @if (auth()->guard('user')->check())
                <a href="{{ url('user/profil') }}" class="d-block">{{ auth()->user()->name }}</a>
                @elseif (auth()->guard('admin')->check())
                <a href="{{ url('admin/profil') }}" class="d-block">Admin</a>
                @endif
            </div>
        </div>
    
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @include('menu.' . $menu)
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    
    <!-- /.sidebar -->
</aside>
<style>
    .user-panel {
  border-bottom: 1px solid #dce0e4 !important;
}
</style>