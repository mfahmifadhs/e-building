<html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>E-BUILDING | KEMENKES</title>
  <link rel="icon" href="{{ asset('assets/img/logo-ebuilding-1a.jpg') }}"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
</head>
<body class="login-page" style="min-height: 496.391px;">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <div class="login-logo">
          <center>
            <h3 style="font-size:2vh;"><b>Sistem Informasi Pengawasan Kinerja <br>Jasa Pengelolaan Gedung</b></h3>
            <img class="animation__shake img-responsive" src="{{ asset('assets/img/logo-ebuilding-1a.jpg') }}" alt="KEMENKES" class="brand-image img-circle elevation-3" style="opacity: .8" width="70%">
          </center>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p style="margin:0;">{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('failed'))
            <div class="alert alert-danger">
                <p style="margin:0;">{{ $message }}</p>
            </div>
        @endif
        <form action="{{ route('login.custom') }}" method="post">
        @csrf
          <div class="input-group mb-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-4">
            <input type="password" name="password" class="form-control" id="Password" placeholder="Password" minlength="6" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <a type="button" onclick="showPassword()">
                  <i class="fas fa-eye show-password"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-info btn-block">Login</button><br>
              <span>Lihat Panduan Penggunaan <a href="https://drive.google.com/file/d/1tjcdIL-fp6J5HETv3A-SbWf8YlmMHlUT/view?usp=sharing" style="color:blue;"><u>Disini</u></a></span>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<!-- Show Password -->
<script type="text/javascript">
    function showPassword() {
      var x = document.getElementById("Password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>


</body>
</html>