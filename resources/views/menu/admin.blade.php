<li class="nav-item {{ request()->is('superuser/master-data/*') ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ request()->is('superuser/master-data/*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>
            Master Data
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <x-layout-app.menu.menu-item icon="circle" title="Users" url="superuser/master-data/user" />
        <x-layout-app.menu.menu-item icon="circle" title="Admin" url="superuser/master-data/admin" />
    </ul>
</li>
<x-layout-app.menu.menu-single icon="th" title="Paket Wisata" url="superuser/paket-wisata" />
