<x-module.admin title="Cipta Paket Wisata" url="user/paket-wisata" page="Tambah Fasilitas">
    <a href="{{ url('superuser/paket-wisata') }}" class="btn btn-dark mb-2">
        <i class="fa fa-arrow-left mr-2"></i>Kembali
    </a>
    <style>
        .jumbotron {
            border-radius: 30px;
            /* Sesuaikan dengan besar sudut yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan */
        }
    </style>
    <div class="jumbotron"
        @if ($paket->foto != null) style="background-image: url('{{ url("$paket->foto") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
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
    {{-- modal upload foto --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ url('user/paket/foto', $paket->id) }}" method="post" enctype="multipart/form-data">
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
    @if ($paket->fasilitas->isNotEmpty() && $paket->aktifitas != null)
        <div class="card" style="border-radius: 25px;">
            <div class="card-header">
                <h1 class="card-title text-bold">Daftar Aktifitas & Fasilitas Paket {{ $paket->nama_paket_wisata }}</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <table id="example4" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>aktifitas</th>
                                    <th>Fasilitas</th>
                                    <th>harga/satuan</th>
                                    <th>jumlah</th>
                                </tr>
                            </thead>
                            <tbody id="inputContainer">
                                <tr>
                                    <td>
                                        {!! nl2br($paket->aktifitas->daftar_aktifitas) !!}
                                    </td>
                                    <td>
                                        <ol>
                                            @foreach ($paket->fasilitas as $fasilitas)
                                                <li> {{ $fasilitas->nama_fasilitas }}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                    <td>

                                        @foreach ($paket->fasilitas as $fasilitas)
                                            <div class="row ml-3">
                                               Rp {{ $fasilitas->harga_satuan }} x {{ $fasilitas->jumlah }} {{$fasilitas->satuan}}
                                            </div>
                                        @endforeach

                                    </td>
                                    <td>
                                        @foreach ($paket->fasilitas as $fasilitas)
                                            <div class="row ml-3">
                                               Rp {{ $fasilitas->harga_satuan * $fasilitas->jumlah }}
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Harga/Orang: Rp {{ number_format($harga_per_orang, 0, ',', '.') }}</th>
                                    <th></th>
                                    <th>Total</th>
                                    <th>Rp {{ number_format($totalHarga, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let idCounter = 1;

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
    </script>
</x-module.admin>
