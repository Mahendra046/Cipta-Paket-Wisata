@extends('front.paket-wisata.base')
@section('title', 'Paket | Wisata')
@section('status', ' active')
@section('content')
{{-- Modal Create --}}
<div class="modal fade" id="paket-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;" role="document">
        <div class="modal-content rounded-5 shadow" style="background-color: #ffffff">
            <div class="modal-body p-5">
                <h2 class="pb-5">Paket</h2>
                <form action="{{ route('paket-wisata') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="destinasi" class="control-label">Pilih Destinasi</label>
                        <select name="id_destinasi" id="destinasi" class="form-control">
                            <option value="">--Pilih--</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_paket" class="control-label">Nama Paket</label>
                        <input type="text" class="form-control" name="nama_paket_wisata" id="nama_paket">
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="control-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="row mb-3">
                        <label for="durasi" class="control-label">Durasi</label>
                        <input type="text" class="form-control" name="durasi" id="durasi">
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_peserta" class="control-label">Jumlah Peserta</label>
                        <input type="number" class="form-control" name="jumlah_peserta" id="jumlah_peserta">
                    </div>
                    <div class="row mb-3">
                        <label for="fotos" class="control-label">Foto</label>
                        <div id="image-input-container">
                            <div class="input-group mb-3">
                                <input type="file" name="foto[]" class="form-control">
                                <button type="button" class="btn btn-danger remove-btn" onclick="removeImageInput(this)">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="addImageInput()">Tambah Foto</button>
                    </div>
                    <button type="submit" class="btn btn-dark mt-5 w-30 text-light float-end">Simpan</button>
                </form>                            
            </div>
        </div>
    </div>
</div>
{{-- Modal Create end --}}

<div class="row " >
    <div class="col-lg-12 col-md-6 col-sm-4">
        <div class="card">
            <div class="card-body">
                <center>
                    <h1>Destinasi</h1>
                    <p>silahkan tambahkan Destinasi untuk Paket anda!</p>
                </center>

                <form id="coordinateForm" method="POST" action="{{ route('paket.createDestinasi') }}"
                        enctype="multipart/form-data">
                        @csrf
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

                        <button type="submit" class="btn btn-dark float-end">Tambah Destinasi</button>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
<style>
    #map{
        z-index: 1;
    }
</style>
