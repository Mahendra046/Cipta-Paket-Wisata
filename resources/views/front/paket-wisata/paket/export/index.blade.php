@extends('front.paket-wisata.base')

@section('title', 'Paket Export')
@section('label', 'Detail Paket Wisata')
@section('status', ' active')
@section('content')
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
        }

        .card-title {
            margin-bottom: 10px;
        }

        .ql-editor {
            margin-top: -3rem;
            margin-bottom: -2rem;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .fasilitas-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                color: black !important;
            }
        }

        .justify-text {
            text-align: justify;
        }

        .card-penyelenggara ul {
            padding: 0;
            list-style: none;
            line-height: 1.6;
        }

        .card-penyelenggara ul li {
            margin-bottom: 8px;
        }

        .card-penyelenggara ul li strong {
            color: #333;
        }

        .card-penyelenggara ul li a {
            color: #1b79b8;
            text-decoration: none;
        }

        .card-penyelenggara ul li a:hover {
            text-decoration: underline;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <button onclick="captureAndSaveAsJPEG()" class="no-print btn btn-outline-dark float-right">Capture and Save as
                    JPEG</button>
                <button onclick="generatePDF()" class="no-print btn btn-outline-dark float-right">Unduh PDF</button>
            </div>
        </div>
    </div>
    <div class="container mt-5 pt-2 pb-2" id="content-to-export">
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
                            <h4 class="card-title" id="destinasi-name" style="font-weight:400; font-size:2rem;">
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
                        <dt class="text-white">Durasi</dt>
                        <p class="text-white fw-medium fs-5">{{ $paket->durasi }}</p>
                        <dt class="text-white">Jumlah Peserta</dt>
                        <p class="text-white fw-medium fs-5" id="paketInfo"
                            data-jumlah-peserta="{{ $paket->jumlah_peserta }}">
                            min {{ $paket->jumlah_peserta }} orang</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Package Details -->
        <div class="row justify-content-center">
            <div class="col-md-12 bootstrap4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Deskripsi</h3>
                        {{-- <div class="card card-deskripsi"> --}}
                        <p class="justify-text fs-6 p-1 pe-2 ps-2" style="font-style: normal;">
                            {{ $paket->deskripsi }}
                        </p>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 bootstrap4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Aktivitas Paket</h3>
                        <div class="ql-editor">
                            {!! $paket->aktifitas->daftar_aktifitas !!}
                        </div>
                        <input type="hidden" name="daftar_fasilitas" id="daftar_fasilitas" value="">
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12 bootstrap4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Fasilitas Paket</h3>
                        <div class="row">
                            @foreach ($paket->fasilitas as $index => $item)
                                <div class="col-md-6 mb-4">
                                    <div class="card fasilitas-card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $item->nama_fasilitas }}</h6>
                                            <p class="card-text">{{ $item->deskripsi_fasilitas }}</p>
                                            <p class="card-text"><strong>Jumlah:</strong> {{ $item->jumlah }}
                                                {{ $item->satuan }}</p>
                                        </div>
                                    </div>
                                </div>
                                @if (($index + 1) % 2 == 0)
                                    <div class="w-100"></div> <!-- Clear the row every two items -->
                                @endif
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h4>Harga Paket: Rp {{ number_format($totalHarga, 2) }}</h4>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h4>Harga Per Orang: Rp {{ number_format($harga_per_orang, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Informasi Penyelenggara Wisata</h3>
                        <div class="card-penyelenggara">
                            <ul class="list-unstyled fs-6 p-1 pe-2 ps-2">
                                <li><strong>Nama Penyelenggara:</strong> {{ $paket->nama_penyelenggara }}</li>
                                <li><strong>No WhatsApp:</strong> <a href="https://wa.me/{{ $paket->no_wa }}"
                                        target="_blank">{{ $paket->no_wa }}</a></li>
                                <li><strong>Instagram:</strong> <a href="https://instagram.com/{{ $paket->instagram }}"
                                        target="_blank">{{ '@' . $paket->instagram }}</a></li>
                                <li><strong>Facebook:</strong> <a href="https://facebook.com/{{ $paket->facebook }}"
                                        target="_blank">{{ $paket->facebook }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function generatePDF() {
        const element = document.getElementById('content-to-export');
        html2pdf().from(element).set({
            margin: [0, 0, 0, 0], // Margin diatur ke 0 karena kita menggunakan padding di CSS
            filename: 'document.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a2',
                orientation: 'portrait'
            }
        }).save();
    }

    function captureAndSaveAsJPEG() {
        const element = document.getElementById('content-to-export');
        const destinasiName = document.getElementById('destinasi-name').innerText;
        html2canvas(element, {
            scale: 2
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/jpeg');
            const link = document.createElement('a');
            link.download = `${destinasiName}.jpg`;
            link.href = imgData;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }
</script>
