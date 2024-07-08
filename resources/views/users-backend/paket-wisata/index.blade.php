<x-module.users title="Users | Paket Wisata" url="user/paket-wisata" page="Paket Wisata">
    @if ($list_destinasi->isNotEmpty())
        <div class="card" style="border-radius: 25px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.234); ">
            <div class="card-header">
                <a href="{{ url('user/paket-wisata/create') }}" class="btn btn-dark float-right" style=" font-weight:600;"
                    data-toggle="modal" data-target="#paket-create" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="buat paket anda sekarang">Buat Paket</a>
                <h1 class="card-title text-bold" style="font-size: 2rem;">Data Paket Wisata</h1>
            </div>
            <!-- Button trigger modal -->
            {{-- Modal Create --}}
            @include('users-backend.paket-wisata.modal.create')
            {{-- Modal Create  End --}}
            {{-- Modal Create --}}
            {{-- Modal Create  End --}}
            <div class="card-body">
                <div class="row" id="paket-list">
                    @foreach ($list_paket as $paket)
                        @include('users-backend.paket-wisata.modal.cetak')
                        @include('users-backend.paket-wisata.modal.edit')
                        @include('users-backend.paket-wisata.modal.status')
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                            <a href="{{ url('user/paket', $paket->id) }}/1">
                                <div class="card bg-light d-flex flex-fill"
                                    style="border-radius: 20px; background-image:url('{{ url("public/$paket->foto") }}'); background-size:cover; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3); ">
                                    <div class="position-absolute top-0 left-0 w-100 h-100"
                                        style="background-color: rgba(0, 0, 0, 0.2); border-radius: 20px;"></div>
                                    <div class="card-header text-muted border-bottom-0 text-white text-bold"
                                        style="font-size: 0.8rem;">
                                        <a href="{{ url('user/paket', $paket->id) }}"
                                            class="btn btn-sm btn-light float-right text-bold" data-bs-toggle="tooltip"
                                            data-bs-placement="top"
                                            title="untuk menambahkan aktifitas dan fasilitas pada paket anda">
                                            Tambahkan Aktifitas & Fasilitas
                                        </a>
                                        {{ $paket->destinasi->nama_destinasi }}
                                    </div>
                                    <div class="card-body pt-0" style="color:white;">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $paket->nama_paket_wisata }}</b></h2>
                                                <p class="text-muted text-sm mb-1 text-white"><b>Min Peserta: </b>
                                                    {{ $paket->jumlah_peserta }} orang</p>
                                                <p class="text-muted text-sm mb-1 text-white"><b>Durasi: </b>
                                                    {{ $paket->durasi }}</p>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer" style="z-index: 2">
                                        <div class="text-right">
                                            <a href="#" class="btn btn-sm bg-light" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Cetak" data-toggle="modal"
                                                data-target="#modalcetak{{ $paket->id }}">
                                                <i class="fa fa-print"></i>
                                            </a>
                                            <a class="btn btn-sm bg-light" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Gambar" data-toggle="modal"
                                                data-target="#modalfoto{{ $paket->id }}">
                                                <i class="fa fa-images"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm bg-light" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Edit" data-toggle="modal"
                                                data-target="#editpaket{{ $paket->id }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <x-layout-app.button.delete-button2 path="user/paket/"
                                                id="{{ $paket->id }}" />
                                            @php
                                                $buttonClass = '';
                                                switch ($paket->status_paket) {
                                                    case 1:
                                                        $buttonClass = 'bg-dark';
                                                        break;
                                                    case 2:
                                                        $buttonClass = 'bg-warning';
                                                        break;
                                                    case 3:
                                                        $buttonClass = 'bg-success';
                                                        break;
                                                    case 4:
                                                        $buttonClass = 'bg-info';
                                                        break;
                                                    case 5:
                                                        $buttonClass = 'bg-danger';
                                                        break;
                                                    default:
                                                        $buttonClass = 'bg-dark';
                                                }
                                            @endphp
                                            <a href="#" class="btn btn-sm {{ $buttonClass }} fw-medium"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Ubah Status Paket anda" data-toggle="modal"
                                                data-target="#status{{ $paket->id }}">
                                                {{-- <i class="fas fa-upload"></i> --}}
                                                @switch($paket->status_paket)
                                                    @case(1)
                                                        Draft
                                                    @break

                                                    @case(2)
                                                        Review
                                                    @break

                                                    @case(3)
                                                        Publikasi
                                                    @break

                                                    @case(4)
                                                        Privasi
                                                    @break

                                                    @case(5)
                                                        Diarsipkan
                                                    @break

                                                    @default
                                                        Status tidak diketahui
                                                @endswitch
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @include('users-backend.paket-wisata.modal.foto')
                    @endforeach
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <nav aria-label="Contacts Page Navigation">
                    <ul class="pagination justify-content-center m-0" id="pagination"></ul>
                </nav>
            </div>
        </div>
    @else
        <div class="card" style="border-radius: 20px;">
            <div class="card-header">
                <a href="{{ url('user/destinasi') }}" class="btn btn-dark float-right">tambahkan destinasi</a>
                <h4>silakan tambahkan destinasi terlebih dahulu !</h4>
            </div>
        </div>
    @endif
