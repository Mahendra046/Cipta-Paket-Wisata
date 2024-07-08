@section('title', 'Profil')
<x-front>
    <div class="row pt-5"></div>
    <div class="contact-us section" id="join">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 align-self-center">
                    <div class="section-heading">
                        <h6>Profil</h6>
                        @if (auth()->user()->foto != null && auth()->user()->no_wa != null)
                            <h2>Profil Anda Sudah Lengkap</h2>
                            <p>Silahkan melanjutkan pembuatan paket wisata anda</p>
                            <a href="{{url('user/paket')}}">        
                                <button  class="btn btn-dark">Buat Paket Sekarang</button>
                                </a>
                        @else
                            <h2>Lengkapi Profil Anda</h2>
                            <p>Silahkan lengkapi profil untuk melanjutkan pembuatan paket wisata anda!</p>
                        @endif

                        @php
                            $foto = auth()->user()->foto;
                        @endphp
                        <div class="special-offer">
                            <span class="offer">
                                @if (Auth::user()->foto != null)
                                    <img id="preview-img"
                                        src="{{ url("public/$foto") }}"
                                        alt="">
                                @else
                                    <img id="preview-img" src="{{ url('public/scholar/assets/images/user.jpg') }}"
                                        alt="">
                                @endif
                            </span>
                            <h6>{{ auth()->user()->name }}</h6>
                            <h4>{{ auth()->user()->email }}</h4>
                            @if (auth()->user()->foto != null && auth()->user()->no_wa != null)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                                    <i class="fa fa-check"></i>
                                </a>
                            @else
                                <a href="#" class="wave-button" data-bs-toggle="modal"
                                    data-bs-target="#profileModal">
                                    <i class="fa fa-exclamation"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="contact-us-content">
                        <form id="contact-form" action="{{ url('profil') }}/{{ auth()->user()->id }}"
                            method="post" enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="text" name="name" value="{{ auth()->user()->name }}"
                                            placeholder="Nama Anda..." autocomplete="on" required autocomplete="off">
                                        <input type="hidden" name="email" value="{{ auth()->user()->email }}" autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="text" name="no_wa" value="{{ auth()->user()->no_wa }}"
                                            placeholder="No WhatsApp..." required autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="text" name="instagram" value="{{ auth()->user()->instagram }}"
                                            placeholder="Akun Instagram (Opsional)..." autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="text" name="facebook" value="{{ auth()->user()->facebook }}"
                                            placeholder="Akun Facebook (Opsional)..." autocomplete="off">
                                    </fieldset>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <input type="file" id="foto" name="foto" placeholder="Pilih Foto..."
                                            style="padding-top: 11px">
                                        <input type="hidden" name="cropped_image" id="cropped_image">
                                    </fieldset>
                                    <div class="preview-container">
                                        <img id="preview-img" src="" alt="Preview Image"
                                            style="display: none; max-width: 100px; max-height: 100px; margin-top: 10px;">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <fieldset>
                                        <button type="submit" id="form-submit" class="orange-button">Perbarui
                                            Profil</button>
                                    </fieldset>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="profileModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-body p-5">
                    <h2 class="fw-bold mb-0">Lengkapi Profil</h2>

                    <ul class="d-grid gap-4 my-5 list-unstyled small">
                        <li class="d-flex gap-4">
                            <svg class="bi text-body-secondary flex-shrink-0" width="48" height="48">
                                <use xlink:href="#grid-fill"></use>
                            </svg>
                            <div>
                                <h5 class="mb-0">Grid view</h5>
                                Not into lists? Try the new grid view.
                            </div>
                        </li>
                        <li class="d-flex gap-4">
                            <svg class="bi text-warning flex-shrink-0" width="48" height="48">
                                <use xlink:href="#bookmark-star"></use>
                            </svg>
                            <div>
                                <h5 class="mb-0">Bookmarks</h5>
                                Save items you love for easy access later.
                            </div>
                        </li>
                        <li class="d-flex gap-4">
                            <svg class="bi text-primary flex-shrink-0" width="48" height="48">
                                <use xlink:href="#film"></use>
                            </svg>
                            <div>
                                <h5 class="mb-0">Video embeds</h5>
                                Share videos wherever you go.
                            </div>
                        </li>
                    </ul>
                    <button type="button" class="btn btn-lg btn-primary mt-5 w-100" data-bs-dismiss="modal">Great,
                        thanks!</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropperModalLabel">Adjust Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="imageToCrop" src="" alt="Image to Crop">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropButton">Crop</button>
                </div>
            </div>
        </div>
    </div>
