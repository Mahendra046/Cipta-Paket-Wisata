{{-- Modal Create --}}
<div class="modal fade" id="paket-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;" role="document">
        <div class="modal-content rounded-5 shadow" style="background-color: #ffffff">
            <div class="modal-body pt-2 p-5">
                <h2 class="pb-5 text-bold" style="font-size: 3rem;">Buat Paket</h2>
                <form action="{{ url('user/destinasi/tambahpaket') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="destinasi" class="control-label">Pilih Destinasi</label>
                        <select name="id_destinasi" id="destinasi" class="form-control">
                            <option value="">--Pilih--</option>
                            @foreach ($list_destinasi as $destinasi)
                                <option value="{{ $destinasi->id }}">{{ $destinasi->nama_destinasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_paket" class="control-label">Nama Paket</label>
                        <input type="text" class="form-control" name="nama_paket_wisata" id="nama_paket">
                    </div>
                    <div class="row mb-3">
                        <label for="deskripsi" class="control-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="row mb-3">
                        <label for="durasi" class="control-label">Durasi</label>
                        <input type="text" class="form-control" name="durasi" id="durasi">
                    </div>
                    <div class="row mb-3">
                        <label for="jumlah_peserta" class="control-label">Jumlah Peserta</label>
                        <input type="number" class="form-control" name="jumlah_peserta" id="jumlah_peserta">
                    </div>
                        <label for="foto" class="control-label">Foto</label>
                        <input type="file" name="foto" class="form-control" id="foto">
                    <button type="submit" class="btn btn-dark mt-5 w-30 text-light float-end">Simpan</button>
                </form>                            
            </div>
        </div>
    </div>
</div>
{{-- Modal Create end --}}