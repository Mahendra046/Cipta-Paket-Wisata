<x-module.admin title="Admin | Admin"  url="admin/master-data/admin" page="Admin | Create">
    <a href="{{ url('superuser/master-data/admin') }}" class="btn btn-dark mb-2">
        <i class="fa fa-arrow-left mr-2"></i>Kembali
    </a>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Edit Admin
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ url('superuser/master-data/admin',$admin->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{$admin->name}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Email</label>
                        <input type="text" class="form-control" name="email" value="{{$admin->email}}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Password</label>
                        <input type="text" class="form-control" name="password" value="{{$admin->password}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Level</label>
                        <select name="level" id="" class="form-control">
                            <option value="super_admin">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <button class="btn btn-dark float-right"><i class="fa fa-save mr-2"></i>Simpan</button>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-module.admin>