</x-module.users>
<style>
    .modal-content {
        border-radius: 30px;
    }
    .pagination .page-item.active .page-link {
        background-color: #343a40;
        border-color: #343a40;
        color: white;
    }

    .pagination .page-link {
        color: #343a40;
    }
</style>
@foreach ($list_paket as $paket)
    @include('users-backend.paket-wisata.modal.edit', ['paket' => $paket])
    @include('users-backend.paket-wisata.modal.status', ['paket' => $paket])
    @include('users-backend.paket-wisata.modal.cetak', ['paket' => $paket])
    @include('users-backend.paket-wisata.modal.foto', ['paket' => $paket])
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const listPaket = {!! json_encode($list_paket) !!};
    const itemsPerPage = 6;
    let currentPage = 1;

    function displayPaketList(page) {
        const paketContainer = document.getElementById("paket-list");
        paketContainer.innerHTML = "";
        const start = (page - 1) * itemsPerPage;
        const paginatedPaket = listPaket.slice(start, start + itemsPerPage);

        paginatedPaket.forEach(paket => {
            const paketElement = `
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column paket-item"
                    data-id="${paket.id}">
                    <a href="{{ url('user/paket') }}/${paket.id}/1">
                        <div class="card bg-light d-flex flex-fill"
                            style="border-radius: 20px; background-image:url('{{ url('public/') }}/${paket.foto}'); background-size:cover; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);">
                            <div class="position-absolute top-0 left-0 w-100 h-100"
                                style="background-color: rgba(0, 0, 0, 0.2); border-radius: 20px;"></div>
                            <div class="card-header text-muted border-bottom-0 text-white text-bold"
                                style="font-size: 0.8rem;">
                                ${paket.fasilitas.length > 0
                                    ? `<a href="{{ url('user/paket') }}/${paket.id}" class="btn btn-sm btn-warning float-right text-bold"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="untuk menambahkan aktifitas dan fasilitas pada paket anda">Edit Aktifitas & Fasilitas</a>`
                                    : `<a href="{{ url('user/paket') }}/${paket.id}" class="btn btn-sm btn-light float-right text-bold"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="untuk menambahkan aktifitas dan fasilitas pada paket anda">Tambahkan Aktifitas & Fasilitas</a>`
                                }
                                ${paket.destinasi.nama_destinasi}
                            </div>
                            <div class="card-body pt-0" style="color:white;">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="lead"><b>${paket.nama_paket_wisata}</b></h2>
                                        <p class="text-muted text-sm mb-1 text-white"><b>Min Peserta: </b>${paket.jumlah_peserta} orang</p>
                                        <p class="text-muted text-sm mb-1 text-white"><b>Durasi: </b>${paket.durasi}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="z-index: 2">
                                <div class="text-right">
                                    <a href="#" class="btn btn-sm bg-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Cetak paket" data-toggle="modal"
                                        data-target="#modalcetak${paket.id}">
                                        <i class="fa fa-print"></i>
                                    </a>
                                    <a class="btn btn-sm bg-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Gambar" data-toggle="modal"
                                        data-target="#modalfoto${paket.id}">
                                        <i class="fa fa-images"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm bg-light" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Edit Data Paket" data-toggle="modal"
                                        data-target="#editpaket${paket.id}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <x-layout-app.button.delete-button2 path="user/paket/"
                                        id="${paket.id}" />
                                    ${(() => {
                                        let buttonClass = '';
                                        switch (paket.status_paket) {
                                            case 1: buttonClass = 'bg-dark'; break;
                                            case 2: buttonClass = 'bg-warning'; break;
                                            case 3: buttonClass = 'bg-success'; break;
                                            case 4: buttonClass = 'bg-info'; break;
                                            case 5: buttonClass = 'bg-danger'; break;
                                            default: buttonClass = 'bg-dark';
                                        }
                                        return `<a href="#" class="btn btn-sm ${buttonClass} fw-medium"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Ubah Status Paket anda" data-toggle="modal"
                                            data-target="#status${paket.id}">
                                            ${(() => {
                                                switch (paket.status_paket) {
                                                    case 1: return 'Draft';
                                                    case 2: return 'Review';
                                                    case 3: return 'Publikasi';
                                                    case 4: return 'Privasi';
                                                    case 5: return 'Diarsipkan';
                                                    default: return 'Status tidak diketahui';
                                                }
                                            })()}
                                        </a>`;
                                    })()}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            `;
            paketContainer.innerHTML += paketElement;
        });
    }

    function setupPagination() {
        const paginationContainer = document.getElementById("pagination");
        const pageCount = Math.ceil(listPaket.length / itemsPerPage);
        let html = "";

        for (let i = 1; i <= pageCount; i++) {
            html += `
                <li class="page-item ${i === currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                </li>
            `;
        }

        paginationContainer.innerHTML = html;
    }

    window.changePage = function(page) {
        currentPage = page;
        displayPaketList(currentPage);
        setupPagination();
    }

    displayPaketList(currentPage);
    setupPagination();
});
</script>