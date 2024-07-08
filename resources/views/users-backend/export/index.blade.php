<x-module.users title="Users | Paket Wisata" url="user/paket-wisata" page="Paket Wisata">
    <style>
        .jumbotron {
            border-radius: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.234); /* horizontal offset, vertical offset, blur radius, spread radius, color */
            /* Sesuaikan dengan besar sudut yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan */
        }
    </style>
    @foreach ($list_destinasi as $destinasi)
    
    
    <div class="card" style="border-radius: 25px;">
        <div class="card-header">
            <div class="jumbotron mt-3"
                @if ($destinasi->foto != null) style="background-image: url('{{ url("$destinasi->foto") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
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
                        @if ($destinasi->foto == null)
                        <button class="btn btn-outline-light" type="button" data-toggle="modal"
                            data-target="#exampleModal{{$destinasi->id}}"><i class="fa fa-upload mr-2"></i>
                                tambahkan gambar
                            </button>
                            @else
                            <a href="{{url('user/export/destinasi',$destinasi->id)}}/export">
                                <button class="btn btn-outline-light"><i class="fas fa-angle-double-up mr-2"></i>
                                    Export Destinasi
                                </button>
                            </a>
                            <a href="{{url('user/export/destinasi',$destinasi->id)}}">
                                <button class="btn btn-outline-light"><i class="fas fa-share mr-2"></i>
                                    Share Destinasi
                                </button>
                            </a>
                            @endif
                    </p>
                </div>
                {{-- modal upload foto --}}
                <div class="modal fade" id="exampleModal{{$destinasi->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            <h3 class="card-title text-bold">Daftar Paket Wisata {{$destinasi->nama_destinasi}}</h3>
        </div>
        <!-- Button trigger modal -->
        
        <!-- /.card-header -->
        <div class="card-body">
                <div class="row">
                    @foreach ($destinasi->paket as $paket)
                        <a href="{{ url('user/paket', $paket->id) }}/1">
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill"
                                    style="border-radius: 20px; background-image:url('{{ url("$paket->foto") }}'); background-size:cover;">
                                    <div class="position-absolute top-0 left-0 w-100 h-100"
                                        style="background-color: rgba(0, 0, 0, 0.3); border-radius: 20px;"></div>
                                    <div class="card-header text-muted border-bottom-0 text-white">
                                        {{ $paket->destinasi->nama_destinasi }}
                                    </div>
                                    <div class="card-body pt-0" style="color:white;">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $paket->nama_paket_wisata }}</b></h2>
                                                <p class="text-muted text-sm mb-1 text-white"><b>Min Peserta: </b>
                                                    {{ $paket->jumlah_peserta }} orang</p>
                                                <p class="text-muted text-sm mb-1 text-white"><b>Durasi: </b>
                                                    {{ $paket->durasi }}</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer" style="z-index: 2">
                                        <div class="text-right">
                                            {{-- <a href="#" class="btn btn-sm bg-danger">
                                                <i class="fas fa-trash"></i>
                                            </a> --}}
                                            <a href="{{ url('user/export/paket', $paket->id) }}">
                                                <button class="btn btn-outline-light">
                                                    <i class="fas fa-angle-double-up mr-2"></i> Export Paket

                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
            <!-- /.card-body -->
        </div>
    @endforeach
</x-module.users>
<style>
    .modal-content {
        border-radius: 30px;
    }
</style>
