<x-module.users title="Users | Detail Destinasi Wisata" url="user/destinasi" page="Detail Destinasi Wisata">
    <a href="{{ url('user/export') }}" class="btn btn-dark mb-2 no-print">
        <i class="fa fa-arrow-left mr-2"></i>Kembali
    </a>
    <button onclick="captureAndSaveAsJPEG()" class="no-print btn btn-outline-dark float-right">Capture and Save as JPEG</button>
    <button onclick="generatePDF()" class="no-print btn btn-outline-dark float-right">Unduh PDF</button>
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
            /* border-radius: 30px; */
            background-size: cover;
            background-position: center;
            text-align: center;
            color: white;
            position: relative;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.234);
            /* Sesuaikan dengan besar sudut yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan */
        }

        .jumbotron.paket {
            border-radius: 30px;
            background-size: cover;
            background-position: center;
            text-align: justify;
            color: rgb(0, 0, 0);
            position: relative;
            /* Sesuaikan dengan besar sudut yang diinginkan */
            /* Tambahkan properti lain sesuai kebutuhan */
        }
    </style>
    <div id="content-to-export">

        <div class="jumbotron destinasi"
            @if ($destinasi->foto != null) style="background-image: url('{{ url("public/../$destinasi->foto") }}');"
            style="background-image: url('{{ url("$destinasi->foto") }}'); background-size: cover; background-position: center; text-align: center; color: white; position: relative;"
                @else
            style="background-color: #393b39; text-align: center; color: white; position: relative;" @endif>
            <!-- Elemen overlay semi-transparan -->
            <div
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.374); ">
            </div>

            <!-- Teks di depan gambar -->
            <div style="position: relative; z-index: 1;">
                <h1 class="display-4" style="font-weight:300;" id="destinasi-name">{{ $destinasi->nama_destinasi }}</h1>
                <p class="lead" style="font-weight:400;">{{ $destinasi->alamat }}</p>
                <hr class="my-4 bg-white">
                <p class="lead">

                </p>
            </div>

        </div>
        @foreach ($destinasi->paket as $paket)
            <div class="card" style="border-radius: 25px;">

                <div class="card-header">
                    <div class="jumbotron paket mt-3"
                        @if ($paket->foto != null) style="background-image: url('{{ url("public/../$paket->foto") }}'); background-size: cover; background-position: center; color: white; position: relative;"
                                         @else
                            style="background-color: #393b39; text-align: center; color: white; position: relative;" @endif>
                        <!-- Elemen overlay semi-transparan -->
                        <div
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.503); border-radius: 30px; ">
                        </div>
                        {{-- <img src="{{ asset($paket->foto) }}" alt="Image"> --}}
                        <!-- Teks di depan gambar -->
                        <div style="position: relative; z-index: 1;">
                            {{-- <h1 class="display-4">{{ $paket->destinasi->nama_destinasi }}</h1> --}}
                            {{-- <p class="lead">{{ $paket->destinasi->alamat }}</p> --}}
                            {{-- <hr class="my-4 bg-white"> --}}
                            <h2 style="font-weight: 300">
                                Paket Wisata
                                {{ $paket->nama_paket_wisata }}
                            </h2>
                            <p class="lead">
                                {{ $paket->durasi }}
                            </p>
                            <p class="lead">
                                {{ $paket->deskripsi }}
                            <div id="paketInfo" data-jumlah-peserta="{{ $paket->jumlah_peserta }}">minimal peserta:
                                {{ $paket->jumlah_peserta }} orang</div>
                            </p>

                        </div>
                    </div>
                    <h1 class="card-title text-bold">Daftar Aktifitas & Fasilitas Paket Wisata
                        {{ $paket->nama_paket_wisata }}
                    </h1>
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
                                            <th>Harga/Satuan</th>
                                            <th>Jumlah</th>
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
                                                        <li> {{ $fasilitas->nama_fasilitas }}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td>

                                                @foreach ($paket->fasilitas as $fasilitas)
                                                    <div class="row ml-3">
                                                        Rp {{ $fasilitas->harga_satuan }} x
                                                        {{ $fasilitas->jumlah }}
                                                        {{ $fasilitas->satuan }}
                                                    </div>
                                                @endforeach

                                            </td>
                                            <td>
                                                @foreach ($paket->fasilitas as $fasilitas)
                                                    <div class="row ml-3">
                                                        Rp {{ $fasilitas->harga_satuan * $fasilitas->jumlah }}
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Harga/Orang: Rp {{ number_format($harga_per_orang, 0, ',', '.') }}
                                            </th>
                                            <th></th>
                                            <th>Total</th>
                                            <th>Rp {{ number_format($totalHarga, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <h3>Kontak : {{$paket->nama_penyelenggara}}({{$paket->kontak_penyelenggara}})</h3>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        @endforeach
    </div>
</x-module.users>

<script>
    // function generatePDF() {
    //     // Simulasi pembuatan file PDF (ganti dengan kode sesungguhnya)
    //     const element = document.getElementById('content-to-export');
    //     html2pdf().from(element).set({
    //         // margin: 1, // Atur margin dalam satuan milimeter
    //         filename: 'document.pdf',
    //         html2canvas: {
    //             scale: 1
    //         }, // Menangani skala gambar untuk meningkatkan kualitas
    //         jsPDF: {
    //             unit: 'mm',
    //             format: 'a4',
    //             orientation: 'portrait'
    //         } // Atur ukuran dan orientasi kertas
    //     }).save();
    // }
    function generatePDF() {
        const element = document.getElementById('content-to-export');
        html2pdf().from(element).set({
            margin: [0, 0, 0, 0],
            filename: 'document.pdf',
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'mm',
                format: 'a3',
                orientation: 'portrait'
            } // Format diatur menjadi 'legal'
        }).save();
    }

    function captureAndSaveAsJPEG() {
        const element = document.getElementById('content-to-export');
        const destinasiName = document.getElementById('destinasi-name').innerText;
        html2canvas(element, { scale: 2}).then(canvas => {
            // Ubah kanvas menjadi gambar JPEG
            const imgData = canvas.toDataURL('image/jpeg');
            // Buat link untuk download
            const link = document.createElement('a');
            link.download = `${destinasiName}.jpg`;
            link.href = imgData;
            // Tambahkan link ke dokumen dan klik untuk mengunduh
            document.body.appendChild(link);
            link.click();
            // Hapus link setelah diunduh
            document.body.removeChild(link);
        });
    }
</script>