</x-front>
<!-- Modal for cropping -->
<div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cropperModalLabel">Adjust Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img id="imageToCrop" src="" alt="Image to Crop">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cropButton">Crop</button>
            </div>
        </div>
    </div>
</div>

<style>
    .contact-us .special-offer {
        position: relative;
        /* margin-top: 20px; */
    }

    .contact-us .special-offer span.offer {
        position: absolute;
        left: 0px;
        top: 0;
        width: 120px;
        height: 120px;
        border-radius: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        overflow: hidden;
    }

    .contact-us .special-offer span.offer img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
    }

    .contact-us .special-offer h6 {
        margin-top: 2%;
        margin-left: 10%;
    }

    .contact-us .special-offer h4 {
        margin-top: 1%;
        margin-left: 10%;
        font-weight: normal;
        font-size: 80%;
    }

    .wave-button {
        position: relative;
        display: inline-block;
        padding: 10px;
        border: none;
        background-color: transparent;
        cursor: pointer;
        outline: none;
    }

    .wave-button i {
        font-size: 34px;
        color: #fffdfa;
    }

    .wave-button::before,
    .wave-button::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid #ecebe9;
        border-radius: 50%;
        opacity: 0;
        transform: translate(-50%, -50%);
        animation: wave-animation 1.5s infinite;
    }

    .wave-button::after {
        animation-delay: 0.75s;
    }

    @keyframes wave-animation {
        0% {
            opacity: 1;
            width: 20px;
            height: 20px;
        }

        100% {
            opacity: 0;
            width: 100px;
            height: 100px;
        }
    }

    .preview-container {
        text-align: center;
    }

    .preview-container img {
        display: block;
        margin: 0 auto;
        border: 1px solid #ddd;
        padding: 5px;
        background: #fff;
    }

    /* Responsiveness */
    @media (max-width: 991px) {
        .col-lg-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .modal-dialog {
            max-width: 90%;
        }

        .special-offer span.offer {
            width: 80px;
            height: 80px;
        }

        .special-offer span.offer img {
            width: 60px;
            height: 60px;
        }
    }

    @media (max-width: 576px) {
        .special-offer span.offer {
            left: 20px;
            width: 60px;
            height: 60px;
        }

        .special-offer span.offer img {
            width: 40px;
            height: 40px;
        }

        .wave-button i {
            font-size: 24px;
        }
    }

    @media (max-width: 100%) {
        .contact-us .special-offer span.offer {
            position: absolute;
            left: 20px;
        }
    }
</style>


<script>
    function previewImage(event) {
        const input = event.target;
        const reader = new FileReader();

        reader.onload = function() {
            const previewImg = document.getElementById('preview-img');
            previewImg.src = reader.result;
        }

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        let cropper;
        const inputFile = document.getElementById('foto');
        const imageToCrop = document.getElementById('imageToCrop');
        const previewImg = document.getElementById('preview-img');
        const cropButton = document.getElementById('cropButton');
        const croppedImageInput = document.getElementById('cropped_image');

        inputFile.addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                imageToCrop.src = e.target.result;
                if (cropper) {
                    cropper.destroy();
                }
                cropper = new Cropper(imageToCrop, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    background: false,
                });
                const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
                cropperModal.show();
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        cropButton.addEventListener('click', function() {
            const canvas = cropper.getCroppedCanvas({
                width: 100,
                height: 100,
            });
            canvas.toBlob(function(blob) {
                const file = new File([blob], 'cropped_image.png', {
                    type: 'image/png'
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                inputFile.files = dataTransfer.files;

                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(file);

                const cropperModal = bootstrap.Modal.getInstance(document.getElementById(
                    'cropperModal'));
                cropperModal.hide();
            });
        });
    });
</script>
