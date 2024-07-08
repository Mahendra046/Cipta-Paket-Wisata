@extends('front.paket-wisata.base')

@section('title', 'Input Aktivitas')
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
                        <p class="text-white fw-medium">Durasi: {{ $paket->durasi }}</p>
                        <p class="text-white fw-medium" id="paketInfo" data-jumlah-peserta="{{ $paket->jumlah_peserta }}">Jumlah Peserta: min {{ $paket->jumlah_peserta }} orang</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Package Details -->
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
                <form action="{{ route('paket.storeFasilitas', ['paket_wisata_id' => $paket->id]) }}" method="POST" id="myForm">
                    @method('POST')
                    @csrf
                    <div class="card mb-4" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <h3 class="card-title" style="font-size: 2rem;">Tambahkan Fasilitas</h3>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div id="hargaPerOrang"></div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="float-md-end" id="totalPrice"></div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="example3" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>subject</th>
                                            <th>jumlah</th>
                                            <th>satuan</th>
                                            <th>harga/satuan</th>
                                            <th>total</th>
                                            <th>deskripsi fasilitas</th>
                                            <th>aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="inputContainer">
                                        @if ($paket->fasilitas->isNotEmpty())
                                        <tr>
                                            {{-- <td>1</td> --}}
                                            <td><input type="text" class="form-control" value=""
                                                    name="nama_fasilitas[]" autocomplete="off"
                                                    placeholder="isi data tambahan">
                                            </td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(1)"
                                                    id="jumlah_1" value="1" step="any" name="jumlah[]"
                                                    autocomplete="off"></td>
                                            <td><input type="text" class="form-control" placeholder="Pax/Paket/Pcs"
                                                id="satuan_1" name="satuan[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(1)"
                                                    id="harga_1" value="300000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_1"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas"  id="fasilitas_1" class="form-control"
                                                    name="deskripsi_fasilitas[]" autocomplete="off"></td>
                                            <td><button type="button" class="btn btn-danger"
                                                    onclick="deleteRow(1)">Hapus</button>
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            {{-- <td>1</td> --}}
                                            <td><input type="text" class="form-control" value="Transportasi Darat"
                                                    name="nama_fasilitas[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(1)"
                                                    id="jumlah_1" value="0" step="any" name="jumlah[]"
                                                    autocomplete="off"></td>
                                            <td><input type="text" class="form-control"
                                                    placeholder="Mobil/transportasi sejenis" id="satuan_1" name="satuan[]"
                                                    autocomplete="off">
                                            </td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(1)"
                                                    id="harga_1" value="300000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_1"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas" id="fasilitas_1"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
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
                                                    placeholder="Kapal/Transportasi Sejenis" name="satuan[]" id="satuan_2"
                                                    autocomplete="off">
                                            </td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(2)"
                                                    id="harga_2" value="1000000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_2"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas"  id="fasilitas_2"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
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
                                                    placeholder="Pesawat/Transportasi Sejenis" name="satuan[]"  id="satuan_3"
                                                    autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(3)"
                                                    id="harga_3" value="1000000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_3"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas" id="fasilitas_3"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
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
                                                    placeholder="Pondok/Kamar/Tempat Istirahat" name="satuan[]" id="satuan_4"
                                                    autocomplete="off">
                                            </td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(4)"
                                                    id="harga_4" value="100000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_4"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas" id="fasilitas_4"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
                                            <td> Data Basic </td>
                                        </tr>
                                        <tr>
                                            {{-- <td>1</td> --}}
                                            <td><input type="text" class="form-control" value="Konsumsi"
                                                    name="nama_fasilitas[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(5)"
                                                    id="jumlah_5" value="0" step="any" name="jumlah[]"
                                                    autocomplete="off"></td>
                                            <td><input type="text" class="form-control" placeholder="Paket/Porsi" id="satuan_5"
                                                    name="satuan[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(5)"
                                                    id="harga_5" value="100000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_5"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas" id="fasilitas_5"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
                                            <td> Data Basic </td>
                                        </tr>
                                        <tr>
                                            {{-- <td>1</td> --}}
                                            <td><input type="text" class="form-control" value="Pemandu/Guide"
                                                    name="nama_fasilitas[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(6)"
                                                    id="jumlah_6" value="0" step="any" name="jumlah[]"
                                                    autocomplete="off"></td>
                                            <td><input type="text" class="form-control" placeholder="Orang" id="satuan_6"
                                                    name="satuan[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(6)"
                                                    id="harga_6" value="100000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_6"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas" id="fasilitas_6"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
                                            <td> Data Basic </td>
                                        </tr>
                                        <tr>
                                            {{-- <td>1</td> --}}
                                            <td><input type="text" class="form-control" value="Tiket Masuk"
                                                    name="nama_fasilitas[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(7)"
                                                    id="jumlah_7" value="0" step="any" name="jumlah[]"
                                                    autocomplete="off"></td>
                                            <td><input type="text" class="form-control" placeholder="Orang" id="satuan_7"
                                                    name="satuan[]" autocomplete="off"></td>
                                            <td><input type="number" class="form-control" onchange="updateTotal(7)"
                                                    id="harga_7" value="15000" name="harga_satuan[]" step="any"
                                                    autocomplete="off"></td>
                                            <td><span id="total_7"></span></td>
                                            <td><input type="text" placeholder="deskripsi fasilitas"  id="fasilitas_7"
                                                    class="form-control" name="deskripsi_fasilitas[]" autocomplete="off">
                                            </td>
                                            <td> Data Basic </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-fasilitas btn-primary" id="addInput">Tambah Fasilitas</button>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // let idCounter = 7;

    // $(document).ready(function() {
    //     $("#addInput").click(function() {
    //         idCounter++;
    //         $("#inputContainer").append(`
    //                 <tr>
    //                     <td><input type="text" class="form-control" id="subject_${idCounter}" name="nama_fasilitas[]" /></td>
    //                     <td><input type="number" class="form-control" onchange="updateTotal(${idCounter})" id="jumlah_${idCounter}" name="jumlah[]" value="0"></td>
    //                     <td><input type="text" class="form-control" id="satuan_${idCounter}" name="satuan[]" /></td>
    //                     <td><input type="text" class="form-control" onchange="updateTotal(${idCounter})" id="harga_${idCounter}" name="harga_satuan[]"></td>
    //                     <td><span id="total_${idCounter}">Rp0</span></td>
    //                     <td><input type="text" class="form-control" id="fasilitas_${idCounter}" name="deskripsi_fasilitas[]" /></td>
    //                     <td><button type="button" class="btn btn-danger" onclick="deleteRow(${idCounter})">Hapus</button></td>
    //                 </tr>
    //             `);
    //     });
    // });

    // function updateTotal(id) {
    //     let jumlah = parseInt(document.getElementById('jumlah_' + id).value);
    //     let hargaSatuan = parseFloat(document.getElementById('harga_' + id).value.replace(/\./g, ''));
    //     let total = jumlah * hargaSatuan;
    //     document.getElementById('total_' + id).innerText = 'Rp' + total.toLocaleString('id-ID');

    //     // Update total price
    //     calculateTotalPrice();
    // }


    // function calculateTotalPrice() {
    //     let totalPrice = 0;
    //     let jumlahPeserta = parseInt($('#paketInfo').data('jumlah-peserta')); // Ambil jumlah peserta dari atribut data

    //     $('span[id^="total_"]').each(function() {
    //         let value = parseFloat($(this).text().replace('Rp', '').replace(/\./g, '').replace(',', '.'));
    //         if (!isNaN(value)) {
    //             totalPrice += value;
    //         }
    //     });

    //     let hargaPerOrang = totalPrice / jumlahPeserta;
    //     $('#totalPrice').html('<strong>Total Harga: Rp' + totalPrice.toLocaleString('id-ID') + '</strong>');
    //     $('#hargaPerOrang').html('<strong>Harga Per Orang: Rp' + hargaPerOrang.toLocaleString('id-ID') + '</strong>');
    // }

    // function deleteRow(id) {
    //     $('#jumlah_' + id).closest('tr').remove();
    //     updateNumbering(); // Panggil fungsi untuk mengupdate nomor urut
    //     calculateTotalPrice();
    // }

    // function updateNumbering() {
    //     $('#inputContainer tbody tr').each(function(index) {
    //         $(this).find('td:first').text(index + 1);
    //     });
    // }

    // $(function() {
    //     $("#example3").DataTable({
    //         "responsive": true,
    //         "lengthChange": false,
    //         "autoWidth": false,
    //         "searching": false,
    //         "ordering": false,
    //         "paging": false,
    //         "info": false,
    //         // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //     }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    //     $('#example2').DataTable({
    //         "lengthChange": false,
    //         "searching": false,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "responsive": true,
    //     });
    // });
    // $(function() {
    //     $("#example4").DataTable({
    //         "responsive": true,
    //         "lengthChange": false,
    //         "autoWidth": false,
    //         "searching": false,
    //         "ordering": false,
    //         "paging": false,
    //         "info": false,
    //         // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //     }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
    //     $('#example2').DataTable({
    //         "lengthChange": false,
    //         "searching": false,
    //         "ordering": true,
    //         "info": true,
    //         "autoWidth": false,
    //         "responsive": true,
    //     });
    // });

    // var form = document.querySelector('form');
    // form.addEventListener('submit', function() {
    //     var quillHtml = document.querySelector('.ql-editor').innerHTML;
    //     document.querySelector('#daftar_aktifitas').value = quillHtml;
    // });

    // const deleteData = (id, path) => {
    //     const base_url = '{{ url('/') }}'
    //     const url = `${base_url}/${path}`

    //     Swal.fire({
    //         title: 'Apakah Anda Yakin Ingin Menghapus Semua Fasilitas ini?',
    //         text: "Data yang dihapus tidak dapat dikembalikan!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, Hapus!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             const csrf_token = `{{ csrf_token() }}`
    //             const template = `
    //                 <form method="post" action="${url}">
    //                     <input type="hidden" name="_token" value="${csrf_token}"/>
    //                     <input type="hidden" name="_method" value="delete"/>
    //                 </form>
    //             `

    //             $(template).appendTo('body').submit();
    //         }
    //     })
    // }

    let idCounter = 7;

$(document).ready(function() {
    $("#addInput").click(function() {
        idCounter++;
        $("#inputContainer").append(`
                <tr>
                    <td><input type="text" class="form-control" id="subject_${idCounter}" name="nama_fasilitas[]" /></td>
                    <td><input type="number" class="form-control" onchange="updateTotal(${idCounter})" id="jumlah_${idCounter}" name="jumlah[]" value="0"></td>
                    <td><input type="text" class="form-control" id="satuan_${idCounter}" name="satuan[]"/></td>
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

    if (isNaN(jumlahPeserta) || jumlahPeserta <= 0) {
        jumlahPeserta = 1; // Default value if invalid
    }

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
