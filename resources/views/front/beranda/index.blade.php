<x-front>
    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-banner">
                        <div class="item"
                            style="background-image: url({{ url('public/scholar') }}/assets/images/Cempedak.jpeg);">
                            <div class="header-text">
                                <span class="category">Fungsi Cipta Paket Wisata</span>
                                <h2>Tujuan CPW</h2>
                                <p>Kami menyediakan sebuah platform untuk membantu pengguna dalam
                                    menyusun sebuah paket wisata yang berstandar pegiat pariwisata</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        ul.list-unstyled {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        ul.list-unstyled li {
            display: flex;
            align-items: flex-start;
        }

        ul.list-unstyled li i.icon {
            font-size: 3rem;
            margin-right: 1rem;
            min-width: 4rem;
            text-align: center;
        }

        ul.list-unstyled li div {
            display: flex;
            flex-direction: column;
        }

        ul.list-unstyled li div h5 {
            margin-bottom: 0.5rem;
        }

        ul.list-unstyled li div p {
            margin: 0;
        }
    </style>
    <div class="services section" id="services">
        <div class="container">
            <center>
                <div class="row p-4">
                    <div class=" card col-lg-5 ms-5 me-5 mb-3 col-sm-6">
                        <div class="card-body">
                            <h4>Daftar dan Buat Paket Sekarang</h4>
                            <p>Daftar sekarang dan nikmati fitur lengkap untuk membuat paket wisata sesuai keinginan
                                Anda.
                            </p>
                            <a href="{{ url('auth/redirect') }}" class="btn btn-dark">Daftar Sekarang</a>
                        </div>

                    </div>
                    <div class=" card col-lg-5 mb-3 col-sm-6 float-end">
                        <div class="card-body">
                            <h4>Membuat Paket (Sebagai Tamu)</h4>
                            <p>Memilih destinasi yang ingin anda promosikan.</p>
                            <a href="{{ url('paket-destinasi') }}" class="btn btn-dark">Buat Paket Cepat</a>
                        </div>

                    </div>
                </div>

            </center>
        </div>
    </div>

    <section class="section courses" id="courses">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Paket Wisata</h6>
                        <h2>Contoh Paket Wisata</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($list_paket as $paket)
                    <div class="col-lg-4 col-md-6 mb-30 event_outer design">
                        <div class="events_item">
                            <div class="thumb">
                                <a href="{{route('show.paket', $paket->id)}}"><img src="{{ url("public/$paket->foto") }}" alt=""></a>
                            </div>
                            <div class="down-content">
                                <span class="author">{{ $paket->destinasi->nama_destinasi }}</span>
                                <h4 class="title">{{ $paket->nama_paket_wisata }}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </section>

</x-front>
<style>

    .thumb {
        width: 100%;
        height: 200px;
        /* Set a fixed height */
        overflow: hidden;
        /* Hide overflow */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Ensure the image covers the entire container */
    }

    .down-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .title {
        min-height: 3em;
        /* Set a minimum height for the title */
        display: flex;
        align-items: center;
    }

    .author {
        display: block;
        margin-bottom: 10px;
    }

    .mb-30 {
        margin-bottom: 30px;
    }
</style>
