<x-module.admin title="Admin | Admin" url="admin/master-data/admin" page="Admin">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('superuser/master-data/user/create') }}" class="btn btn-dark float-right"><i
                    class="fa fa-plus mr-2"></i>Tambah Data</a>
            <h3 class="card-title">Tabel Data Users</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_user as $user)
                        <tr>
                            <td>
                                <x-layout-app.button.info-button url="superuser/master-data/admin"
                                    id="{{ $user->id }}" />
                                <x-layout-app.button.delete-button url="superuser/master-data/admin"
                                    id="{{ $user->id }}" />
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->foto == null)
                                    <img src="{{ url('public/admin') }}/dist/img/user.png" class="img-circle elevation-2"
                                        alt="User Image" style="width:40px">
                                        @else
                                        <img src="{{ url("public/$user->foto") }}" class="img-circle elevation-2"
                                            alt="User Image" style="width:40px">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Foto</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</x-module.admin>
