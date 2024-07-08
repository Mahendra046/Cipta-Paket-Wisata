<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('public/admin') }}/fontawesome-free-6.5.1-web/css/all.css">
    <link rel="stylesheet" href="{{ url('public/admin/login') }}/style.css">
    @vite('resources/css/app.css')
    <title>Modern Login Page | RZN</title>
</head>
<style>
    .alert {
    padding: 15px;
    margin-bottom: 20px;
    border: 1px solid transparent;
    border-radius: 4px;
  }

  .alert-danger {
    font-weight: 500;
    color: #fcfcfc;
    background-color: #d13744;
    border-color: #ca4653;
  }
</style>
<body>
    @if (isset($message))
    <div class="alert alert-danger">{{ $message }}</div>
    @endif
    {{-- <x-layout-front.notif/> --}}
    <div class="logo">
        <img src="{{ url('public/admin/login') }}/img/cpw-logo.png" class="elevation-2" alt="logo">
        <span>Cipta Paket Wisata</span>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="#">
                <h1>Create Account</h1>

                <div class="social-icons">
                    <a href="{{ route('google.redirect') . '?_token=' . csrf_token() }}" class="icon">
                        <i class="fa-brands fa-google-plus-g"></i>
                    </a>
                </div>
                <span>atau gunakan email untuk mendaftar</span>
                <input type="text" placeholder="Name">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <button>Daftar</button>
            </form>
        </div>

        <div class="form-container sign-in">
            <form action="{{ url('login') }}" method="POST">
                @csrf
                <h1>Masuk</h1>
                <div class="social-icons">
                    <a href="{{ route('google.redirect') . '?_token=' . csrf_token() }}" class="icon">
                        <i class="fa-brands fa-google-plus-g"></i>
                    </a>

                </div>
                <span>atau gunakan email untuk masuk</span>
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <a href="#">lupa password</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="togle-container">
            <div class="togle">
                <div class="togle-panel togle-left">
                    <h1>Selamat Datang!</h1>
                    <p>Masukkan detail pribadi Anda untuk menggunakan semua fitur situs</p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="togle-panel togle-right">
                    <h1>Hallo!</h1>
                    <p>Daftarkan detail pribadi Anda untuk menggunakan semua fitur situs</p>
                    <button class="hidden" id="register">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('public/admin/login') }}/script.js"></script>
</body>

</html>
