{{-- modal upload foto --}}
<div class="modal fade" id="modalfoto{{$paket->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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