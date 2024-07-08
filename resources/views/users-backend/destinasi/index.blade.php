<x-module.users title="Users | Destinasi Wisata" url="user/destinasi" page="Destinasi Wisata">
    <div class="row">
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <!-- Tambahkan skrip Leaflet.Geocoding untuk geokode -->
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <style>
            /* Tentukan ukuran peta */
            #map {
                height: 250px;
            }
        </style>
        <!-- Masukkan API key Google Maps Anda di sini -->
        <div class="col-md-6">
            <div class="card" style="border-radius: 30px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.234); ">
                <form id="coordinateForm" method="POST" action="{{ url('user/destinasi') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title text-bold" style="font-size: 2rem;">Tambahkan Destinasi Wisata Anda</h3>
        
                    </div>
                    <div class="card-body">
                        <label for="validationCustom01">Nama Destinasi</label>
                        <input class="form-control" type="text" name="nama_destinasi" required
                            value="{{ old('nama_destinasi') }}">
                        <div id="map"></div>
                        <div class="valid-feedback">
                            silakan isi nama destinasi
                        </div>
        
                        <label for="latitude">Latitude:</label>
                        <input class="form-control @error('latitude') is-invalid @enderror" type="text"
                            id="latitude" name="latitude" readonly value="{{ old('latitude') }}">
                        @error('latitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
        
                        <label for="longitude">Longitude:</label>
                        <input type="text" id="longitude" class="form-control" name="longitude" readonly
                            value="{{ old('longitude') }}">
                        @error('longitude')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        {{-- <label for="searchLocation">Cari Lokasi:</label>
                        <input type="text" id="searchLocation"  class="form-control" name="searchLocation"
                            placeholder="Masukkan alamat atau nama lokasi"> --}}
        
                        <!-- Informasi tambahan yang akan diisi otomatis -->
                        <label for="fullAddress">Alamat Lengkap:</label>
                        <input type="text" id="fullAddress" class="form-control mb-3" name="alamat" readonly
                            value="{{ old('alamat') }}">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <label for="postalCode">Gambar Destinasi</label>
                        <input type="file" id="postalCode" name="foto"  class="form-control mb-3">
                        <button href="{{ url('user/destinasi/create') }}" class="btn btn-dark float-right mt-2"><i
                                class="fa fa-plus mr-2"></i>Tambahkan Lokasi</button>
                    </div>
                </form>


                <!-- ... Bagian Lainnya ... -->

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
                <!-- ... Bagian Lainnya ... -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="card" style="border-radius: 30px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.234); ">
                <div class="card-header">
                    <h2 class="card-title text-bold" style="font-size: 2rem;">Daftar Destinasi Wisata Anda</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($destinasi as $destinasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <x-layout-app.button.edit-button url="user/destinasi"
                                            id="{{ $destinasi->id }}" />
                                        <x-layout-app.button.delete-button url="user/destinasi"
                                            id="{{ $destinasi->id }}" />
                                        <a href="{{ url('user/destinasi',$destinasi->id)}}" class="btn btn-outline-dark"><i class="fa fa-save mr-2"></i>Tambahkan Paket</a>
                                    </td>
                                    <td>{{ $destinasi->nama_destinasi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</x-module.users>
