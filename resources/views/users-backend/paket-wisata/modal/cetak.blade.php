<div class="modal fade" id="modalcetak{{ $paket->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <button onclick="captureAndSaveAsJPEG('{{ $paket->id }}')" class="no-print btn btn-outline-dark float-right">Capture and Save as JPEG</button>
            <button onclick="generatePDF('{{ $paket->id }}')" class="no-print btn btn-outline-dark float-right">Unduh PDF</button>
            <style>
                @media print {
                    .no-print {
                        display: none;
                    }
                    body {
                        color: black !important;
                    }
                }
                .jumbotron.destinasi {
                    background-size: cover;
                    background-position: center;
                    text-align: center;
                    color: white;
                    position: relative;
                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.234);
                }
                .jumbotron.paket {
                    border-radius: 30px;
                    background-size: cover;
                    background-position: center;
                    text-align: justify;
                    color: rgb(0, 0, 0);
                    position: relative;
                }
            </style>
            <div id="content-to-export-{{ $paket->id }}">
                @php
                    $fotoDestinasi = $paket->destinasi->foto;
                @endphp

                <div class="jumbotron destinasi"
                    @if ($fotoDestinasi) 
                        style="background-image: url('{{ url("public/$fotoDestinasi") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
                    @else
                        style="background-color: #393b39; text-align: center; color: white; position: relative;" 
                    @endif>
                    <!-- Elemen overlay semi-transparan -->
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.374);"></div>

                    <!-- Teks di depan gambar -->
                    <div style="position: relative; z-index: 1;">
                        <h1 class="display-4" style="font-weight:300;" id="destinasi-name-{{ $paket->id }}">{{ $paket->destinasi->nama_destinasi }}</h1>
                        <p class="lead" style="font-weight:400;">{{ $paket->destinasi->alamat }}</p>
                        <hr class="my-4 bg-white">
                        <p class="lead"></p>
                    </div>
                </div>

                    <div class="card" style="border-radius: 25px;">
                        <div class="card-header">
                            @php
                                $fotoPaket = $paket->foto;
                            @endphp
                            <div class="jumbotron paket mt-3"
                                @if ($fotoPaket) 
                                    style="background-image: url('{{ url("public/$paket->foto") }}'); background-size: cover; background-position: center; color: white; position: relative;"
                                @else
                                    style="background-color: #393b39; text-align: center; color: white; position: relative;" 
                                @endif>
                                <!-- Elemen overlay semi-transparan -->
                                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.503); border-radius: 30px;"></div>

                                <!-- Teks di depan gambar -->
                                <div style="position: relative; z-index: 1;">
                                    <h2 style="font-weight: 300">Paket Wisata {{ $paket->nama_paket_wisata }}</h2>
                                    <p class="lead">{{ $paket->durasi }}</p>
                                    <div id="paketInfo-{{ $paket->id }}" data-jumlah-peserta="{{ $paket->jumlah_peserta }}">minimal peserta: {{ $paket->jumlah_peserta }} orang</div>
                                </div>
                            </div>
                            <h1 class="card-title text-bold">Deskripsi</h1>
                        </div>
                        <div class="card-body">
                            <p class="lead">{{ $paket->deskripsi }}</p>
                        </div>
                        <div class="card-body">
                            @if ($paket->fasilitas->isNotEmpty() && $paket->aktifitas != null)
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example4" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Aktifitas</th>
                                                    <th>Fasilitas</th>
                                                </tr>
                                            </thead>
                                            <tbody id="inputContainer">
                                                <tr>
                                                    <td>
                                                        {!! nl2br($paket->aktifitas->daftar_aktifitas) !!}
                                                    </td>
                                                    <td>
                                                        <ol>
                                                            @foreach ($paket->fasilitas as $fasilitas)
                                                                <li>{{ $fasilitas->nama_fasilitas }}</li>
                                                            @endforeach
                                                        </ol>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Harga/Orang: Rp {{ number_format($harga_per_orang, 0, ',', '.') }}</th>
                                                    <th>Total: Rp {{ number_format($totalHarga, 0, ',', '.') }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <h6>Kontak : {{ $paket->user->name }} ({{ $paket->user->no_wa }})</h6>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<script>
    function generatePDF(paketId) {
        const element = document.getElementById('content-to-export-' + paketId);
        html2pdf().from(element).set({
            margin: [0, 0, 0, 0],
            filename: 'document-' + paketId + '.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a3',
                orientation: 'portrait'
            }
        }).save();
    }

    function captureAndSaveAsJPEG(paketId) {
        const element = document.getElementById('content-to-export-' + paketId);
        const destinasiName = document.getElementById('destinasi-name-' + paketId).innerText;
        html2canvas(element, {
            scale: 2
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/jpeg');
            const link = document.createElement('a');
            link.download = `${destinasiName}.jpg`;
            link.href = imgData;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    }
</script>
