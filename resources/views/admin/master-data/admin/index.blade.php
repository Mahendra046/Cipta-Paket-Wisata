<x-module.admin title="Admin | Admin" url="admin/master-data/admin" page="Admin">
    <div class="card">
        <div class="card-header">
            <a href="{{ url('superuser/master-data/admin/create') }}" class="btn btn-dark float-right"><i
                    class="fa fa-plus mr-2"></i>Tambah Data</a>
            <h3 class="card-title">Tabel Data Admin</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list_admin as $admin)
                    <tr>
                        <td>
                            <x-layout-app.button.edit-button url="superuser/master-data/admin" id="{{$admin->id}}"/>
                            <x-layout-app.button.delete-button url="superuser/master-data/admin" id="{{$admin->id}}"/>
                        </td>
                        <td>{{$admin->name}}</td>
                        <td>{{$admin->email}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>Email</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</x-module.admin>
