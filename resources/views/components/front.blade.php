<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('public/scholar') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
    {{-- quillbot --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ url('public/scholar') }}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{ url('public/scholar') }}/assets/css/templatemo-scholar.css">
    <link rel="stylesheet" href="{{ url('public/scholar') }}/assets/css/owl.css">
    <link rel="stylesheet" href="{{ url('public/scholar') }}/assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- Cropper.js CSS -->
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet">
    <!-- Cropper.js JavaScript -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@latest/dist/html2canvas.min.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.css" rel="stylesheet"> --}}
    @vite('resources/css/app.css')

    <!--

TemplateMo 586 Scholar

https://templatemo.com/tm-586-scholar

-->
</head>

<body>

    {{-- <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div> --}}
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <x-layout-front.header />
    <x-layout-front.notif />
    <!-- ***** Header Area End ***** -->
    {{ $slot }}

    <x-layout-front.footer />

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ url('public/scholar') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ url('public/scholar') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> --}}
    <script src="{{ url('public/scholar') }}/assets/js/isotope.min.js"></script>
    <script src="{{ url('public/scholar') }}/assets/js/owl-carousel.js"></script>
    <script src="{{ url('public/scholar') }}/assets/js/counter.js"></script>
    <script src="{{ url('public/scholar') }}/assets/js/custom.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    
    <script>
        // Inisialisasi peta Leaflet
        var map = L.map('map').setView([-6.2088, 106.8456], 12);

        // Variabel untuk menyimpan referensi marker
        var marker;

        // Tambahkan tile layer (misalnya, dari OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        // Tambahkan kontrol geokode untuk mencari lokasi
        var geocoder = L.Control.Geocoder.nominatim();
        var control = L.Control.geocoder({
            geocoder: geocoder
        }).addTo(map);

        // Tambahkan event listener untuk mendapatkan hasil pencarian
        control.on('markgeocode', function(e) {
            var coordinates = e.geocode.center;
            var fullAddress = e.geocode.name + ' ';

            // Hapus marker jika sudah ada sebelumnya
            if (marker) {
                map.removeLayer(marker);
            }

            // Tambahkan marker baru ke posisi pencarian
            marker = L.marker(coordinates).addTo(map);

            // Tampilkan hasil pencarian di elemen formulir
            document.getElementById('latitude').value = coordinates.lat;
            document.getElementById('longitude').value = coordinates.lng;
            document.getElementById('fullAddress').value = fullAddress;
        });

        // Tambahkan event listener untuk mendapatkan koordinat saat klik
        map.on('click', function(e) {
            var coordinates = e.latlng;

            // Hapus marker jika sudah ada sebelumnya
            if (marker) {
                map.removeLayer(marker);
            }

            // Mencari alamat berdasarkan koordinat
            geocoder.reverse(e.latlng, map.options.crs.scale(map.getZoom()), function(results) {
                var fullAddress = (results[0].name || '') + ' ';

                // Tambahkan marker baru ke posisi klik
                marker = L.marker(coordinates).addTo(map);

                // Tampilkan hasil di elemen formulir
                document.getElementById('latitude').value = coordinates.lat;
                document.getElementById('longitude').value = coordinates.lng;
                document.getElementById('fullAddress').value = fullAddress;
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        function addImageInput() {
            var container = document.getElementById('image-input-container');
            var inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';

            var input = document.createElement('input');
            input.type = 'file';
            input.name = 'foto[]';
            input.className = 'form-control';

            var button = document.createElement('button');
            button.type = 'button';
            button.className = 'btn btn-danger remove-btn';
            button.innerHTML = 'Hapus';
            button.onclick = function() {
                removeImageInput(this);
            };

            inputGroup.appendChild(input);
            inputGroup.appendChild(button);
            container.appendChild(inputGroup);
        }

        function removeImageInput(button) {
            var inputGroup = button.parentNode;
            inputGroup.parentNode.removeChild(inputGroup);
        }
    </script>
    {{-- quillbot --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        var toolbarOptions = [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean'],                                         // remove formatting button

            // ['link', 'image', 'video']                         // link and image, video
        ];

        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        });
    </script> 

</body>

</html>
<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .main-content {
        flex: 1;
    }
</style>
