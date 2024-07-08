@section('menu-item', 'menu-open')
<x-module.users title="Users | Detail Destinasi Wisata" url="user/destinasi" page="Detail Destinasi Wisata">
    <a href="{{ url('user/destinasi') }}" class="btn btn-dark mb-2">
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
        @if ($destinasi->foto != null) style="background-image: url('{{ url("public/$destinasi->foto") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
    @else
        style="background-color: #393b39; text-align: center; color: white; position: relative;" @endif>
        <!-- Elemen overlay semi-transparan -->
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.337); border-radius:30px;">
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
                        Tambahkan Gambar Destinasi
                    @else
                        Ubah Gambar Destinasi
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
        <div class="col-md-12">
            <div class="card" style="border-radius: 30px;">
                <div class="card-header">
                    <h1 class="card-title text-bold">
                        Tambahkan Paket
                    </h1>
                </div>
                <div class="card-body">
                    <form action="{{ url('user/destinasi/tambahpaket', $destinasi->id) }}" method="post">
                        @csrf
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="" class="control-label">Nama Paket</label>
                                <input type="text" name="nama_paket" class="form-control" placeholder="berikan nama paket yang menarik">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="" class="control-label">Durasi</label>
                                <input type="text" name="durasi" class="form-control" placeholder="2 hari 1 malam/ 3 hari 2 malam">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="" class="control-label">Foto Paket</label>
                                <input type="file" name="foto" class="form-control">
                            </div>
                            <div class="form-group col-md-1">
                                <label for="" class="control-label">Peserta</label>
                                <input type="number" name="jumlah_peserta" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="" class="control-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" id="" cols="30" rows="5" placeholder="jelaskan deskripsi singkat paket anda"></textarea>
                            </div>
                        </div>

                        <button href="{{ url('user/destinasi/create') }}" class="btn btn-dark float-right mt-2"><i
                                class="fa fa-plus mr-2"></i>Tambahkan</button>
                    </form>

                </div>
            </div>
            <div class="card" style="border-radius: 30px;">
                <div class="card-header">
                    <h2 class="card-title text-bold">Daftar Paket Wisata</h2>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Durasi</th>
                                <th>Jumlah Peserta</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list_paket as $paket)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <x-layout-app.button.edit-button url="user/paket" id="{{ $paket->id }}" />
                                        <x-layout-app.button.delete-button path="user/paket/"
                                            id="{{ $paket->id }}" />
                                        <a href="{{ url('user/paket', $paket->id) }}"
                                            class="btn btn-outline-dark mt-2">aktifitas <br> & <br>fasilitas</a>
                                    </td>
                                    <td>{{ $paket->nama_paket_wisata }}</td>
                                    <td>{{ $paket->deskripsi }}</td>
                                    <td>{{ $paket->durasi }}</td>
                                    <td>{{ $paket->jumlah_peserta }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Durasi</th>
                                <th>Jumlah Peserta</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{-- Ubah Destinasi --}}
        <div class="col-md-5">

        </div>
        {{-- Ubah Destinasi END --}}

    </div>
</x-module.users>
