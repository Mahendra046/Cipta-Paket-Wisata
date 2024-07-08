<div class="modal fade" id="editpaket{{$paket->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;" role="document">
        <div class="modal-content rounded-5 shadow" style="background-color: #ffffff">
            <div class="modal-body pt-2 p-5">
                <h2 class="pb-5 text-bold" style="font-size: 3rem;">Edit Data Paket</h2>
                <form action="{{ url('user/paket/data', $paket->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="nama_paket" class="control-label">Nama Paket</label>
                        <input type="text" class="form-control" value="{{$paket->nama_paket_wisata}}" name="nama_paket_wisata" id="nama_paket">
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="control-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control">{{$paket->deskripsi}}</textarea>
                    </div>
                    <div class="row mb-3">
                        <label for="durasi" class="control-label">Durasi</label>
                        <input type="text" class="form-control" name="durasi" value="{{$paket->durasi}}" id="durasi">
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_peserta" class="control-label">Jumlah Peserta</label>
                        <input type="number" class="form-control" name="jumlah_peserta" value="{{$paket->jumlah_peserta}}" id="jumlah_peserta">
                    </div>
                    <button type="submit" class="btn btn-dark mt-5 w-30 text-light float-end">Simpan</button>
                </form>                            
            </div>
        </div>
    </div>
</div>