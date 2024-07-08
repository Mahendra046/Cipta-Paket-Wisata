@section('menu-item', 'menu-open')
<x-module.users title="Users | Edit Destinasi Wisata" url="user/destinasi" page="Edit Destinasi Wisata">
    <a href="{{ url('user/destinasi') }}" class="btn btn-dark mb-2">
        <i class="fa fa-arrow-left mr-2"></i>Kembali
    </a>
    <style>
        .jumbotron {
            border-radius: 20px;
            /* Sesuaikan dengan besar sudut yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan */
        }
    </style>
    <div class="jumbotron"
        @if ($destinasi->foto != null) style="background-image: url('{{ url("public/$destinasi->foto") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
         @else
         style="background-color: #393b39; text-align: center; color: white; position: relative;" @endif>
        <!-- Elemen overlay semi-transparan -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.321); border-radius:20px;">
        </div>

        <!-- Teks di depan gambar -->
        <div style="position: relative; z-index: 1;">
            <h1 class="display-4">{{ $destinasi->nama_destinasi }}</h1>
            <p class="lead">{{ $destinasi->alamat }}</p>
            <hr class="my-4 bg-white">
            <p class="lead">
                <button class="btn btn-outline-light" type="button" data-toggle="modal" data-target="#exampleModal"><i
                        class="fa fa-upload mr-2"></i>
                    @if ($destinasi->foto == null)
                        tambahkan gambar
                    @else
                        ubah gambar
                    @endif
                </button>
            </p>
        </div>
        {{-- modal upload foto --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{ url('user/destinasi/foto', $destinasi->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel" style="color: black"><i
                                    class="fa fa-upload mr-2"></i>Foto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="file" name="foto" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-outline-dark">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end modal upload foto --}}
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card" style="border-radius: 15px;">
                <div class="card-header">
                    <h1 class="card-title text-bold">
                        Detail
                    </h1>
                </div>
                <div class="card-body">
                    <dt>Nama Destinasi</dt>
                    <dd>{{ $destinasi->nama_destinasi }}</dd>
                    <dt>Lokasi</dt>
                    <dd>{{ $destinasi->alamat }}</dd>
                    <div class="row">
                        <div class="col-sm-6">
                            <dt>Lat</dt>

                            <dd>{{ $destinasi->latitude }}</dd>
                        </div>
                        <div class="col-sm-6">
                            <dt>Long</dt>

                            <dd>{{ $destinasi->longitude }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Ubah Destinasi --}}
        <div class="col-md-5">
            <div class="card" style="border-radius: 15px;">
                <div class="card-header">
                    <h1 class="card-title text-bold">
                        Ubah Destinasi
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('user/destinasi', $destinasi->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="validationCustom01">Nama Destinasi</label>
                        <input class="form-control" type="text" name="nama_destinasi" required
                            value="{{ $destinasi->nama_destinasi }}">
                        <div class="valid-feedback">
                            silakan isi nama destinasi
                        </div>

                        <label for="latitude">Latitude:</label>
                        <input class="form-control @error('latitude') is-invalid @enderror" type="text"
                            id="latitude" name="latitude" readonly value="{{ $destinasi->latitude }}">
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" class="form-control" name="longitude" readonly
                            value="{{ $destinasi->longitude }}">
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        {{-- <label for="searchLocation">Cari Lokasi:</label>
                        <input type="text" id="searchLocation"  class="form-control" name="searchLocation"
                            placeholder="Masukkan alamat atau nama lokasi"> --}}

                        <!-- Informasi tambahan yang akan diisi otomatis -->
                        <label for="fullAddress">Alamat Lengkap:</label>
                        <input type="text" id="fullAddress" class="form-control mb-3" name="alamat" readonly
                            value="{{ $destinasi->alamat }}">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        {{-- <label for="postalCode">Kode Pos:</label>
                        <input type="text" id="postalCode" name="postalCode"  class="form-control mb-2" readonly> --}}
                        <div id="map"></div>
                        <button href="{{ url('user/destinasi/create') }}" class="btn btn-dark float-right mt-2"><i
                                class="fa fa-save mr-2"></i>Ubah Lokasi</button>
                    </form>

                </div>
            </div>
        </div>
        {{-- Ubah Destinasi END --}}

        {{-- style --}}
        <style>
            /* Tentukan ukuran peta */
            #map {
                height: 250px;
            }
        </style>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        {{-- end style --}}

        {{-- Script --}}
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <!-- Tambahkan skrip Leaflet.Geocoding untuk geokode -->
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <script>
            // Inisialisasi peta Leaflet
            var map = L.map('map').setView([-6.2088, 106.8456], 12);

            // Variabel untuk menyimpan referensi marker
            var marker;

            // Tambahkan tile layer (misalnya, dari OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            // Tambahkan kontrol geokode untuk mencari lokasi
            var geocoder = L.Control.Geocoder.nominatim();
            var control = L.Control.geocoder({
                geocoder: geocoder
            }).addTo(map);

            // Tambahkan event listener untuk mendapatkan hasil pencarian
            control.on('markgeocode', function(e) {
                var coordinates = e.geocode.center;
                var fullAddress = e.geocode.name + ' ';

                // Hapus marker jika sudah ada sebelumnya
                if (marker) {
                    map.removeLayer(marker);
                }

                // Tambahkan marker baru ke posisi pencarian
                marker = L.marker(coordinates).addTo(map);

                // Tampilkan hasil pencarian di elemen formulir
                document.getElementById('latitude').value = coordinates.lat;
                document.getElementById('longitude').value = coordinates.lng;
                document.getElementById('fullAddress').value = fullAddress;
            });

            // Tambahkan event listener untuk mendapatkan koordinat saat klik
            map.on('click', function(e) {
                var coordinates = e.latlng;

                // Hapus marker jika sudah ada sebelumnya
                if (marker) {
                    map.removeLayer(marker);
                }

                // Mencari alamat berdasarkan koordinat
                geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
                    var fullAddress = (results[0].name || '') + ' ';

                    // Tambahkan marker baru ke posisi klik
                    marker = L.marker(coordinates).addTo(map);

                    // Tampilkan hasil di elemen formulir
                    document.getElementById('latitude').value = coordinates.lat;
                    document.getElementById('longitude').value = coordinates.lng;
                    document.getElementById('fullAddress').value = fullAddress;
                });
            });
        </script>
        {{-- End Script --}}
    </div>
</x-module.users>
