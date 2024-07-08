@extends('front.paket-wisata.base')

@section('title', 'Paket | Buat Paket')
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
    </style>

    <div class="container mt-5">
        <!-- Header Image and Title -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4" style="border-radius: 15px;">
                    <div class="card-header text-white d-flex align-items-center justify-content-center text-center position-relative"
                        style="background-image: url('{{ url("public/$destinasi->foto") }}'); background-size: cover; background-position: center; height: 250px; border-radius: 10px;">
                        <div class="overlay"></div>
                        <div class="content position-relative">
                            <h4 class="card-title" style="font-weight:500; font-size:2rem;">
                                {{ $destinasi->nama_destinasi }}</h4>
                            <hr>
                            <p class="text-white">{{ $destinasi->alamat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package Jumbotron -->
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form action="{{ route('paket.storePaketWisata', ['destinasi_id' => $destinasi->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Informasi Paket Wisata</h3>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="nama_paket_wisata">Nama Paket Wisata</label>
                                <input type="text" name="nama_paket_wisata" class="form-control" id="nama_paket_wisata"
                                    required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="deskripsi" rows="3" required></textarea>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="durasi">Durasi (hari)</label>
                                <input type="text" name="durasi" class="form-control" id="durasi" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control" id="foto" title="Foto Paket Anda" required>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2: Informasi Peserta -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Informasi Peserta</h3>
                            <div class="form-group">
                                <label class="control-label mb-1" for="jumlah_peserta">Jumlah Peserta</label>
                                <input type="number" name="jumlah_peserta" class="form-control" id="jumlah_peserta"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3: Informasi Penyelenggara -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="card-title">Informasi Penyelenggara</h3>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="nama_penyelenggara">Nama Penyelenggara</label>
                                <input type="text" name="nama_penyelenggara" class="form-control" id="nama_penyelenggara"
                                    required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="no_wa">Nomor WhatsApp</label>
                                <input type="text" name="no_wa" class="form-control" id="no_wa" required>
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="instagram">Instagram</label>
                                <input type="text" name="instagram" class="form-control" id="instagram">
                            </div>
                            <div class="form-group mb-2">
                                <label class="control-label mb-1" for="facebook">Facebook</label>
                                <input type="text" name="facebook" class="form-control" id="facebook">
                            </div>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark float-right">Next</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Package Details -->
    </div>
@endsection
