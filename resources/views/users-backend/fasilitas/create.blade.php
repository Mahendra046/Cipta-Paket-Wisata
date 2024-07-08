@section('menu-item', 'menu-open')
<x-module.users title="Cipta Paket Wisata" url="user/paket-wisata" page="Tambah Fasilitas">
    <a href="{{ url('user/paket') }}" class="btn btn-dark mb-2">
        <i class="fa fa-arrow-left mr-2"></i>Kembali
    </a>
    <style>
        .jumbotron {
            border-radius: 30px;
            /* Sesuaikan dengan besar sudut yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan */
        }

        /* Custom styles for resizable editor */
        .quill-container {
            resize: vertical;
            overflow: hidden;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }
    </style>
    <div class="jumbotron"
        @if ($paket->destinasi->foto != null) style="background-image: url('{{ url("public/$paket->foto") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
@else
    style="background-color: #393b39; text-align: center; color: white; position: relative;" @endif>
        <!-- Elemen overlay semi-transparan -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.503); border-radius: 30px; ">
        </div>

        <!-- Teks di depan gambar -->
        <div style="position: relative; z-index: 1;">
            <h1 class="display-4">{{ $paket->destinasi->nama_destinasi }}</h1>
            <p class="lead">{{ $paket->destinasi->alamat }}</p>
            <hr class="my-4 bg-white">
            <h2 style="font-weight: 300">
                Paket
                {{ $paket->nama_paket_wisata }}
            </h2>
            <p class="lead">
                {{ $paket->durasi }}
            </p>
            <p class="lead">
                {{ $paket->deskripsi }}
            <div id="paketInfo" data-jumlah-peserta="{{ $paket->jumlah_peserta }}">minimal peserta:
                {{ $paket->jumlah_peserta }} orang</div>
            </p>
        </div>
    </div>
    <div class="card" style="border-radius: 25px;">

        <div class="card-body">
            <div class="row">
                <div class="card-header col-md-6">
                    <h4>Catatan !</h4>
                    <p>Paket Wisata yang baik wajib mencantumkan point penting berikut:</p>
                    <ul>
                        <li><span class="text-bold">Transportasi</span> (darat/laut/udara)</li>
                        <li><span class="text-bold">Akomodasi</span> </li>
                        <li><span class="text-bold">Konsumsi</span> (makan pagi/siang/malam)</li>
                        <li><span class="text-bold">Pemandu Wisata/Guide</span> </li>
                        <li><span class="text-bold">Tiket Masuk</span> (Opsional)</li>
                    </ul>
                </div>
                <div class="card-header col-md-6">
                    @include('users-backend.aktifitas.create')

                </div>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 25px;">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title fw-medium" style="font-size: 2rem;">Tambahkan Fasilitas</h3>

                </div>
                <div class="col-md-3">
                    <div id="hargaPerOrang"></div>
                </div>
                <div class="col-md-3">
                    <div class="float-right" id="totalPrice"></div>
                </div>
            </div>
        </div>
        <form action="{{ url('user/paket', $paket->id) }}/tambah-fasilitas" method="POST" id="myForm">
            @method('POST')
            @csrf
            <div class="card-body">
                <table id="example3" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>subject</th>
                            <th>jumlah</th>
                            <th>satuan</th>
                            <th>harga/satuan</th>
                            <th>total</th>
                            <th>fasilitas yang didapat</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody id="inputContainer">
                        @if ($paket->fasilitas->isNotEmpty())
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="" name="nama_fasilitas[]"
                                        autocomplete="off" placeholder="isi data tambahan">
                                </td>
                                <td><input type="number" class="form-control" onchange="updateTotal(1)" id="jumlah_1"
                                        value="1" step="any" name="jumlah[]" autocomplete="off"></td>
                                <td><input type="text" class="form-control" placeholder="Pax/Paket/Pcs"
                                        name="satuan[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(1)" id="harga_1"
                                        value="300000" name="harga_satuan[]" step="any" autocomplete="off"></td>
                                <td><span id="total_1"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td><button type="button" class="btn btn-danger" onclick="deleteRow(1)">Hapus</button>
                                </td>
                            </tr>
                        @else
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Transportasi Darat"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(1)" id="jumlah_1"
                                        value="0" step="any" name="jumlah[]" autocomplete="off"></td>
                                <td><input type="text" class="form-control" placeholder="Mobil/transportasi sejenis"
                                        name="satuan[]" autocomplete="off">
                                </td>
                                <td><input type="number" class="form-control" onchange="updateTotal(1)"
                                        id="harga_1" value="300000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_1"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Transportasi Laut"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(2)"
                                        id="jumlah_2" value="0" step="any" name="jumlah[]"
                                        autocomplete="off"></td>
                                <td><input type="text" class="form-control"
                                        placeholder="Kapal/Transportasi Sejenis" name="satuan[]" autocomplete="off">
                                </td>
                                <td><input type="number" class="form-control" onchange="updateTotal(2)"
                                        id="harga_2" value="1000000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_2"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Transportasi Udara"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(3)"
                                        id="jumlah_3" value="0" step="any" name="jumlah[]"
                                        autocomplete="off"></td>
                                <td><input type="text" class="form-control"
                                        placeholder="Pesawat/Transportasi Sejenis" name="satuan[]"
                                        autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(3)"
                                        id="harga_3" value="1000000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_3"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Akomodasi"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(4)"
                                        id="jumlah_4" value="0" step="any" name="jumlah[]"
                                        autocomplete="off"></td>
                                <td><input type="text" class="form-control"
                                        placeholder="Pondok/Kamar/Tempat Istirahat" name="satuan[]"
                                        autocomplete="off">
                                </td>
                                <td><input type="number" class="form-control" onchange="updateTotal(4)"
                                        id="harga_4" value="100000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_4"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Konsumsi"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(5)"
                                        id="jumlah_5" value="0" step="any" name="jumlah[]"
                                        autocomplete="off"></td>
                                <td><input type="text" class="form-control" placeholder="Paket/Porsi"
                                        name="satuan[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(5)"
                                        id="harga_5" value="100000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_5"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Pemandu/Guide"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(6)"
                                        id="jumlah_6" value="0" step="any" name="jumlah[]"
                                        autocomplete="off"></td>
                                <td><input type="text" class="form-control" placeholder="Orang" name="satuan[]"
                                        autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(6)"
                                        id="harga_6" value="100000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_6"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                            <tr>
                                {{-- <td>1</td> --}}
                                <td><input type="text" class="form-control" value="Tiket Masuk"
                                        name="nama_fasilitas[]" autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(7)"
                                        id="jumlah_7" value="0" step="any" name="jumlah[]"
                                        autocomplete="off"></td>
                                <td><input type="text" class="form-control" placeholder="Orang" name="satuan[]"
                                        autocomplete="off"></td>
                                <td><input type="number" class="form-control" onchange="updateTotal(7)"
                                        id="harga_7" value="15000" name="harga_satuan[]" step="any"
                                        autocomplete="off"></td>
                                <td><span id="total_7"></span></td>
                                <td><input type="text" placeholder="deskripsi fasilitas" class="form-control"
                                        name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                <td> Data Basic </td>
                            </tr>
                        @endif


                    </tbody>
                </table>
                <button type="button" class="btn btn-fasilitas" id="addInput">Tambah Fasilitas</button>
                <button type="submit" class="float-right btn btn-dark">Simpan</button>
            </div>
        </form>
    </div>
    <style>
        .btn-fasilitas {
            background-color: #117099;
            /* Ubah warna latar belakang saat kursor mengarah */
            color: #fff;
            /* Ubah warna teks saat kursor mengarah */
        }

        .btn-fasilitas:hover {
            background-color: #0d5f81;
            /* Ubah warna latar belakang saat kursor mengarah */
            color: #fff;
            /* Ubah warna teks saat kursor mengarah */
        }
    </style>
    @if ($paket->fasilitas->isNotEmpty() && $paket->aktifitas != null)
        <div class="card" style="border-radius: 25px;">
            <div class="card-header">
                <button class="btn btn-outline-danger float-right" type="button"
                    onclick="deleteData('{{ $paket->id }}', 'user/paket/{{ $paket->id }}/fasilitas')">
                    <i class="fa fa-trash"></i> Hapus Semua Fasilitas
                </button>
                <h1 class="card-title">Daftar Aktifitas & Fasilitas Paket {{ $paket->nama_paket_wisata }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <dt class="ml-3">Aktifitas</dt>
                        {!! nl2br($paket->aktifitas->daftar_aktifitas) !!}
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <dt>Daftar Fasilitas</dt>
                            </div>
                            <div class="col-md-3">
                                <dt>harga/orang: Rp {{ number_format($harga_per_orang, 0, ',', '.') }}</dt>
                            </div>
                            <div class="col-md-3">
                                <dt class="float-right">harga total: Rp {{ number_format($totalHarga, 0, ',', '.') }}
                                </dt>
                            </div>
                        </div>
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>subject</th>
                                    <th>jumlah</th>
                                    <th>satuan</th>
                                    <th>harga/satuan</th>
                                    <th>total</th>
                                    <th>fasilitas yang didapat</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody id="inputContainer">
                                @foreach ($paket->fasilitas as $fasilitas)
                                    <tr>
                                        <td style="padding: 0; padding-left: 1rem;">{{ $loop->iteration }}</td>
                                        <td style="padding: 0; padding-left: 1rem;">{{ $fasilitas->nama_fasilitas }}
                                        </td>
                                        <td style="padding: 0; padding-left: 1rem;">{{ $fasilitas->jumlah }}</td>
                                        <td style="padding: 0; padding-left: 1rem;">{{ $fasilitas->satuan }}</td>
                                        <td style="padding: 0; padding-left: 1rem;">{{ $fasilitas->harga_satuan }}
                                        </td>
                                        <td style="padding: 0; padding-left: 1rem;">
                                            {{ $fasilitas->jumlah * $fasilitas->harga_satuan }}</td>
                                        <td style="padding: 0; padding-left: 1rem;">
                                            {{ $fasilitas->deskripsi_fasilitas }}</td>
                                        <td style="padding: 0; padding-left: 1rem;"><a
                                                href="{{ url('user/fasilitas', $fasilitas->id) }}/delete"
                                                class="btn btn-danger">Hapus</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let idCounter = 7;

        $(document).ready(function() {
            $("#addInput").click(function() {
                idCounter++;
                $("#inputContainer").append(`
                    <tr>
                        <td><input type="text" class="form-control" id="subject_${idCounter}" name="nama_fasilitas[]" /></td>
                        <td><input type="number" class="form-control" onchange="updateTotal(${idCounter})" id="jumlah_${idCounter}" name="jumlah[]" value="0"></td>
                        <td><input type="text" class="form-control" id="satuan_${idCounter}" name="satuan[]" /></td>
                        <td><input type="text" class="form-control" onchange="updateTotal(${idCounter})" id="harga_${idCounter}" name="harga_satuan[]"></td>
                        <td><span id="total_${idCounter}">Rp0</span></td>
                        <td><input type="text" class="form-control" id="fasilitas_${idCounter}" name="deskripsi_fasilitas[]" /></td>
                        <td><button type="button" class="btn btn-danger" onclick="deleteRow(${idCounter})">Hapus</button></td>
                    </tr>
                `);
            });
        });

        function updateTotal(id) {
            let jumlah = parseInt(document.getElementById('jumlah_' + id).value);
            let hargaSatuan = parseFloat(document.getElementById('harga_' + id).value.replace(/\./g, ''));
            let total = jumlah * hargaSatuan;
            document.getElementById('total_' + id).innerText = 'Rp' + total.toLocaleString('id-ID');

            // Update total price
            calculateTotalPrice();
        }


        function calculateTotalPrice() {
            let totalPrice = 0;
            let jumlahPeserta = parseInt($('#paketInfo').data('jumlah-peserta')); // Ambil jumlah peserta dari atribut data

            $('span[id^="total_"]').each(function() {
                let value = parseFloat($(this).text().replace('Rp', '').replace(/\./g, '').replace(',', '.'));
                if (!isNaN(value)) {
                    totalPrice += value;
                }
            });

            let hargaPerOrang = totalPrice / jumlahPeserta;
            $('#totalPrice').html('<strong>Total Harga: Rp' + totalPrice.toLocaleString('id-ID') + '</strong>');
            $('#hargaPerOrang').html('<strong>Harga Per Orang: Rp' + hargaPerOrang.toLocaleString('id-ID') + '</strong>');
        }

        function deleteRow(id) {
            $('#jumlah_' + id).closest('tr').remove();
            updateNumbering(); // Panggil fungsi untuk mengupdate nomor urut
            calculateTotalPrice();
        }

        function updateNumbering() {
            $('#inputContainer tbody tr').each(function(index) {
                $(this).find('td:first').text(index + 1);
            });
        }

        $(function() {
            $("#example3").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "paging": false,
                "info": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $(function() {
            $("#example4").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "searching": false,
                "ordering": false,
                "paging": false,
                "info": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        var form = document.querySelector('form');
        form.addEventListener('submit', function() {
            var quillHtml = document.querySelector('.ql-editor').innerHTML;
            document.querySelector('#daftar_aktifitas').value = quillHtml;
        });

        const deleteData = (id, path) => {
            const base_url = '{{ url('/') }}'
            const url = `${base_url}/${path}`

            Swal.fire({
                title: 'Apakah Anda Yakin Ingin Menghapus Semua Fasilitas ini?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const csrf_token = `{{ csrf_token() }}`
                    const template = `
                    <form method="post" action="${url}">
                        <input type="hidden" name="_token" value="${csrf_token}"/>
                        <input type="hidden" name="_method" value="delete"/>
                    </form>
                `

                    $(template).appendTo('body').submit();
                }
            })
        }
    </script>

</x-module.users>
