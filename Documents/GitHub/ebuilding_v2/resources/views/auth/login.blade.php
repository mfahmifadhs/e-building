<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIPORSAT KEMENKES RI</title>

    <!-- Icon Title -->
    <link rel="icon" type="image/png" href="{{ asset('dist/img/logo-kemenkes-icon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
</head>

<body class="hold-transition login-page bg-cover">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="form-group first">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p style="color:white;margin: auto;">{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('failed'))
            <div class="alert alert-danger">
                <p style="color:white;margin: auto;">{{ $message }}</p>
            </div>
            @endif
        </div>
        <div class="card" style="border-radius: 20px;">
            <div class="card-header text-center">
                <a href="{{ url('/') }}">
                    <p><img src="{{ url('dist/img/logo-ebuilding.png') }}" class="img-fluid"></p>
                </a>
                <span class="text-uppercase text-center small font-weight-bold">
                    Sistem Informasi Manajemen <br> Penilaian Jasa Pengelola Gedung
                </span>
            </div>
            <div class="card-body">
                <form action="{{ route('post.login', Crypt::encrypt('masuk.post')) }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text rounded-left">
                                <span class="fas fa-users"></span>
                            </div>
                        </div>
                        <input type="text" name="nip" class="form-control" placeholder="Username">
                    </div>
                    <div class="input-group mb-3" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text rounded-left">
                                <a type="button" onclick="lihatPassword()"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                            </div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <button type="submit" class="btn btn-block btn-primary">
                            Masuk
                        </button>
                    </div>
                </form>

                <p class="mb-1">
                    <a href="#">Lupa password ?</a>
                </p>
                <p class="mb-0">
                    <a href="https://wa.me/6285772652563" class="text-center">Bantuan</a>
                </p>
            </div>
            <div class="card-footer text-center">
                <img src="{{ url('dist/img/icon-germas.png') }}" class="img-fluid" width="50">
                <img src="{{ url('dist/img/icon-kemenkes.png') }}" class="img-fluid" width="50">
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- Lihat Password -->
    <script type="text/javascript">
        function lihatPassword() {
            var x = document.getElementById("password");
            if ($('#password input').attr("type") == "password") {
                $('#password input').attr('type', 'text');
                $('#password i').addClass("fa-eye-slash");
                $('#password i').removeClass("fa-eye");
            } else {
                $('#password input').attr('type', 'password');
                $('#password i').removeClass("fa-eye-slash");
                $('#password i').addClass("fa-eye");
            }
        }
    </script>
</body>

</html>
