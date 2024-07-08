@if ($paket->aktifitas == null)
<form action="{{ url('user/paket', $paket->id) }}/aktifitas" method="POST" class="container mt-5">
    @csrf
    <h4>Itinerary/Aktifitas</h4>
    <label for="editor" class="form-label">Masukkan itinerary perjalanan yang Anda tawarkan ke dalam paket!</label>
    <div id="editor" class="quill-container"></div>
    <input type="hidden" name="daftar_aktifitas" id="daftar_aktifitas">
    <button type="submit" class="btn btn-dark mt-2 float-right"><i class="fa fa-check mr-2"></i>Simpan Aktifitas</button>
</form>
@else
<form action="{{ url('user/paket', [$paket->id, 'aktifitas', $paket->aktifitas->id, 'edit']) }}" method="POST">
    @method('PUT')
    @csrf
    <h4>Itinerary/Aktifitas</h4>
    <label for="editor" class="form-label">Masukkan itinerary perjalanan yang Anda tawarkan ke dalam paket!</label>
    <div id="editor" class="quill-container">{!! ($paket->aktifitas->daftar_aktifitas) !!}</div>
    <input type="hidden" name="daftar_aktifitas" id="daftar_aktifitas">
    <button type="submit" class="btn btn-dark mt-2 float-right"><i class="fa fa-check mr-2"></i>Simpan Aktifitas</button>
</form>
@endif