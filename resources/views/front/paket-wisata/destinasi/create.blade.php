@extends('front.paket-wisata.base')
@section('title', 'Paket | Destinasi')
@section('label', ' Input Destinasi')
@section('status', ' active')
@section('content')
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-6">
            <form id="coordinateForm" method="POST" action="{{ url('paket-destinasi') }}" enctype="multipart/form-data">
                @csrf
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="card-title text-bold">Input Destinasi</h3>
                        <br>
                        <div class="mb-3">
                            <label for="nama_destinasi" class="form-label">Nama Destinasi</label>
                            <input type="text" class="form-control mb-3" id="nama_destinasi" name="nama_destinasi"
                                required value="{{ old('nama_destinasi') }}" autocomplete="off">
                            <div id="map" style="height: 300px;
                            width: 100%;"></div>
                            <div class="valid-feedback">
                                Silakan isi nama destinasi
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="latitude" class="form-label">Latitude:</label>
                                <input type="text" class="form-control @error('latitude') is-invalid @enderror"
                                    id="latitude" name="latitude" readonly value="{{ old('latitude') }}"
                                    autocomplete="off">
                                @error('latitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="longitude" class="form-label">Longitude:</label>
                                <input type="text" class="form-control @error('longitude') is-invalid @enderror"
                                    id="longitude" name="longitude" readonly value="{{ old('longitude') }}"
                                    autocomplete="off">
                                @error('longitude')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fullAddress" class="form-label">Alamat Lengkap:</label>
                            <input type="text" class="form-control" id="fullAddress" name="alamat" readonly
                                value="{{ old('alamat') }}" autocomplete="off">
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Gambar Destinasi</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>

                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark">Next</button>
                </div>
            </form>

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
    <style>
        #map {
            z-index: 1;
        }
    </style>

@endsection
