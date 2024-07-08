<style>
    .event_filter a {
        font-weight: bold;
        color: #80878a !important;
        /* Atur warna sesuai dengan kebutuhan Anda */
    }

    /* Tambahan style untuk menyembunyikan elemen event_box secara default */
    .event_filter a.is_active {
        font-weight: bold;
    }

    /* Tambahan style untuk link yang aktif */
    .event_filter a.active {
        font-weight: bold;
        color: #ffffff !important;
        /* Atur warna sesuai dengan kebutuhan Anda */
    }

    .event_filter {
        background-color: black !important;
    }

    .courses {
        margin-top: 5% !important;
    }
    .courses h2{
        margin-bottom: -4% !important;
    }
    .menu-container {
        margin-bottom: -4em !important;
    }
</style>

<x-front>
    <section class="section courses" id="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6></h6>
                        <h2>Buat Paket Wisata</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="menu-container">
                    
                </div>
            </div>

            @yield('content')
        </div>

    </section>
</x-front>
