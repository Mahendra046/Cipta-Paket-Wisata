<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('public/admin') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('public/admin') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('public/admin') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ url('public/admin') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('public/admin') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('public/admin') }}/plugins/summernote/summernote-bs4.min.css">
    <link rel="shortcut icon" href="{{ url('public/admin') }}/dist/img/cpt-logonew.png" type="image/x-icon">
    <link rel="stylesheet" href="{{ url('public/admin') }}/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Quill-->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    @stack('style')
    @vite('resources/css/app.css')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900");

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <x-layout-app.navbar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <x-layout-app.sidebar :menu="$menu" />

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-5" style="background-image:url('{{ url('public/admin/dist/img/bg-1.jpg') }}');">
            <div class="dark-overlay"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(90, 88, 88, 0.106);">
            </div>
            <!-- Content Header (Page header) -->
            <div class="content-header pt-4">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-white">{{ $page }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url($url) }}"
                                        class="text-dark">{{ $menu }}</a></li>
                                <li class="breadcrumb-item active text-dark">{{ $page }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid pb-5">
                    <div class="row">
                        <div class="col-lg-12 pb-5">
                            <x-layout-app.utils.notif />
                            <x-layout-front.notif />

                            {{ $slot }}
                        </div>
                        <!-- /.col-md-6 -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        {{-- <x-layout-app.control-sidebar /> --}}
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <x-layout-app.footer />
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ url('public/admin') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('public/admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('public/admin') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="{{ url('public/admin') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ url('scholar') }}/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@latest/dist/html2canvas.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    @stack('script')
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
        // Update editor height on resize
    </script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote()

            // CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 5, // Menampilkan hanya 5 data per halaman
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "pageLength": 5 // Menampilkan hanya 5 data per halaman
            });
        });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
