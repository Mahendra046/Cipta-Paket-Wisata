
  <x-layout-app.menu.menu-single icon="home" title="Dashboard" url="user/dashboard"/>
  <li class="nav-item {{ request()->is('user/paket') ? 'menu-open' : '' }} {{ request()->is('user/destinasi') ? 'menu-open' : '' }}
    @yield('menu-item')
    ">
    <a href="#" class="nav-link {{ request()->is('user/paket') ? '' : '' }}{{ request()->is('user/destinasi') ? '' : '' }}">
        <i class="nav-icon fas fa-edit"></i>
        <p>
            Paket Wisata
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
      <x-layout-app.menu.menu-single icon="fa-circle" title="1. Destinasi" url="user/destinasi"/>
      <x-layout-app.menu.menu-single icon="fa-circle" title="2. Paket Wisata" url="user/paket"/>
      {{-- <x-layout-app.menu.menu-single icon="fa-circle" title="3. Aktifitas & Fasilitas" url="user/fasilitas"/> --}}
  </ul>
</li>
  {{-- <x-layout-app.menu.menu-single icon="location-arrow" title="Rencana Perjalanan" url="user/rencana-perjalanan"/>
  <x-layout-app.menu.menu-single icon="angle-double-up" title="Export" url="user/export"/> --}}