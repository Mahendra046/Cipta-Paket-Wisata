<div class="modal fade" id="status{{ $paket->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;" role="document">
        <div class="modal-content rounded-5 shadow" style="background-color: #ffffff">
            <div class="modal-body pt-2 p-5">
                <h2 class="pb-5 text-bold" style="font-size: 3rem;">Edit Status Paket</h2>
                <form action="{{ url('user/paket/level', $paket->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_paket" class="form-label">Nama Paket: {{ $paket->nama_paket_wisata }}</label>
                    </div>
                    <div class="mb-3">
                        <label for="status_paket" class="form-label">Status Paket: 
                            @if ($paket->status_paket == 1)
                                <span class="badge badge-dark">Draft</span>
                            @elseif($paket->status_paket == 2)
                                <span class="badge badge-warning">Pending Review</span>
                            @elseif($paket->status_paket == 3)
                                <span class="badge badge-success">Dipublikasikan</span>
                            @elseif($paket->status_paket == 4)
                                <span class="badge badge-info">Diprivasi</span>
                            @elseif($paket->status_paket == 5)
                                <span class="badge badge-danger">Diarsipkan</span>
                            @endif
                        </label>
                        @if ($paket->status_paket != 1)
                        <select name="status_paket" id="status_paket" class="form-select">
                            <option value="3">Publikasikan : paket ini akan ditampilkan ke halaman beranda website ini </option>
                            <option value="5">Arsipkan : paket ini akan diarsipkan dan hanya dapat dilihat oleh anda sendiri</option>
                        </select>
                        @else
                        <h6>harap lengkapi fasilitas dan aktifitas terlebih dahulu sebelum mengubah status paket ini</h6>
                        <a href="{{ url('user/paket', $paket->id) }}" class="btn btn-dark">Aktifitas dan Fasilitas</a>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-dark mt-5 w-30 text-light float-end">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
