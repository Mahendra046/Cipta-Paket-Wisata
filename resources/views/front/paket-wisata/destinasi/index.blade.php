@extends('front.paket-wisata.base')
@section('title', 'Paket | Destinasi')
@section('label', ' Destinasi')
@section('content')

    @if (auth()->user()->foto != null)
        <div class="row mt-2">
            <div class="col-lg-12 col-md-6 col-sm-4 pb-5">
                <div class="card">
                    <div class="card-body">
                        <a href="{{url('paket-destinasi/create')}}" class="btn btn-dark float-end" style="color:#ffffff;  font-weight:600;">tambah destinasi</a>
                        <h3>Data Destinasi</h3>
                        <br>
                        <div class="row">
                            @foreach ($list_destinasi as $destinasi)
                                <div class="col-lg-4 col-md-6 align-self-center mb-30 event_outer">
                                    <div class="events_item">
                                        <div class="thumb" style="height: 200px; overflow: hidden;">
                                            <a href="{{ url('paket-destinasi', $destinasi->id) }}">
                                                <img src="{{ url("$destinasi->foto") }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;" alt="">
                                            </a>
                                        </div>
                                        <div class="down-content">
                                            <span class="author">{{ $destinasi->nama_destinasi }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            {{-- <div class="col-lg-4 col-md-6 col-sm-4 pb-5">
                <div class="card">
                    <div class="card-body pb-5">
                        <center>
                            <br>
                            <h1>Destinasi Anda</h1>
                            <br>
                            <p>silahkan pergi ke menu Paket Wisata untuk membuat Paket anda!</p>
                            <a href="{{ url('paket-wisata') }}"><button class="btn btn-dark">paket wisata</button></a>
                        </center>
                    </div>
                </div>
            </div> --}}

        </div>
    @else
        <div class="row" style="padding-bottom: 20%;">
            <div class="col-lg-12 col-md-6 col-sm-4 pb-5">
                <div class="card">
                    <div class="card-body pb-5">
                        <center>
                            <h1>Lengkapi Profil Terlebih Dahulu</h1>
                            <br>
                            <p>silahkan pergi ke menu profil untuk melengkapi profil anda!</p>
                            <a href="{{ url('profil') }}"><button class="btn btn-dark">profil</button></a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

<style>
    .event_outer .events_item .category {

        background-color: rgba(15, 15, 15, 0.5);
        color: white;
        transition: background-color 0.3s ease;
    }

    .event_outer .events_item .category:hover {
        background-color: rgba(0, 0, 0, 0.7);
        color: #ffffff;
    }

    .events_outer {
        height: 600px;
        /* Sesuaikan ketinggian sesuai kebutuhan */
        overflow-y: auto;
        /* Mengaktifkan scroll */
    }
</style>
