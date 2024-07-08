<x-module.admin title="Admin | Paket Wisata" url="superuser/paket-wisata" page="Paket Wisata">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('superuser/paket-wisata/create') }}" class="btn btn-dark float-right"><i
                    class="fa fa-plus mr-2"></i>Tambah Data</a>
            <h3 class="card-title">Tabel Data Paket Wisata</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Destinasi</th>
                        <th>Nama Penyelenggara</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($paket_wisata as $paket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <x-layout-app.button.info-button url="superuser/paket-wisata"
                                    id="{{ $paket->id }}" />
                                <x-layout-app.button.delete-button url="superuser/paket-wisata"
                                    id="{{ $paket->id }}" />
                            </td>
                            <td>{{ $paket->nama_paket_wisata }}</td>
                            <td>{{ $paket->destinasi->nama_destinasi }}</td>
                            <td>
                                @if (!is_null($paket->user))
                                    
                                {{ $paket->user->name }}
                                @else
                                {{$paket->nama_penyelenggara}}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Destinasi</th>
                        <th>Nama Penyelenggara</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</x-module.admin>
