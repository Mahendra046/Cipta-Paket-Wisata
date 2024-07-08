<header class="header-area header-sticky background-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <nav class="main-nav d-flex justify-content-between align-items-center">
                    <!-- ***** Logo Start ***** -->
                    <a href="#" class="logo">
                        <h6 class="text-light">Cipta Paket Wisata</h6>
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="{{ url('beranda') }}"
                                class="{{ request()->is('beranda') ? 'active' : '' }}">Beranda</a>
                        </li>

                        @if (Auth::check())
                            <li class="scroll-to-section">
                                <a href="{{ url('user/paket') }}"
                                    class="{{ request()->is('paket-wisata') || request()->is('paket-destinasi') ? 'active' : '' }}
                                @yield('status')
                                ">Buat
                                    Paket Wisata</a>
                            </li>
                            <li class="scroll-to-section profile-menu position-relative">
                                <a href="#"
                                    class="d-flex align-items-center dropdown-toggle {{ request()->is('user/profil') ? 'active' : '' }}"
                                    id="profileDropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                    @if (Auth::user()->foto != null)
                                        <img src="{{ asset('public/' . auth()->user()->foto) }}" alt="Profile"
                                            class="rounded-circle"
                                            style="width: 30px; height: 30px; margin-left: 10px;">
                                    @else
                                        <img src="{{ url('scholar/assets/images/user.jpg') }}" alt="Profile"
                                            class="rounded-circle"
                                            style="width: 30px; height: 30px; margin-left: 10px;">
                                    @endif
                                </a>
                                <div class="dropdown-menu" aria-labelledby="profileDropdown">
                                    <a class="dropdown-item" href="{{ url('profil') }}"
                                        onclick="event.preventDefault(); document.getElementById('profil-form').submit();">Profil</a>
                                    <a class="dropdown-item" href="{{ url('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ url('logout') }}" method="GET"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                    <form id="profil-form" action="{{ url('profil') }}" method="GET"
                                        style="display: none;"></form>
                                </div>
                            </li>
                        @else
                            <li class="scroll-to-section">
                                <a href="{{ url('paket-destinasi') }}"
                                    class="{{ request()->is('paket-wisata') || request()->is('paket-destinasi') ? 'active' : '' }}
                                @yield('status')
                                ">Buat
                                    Paket Wisata</a>
                            </li>
                            <li class="scroll-to-section">
                                <a href="{{ url('auth/redirect') }}">Login</a>
                            </li>
                        @endif
                    </ul>
                    <a class="menu-trigger">
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>

<div class="header-text">
    <!-- Placeholder for header text content -->
</div>

<style>
    .header-area {
        position: absolute;
        background-color: transparent;
        top: 40px;
        left: 0;
        right: 0;
        z-index: 100;
        transition: all .5s ease 0s;
    }

    .header-area .main-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-area .main-nav .logo {
        display: inline-block;
    }

    .header-area .main-nav .logo h1 {
        font-size: 36px;
        text-transform: uppercase;
        color: #fff;
        font-weight: 600;
    }

    .header-area .main-nav .nav {
        display: flex;
        align-items: center;
    }

    .header-area .main-nav .nav li {
        padding-left: 5px;
        padding-right: 5px;
        height: 40px;
        line-height: 40px;
        position: relative;
    }

    .header-area .main-nav .nav li a {
        display: block;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 20px;
        font-weight: 300;
        font-size: 14px;
        height: 40px;
        line-height: 40px;
        text-transform: capitalize;
        color: #fff;
        transition: all 0.4s ease 0s;
        border: transparent;
        letter-spacing: .25px;
    }

    .header-area .main-nav .nav li .dropdown-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: rgba(0, 0, 0, 0.8);
        border-radius: 5px;
        overflow: hidden;
        z-index: 1000;
    }

    .header-area .main-nav .nav li .dropdown-menu a {
        color: #fff;
        padding: 0px 20px;
        display: block;
        white-space: nowrap;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .header-area .main-nav .nav li .dropdown-menu a:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .header-area .main-nav .nav li:hover .dropdown-menu {
        display: block;
    }

    .header-area .main-nav .menu-trigger {
        display: none;
        cursor: pointer;
        position: absolute;
        right: 20px;
    }

    @media (max-width: 991px) {
        .header-area .main-nav .nav {
            display: none;
            flex-direction: column;
            background: rgba(0, 0, 0, 0.8);
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 999;
        }

        .header-area .main-nav .nav.show {
            display: flex;
        }

        .header-area .main-nav .menu-trigger {
            display: block;
            color: #fff;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuTrigger = document.querySelector('.menu-trigger');
        var nav = document.querySelector('.main-nav ul.nav');

        // Handle menu trigger for mobile view
        menuTrigger.addEventListener('click', function() {
            this.classList.toggle('is-clicked');
            nav.classList.toggle('show');
        });

        // Handle click on profile menu to toggle dropdown
        var profileMenu = document.querySelector('.profile-menu');
        var dropdownMenu = document.querySelector('.profile-menu .dropdown-menu');

        profileMenu.addEventListener('click', function(event) {
            event.preventDefault();
            dropdownMenu.classList.toggle('show');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!profileMenu.contains(event.target) && !menuTrigger.contains(event.target)) {
                dropdownMenu.classList.remove('show');
                nav.classList.remove('show');
                menuTrigger.classList.remove('is-clicked');
            }
        });

        // Handle window resize to hide menu on larger screens
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                menuTrigger.classList.remove('is-clicked');
                nav.classList.remove('show');
                dropdownMenu.classList.remove('show');
            }
        });
    });
</script>
