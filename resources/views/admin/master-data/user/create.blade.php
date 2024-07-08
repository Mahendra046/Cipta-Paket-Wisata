<x-module.admin title="Admin | Admin"  url="admin/master-data/admin" page="Admin | Create">
    <a href="{{ url('superuser/master-data/user') }}" class="btn btn-dark mb-2">
        <i class="fa fa-arrow-left mr-2"></i>Kembali
    </a>
    <div class="card card-info card-outline">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit"></i>
                Tambah Admin
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ url('admin/master-data/admin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Nama</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="control-label">Password</label>
                        <input type="text" class="form-control" name="password">
                    </div>
                </div>
                <button class="btn btn-dark float-right"><i class="fa fa-save mr-2"></i>Simpan</button>
            </form>
        </div>
        <!-- /.card -->
    </div>
</x-module.admin>
