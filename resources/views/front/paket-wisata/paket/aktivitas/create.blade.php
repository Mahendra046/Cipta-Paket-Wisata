@extends('front.paket-wisata.base')

@section('title', 'Input Aktivitas')
@section('label', 'Detail Paket Wisata')
@section('status', ' active')
@section('content')
    <div class="container mt-5">
        <!-- Header Image and Title -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4" style="border-radius: 15px;">
                    @php
                        $fotoDestinasi = $paket->destinasi->foto;
                    @endphp
                    <div class="card-header text-white d-flex align-items-center justify-content-center text-center position-relative"
                        style="background-image: url('{{ url("public/$fotoDestinasi") }}'); background-size: cover; background-position: center; height: 250px; border-radius: 10px;">
                        <div class="overlay"></div>
                        <div class="content position-relative">
                            <h4 class="card-title" style="font-weight:500; font-size:2rem;">
                                {{ $paket->destinasi->nama_destinasi }}</h4>
                            <hr>
                            <p class="text-white">{{ $paket->destinasi->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Jumbotron -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="jumbotron p-5 mb-4 bg-light rounded-3 d-flex align-items-center justify-content-center text-center position-relative"
                    style="background-image: url('{{ url('public/' . $paket->foto) }}'); background-size: cover; background-position: center; height: 400px; border-radius: 10px; overflow: hidden;">
                    <div class="overlay"></div>
                    <div class="container-fluid py-5 position-relative">
                        <h5 class="display-5 fw-low text-white" style="font-size: 2rem">Paket
                            {{ $paket->nama_paket_wisata }}</h5>
                        <hr class="text-white">
                        <p class="fs-5 text-white text-left" style="font-style: normal; text-align: justify;">
                            {{ $paket->deskripsi }}</p>
                        <p class="text-white">Durasi: {{ $paket->durasi }}</p>
                        <p class="text-white">Jumlah Peserta: min {{ $paket->jumlah_peserta }} orang</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Details -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('paket.storeAktivitas', ['paket_wisata_id' => $paket->id]) }}" method="POST">
                    @csrf
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Input Aktivitas Paket</h3>
                            <div id="editor" class="quill-container"></div>
                            <input type="hidden" name="daftar_aktifitas" id="daftar_aktifitas">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark float-right">Simpan Aktivitas</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            var form = document.querySelector('form');
            form.addEventListener('submit', function() {
                var quillHtml = document.querySelector('.ql-editor').innerHTML;
                document.querySelector('#daftar_aktifitas').value = quillHtml;
            });
        </script>

        <!-- Organizer Details -->
        {{-- <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Penyelenggara</h3>
                        <p>Nama Penyelenggara: {{ $paket->nama_penyelenggara }}</p>
                        <p>No WhatsApp: {{ $paket->no_wa }}</p>
                        <p>Instagram: {{ $paket->instagram }}</p>
                        <p>Facebook: {{ $paket->facebook }}</p>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Action Button -->
        {{-- <div class="row justify-content-center">
            <div class="col-md-10 text-center">
            </div>
        </div> --}}
    </div>
@endsection

<style>
    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.384);
        z-index: 1;
        border-radius: 10px;
    }

    .position-relative {
        position: relative;
        z-index: 2;
    }

    .d-flex {
        display: flex;
    }

    .align-items-center {
        align-items: center;
    }

    .justify-content-center {
        justify-content: center;
    }

    .text-center {
        text-align: center;
    }

    .content {
        text-align: center;
        z-index: 2;
        /* Ensure content is above the overlay */
    }
</style>
