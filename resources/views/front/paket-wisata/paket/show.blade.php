<x-front>

    @section('title', 'Detail Paket')
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
            /* Ensure content is above the overlay */
        }

        .card-title {
            margin-bottom: 10px;
            /* Mengurangi jarak bawah dari judul */
        }

        .ql-editor {
            margin-top: -3rem;
            margin-bottom: -2rem;
            /* Menghilangkan padding atas dari daftar aktivitas */
        }
    </style>

    <div class="container mt-5 pt-5">
        <!-- Header Image and Title -->
        <div class="row justify-content-center pt-5">
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
                        <p class="text-white fw-medium">Durasi: {{ $paket->durasi }}</p>
                        <p class="text-white fw-medium" id="paketInfo"
                            data-jumlah-peserta="{{ $paket->jumlah_peserta }}">
                            Jumlah Peserta: min {{ $paket->jumlah_peserta }} orang</p>
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
        <!-- Package Details -->
        @if ($paket->fasilitas->isNotEmpty() && $paket->aktifitas != null)
        <div class="row justify-content-center">
            <div class="col-md-12 bootstrap4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title">Aktivitas Paket</h3>
                        <div class="ql-editor">
                            {!! $paket->aktifitas->daftar_aktifitas !!}
                        </div>
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
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $item->nama_fasilitas }}</h6>
                                            <p class="card-text">{{ $item->deskripsi_fasilitas }}</p>
                                            <p class="card-text"><strong>Jumlah:</strong> {{ $item->jumlah }}
                                                {{ $item->satuan }}</p>
                                            <p class="card-text"><strong>Harga Satuan:</strong> Rp
                                                {{ number_format($item->harga_satuan, 2) }}</p>
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
                                <h6>Harga Paket: Rp {{ number_format($totalHarga, 2) }}</h4>
                            </div>
                            <div class="col-md-3 mb-4">
                                <h6>Harga Per Orang: Rp {{ number_format($harga_per_orang, 2) }}</h6>
                            </div>
                            <div class="col-md-3 mb-4">
                                <h6>Peserta: {{$paket->jumlah_peserta}} Orang</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title text-center">Profil Penyelenggara</h3>
                        <div class="row align-items-center mt-3">
                            @php
                                $fotoPenyelenggara = $paket->user->foto;
                            @endphp
                            <div class="col-md-2 text-center">
                                <img src="{{ url("public/$fotoPenyelenggara") }}" class="img-fluid rounded-circle mb-3" alt="Profil Penyelenggara" style="width: 120px; height: 120px; object-fit: cover; border: 2px solid #ddd; padding: 5px;">
                            </div>
                            <div class="col-md-5">
                                <ul class="list-unstyled fs-6 p-2">
                                    <li><strong>Nama Penyelenggara:</strong> {{ $paket->user->name }}</li>
                                    <li><strong>No WhatsApp:</strong> <a href="https://wa.me/{{ $paket->user->no_wa }}" target="_blank">{{ $paket->user->no_wa }}</a></li>
                                    <li><strong>Instagram:</strong> <a href="https://instagram.com/{{ $paket->user->instagram }}" target="_blank">{{ '@' . $paket->user->instagram }}</a></li>
                                    <li><strong>Facebook:</strong> <a href="https://facebook.com/{{ $paket->user->facebook }}" target="_blank">{{ $paket->user->facebook }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</x-front>
