<body class="layout-top-nav" style="height: auto;">
    <div class="wrapper">

        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="{{ route('dashboard') }}" class="navbar-brand">
                    <img src="{{ asset('dist/img/logo-ebuilding.png') }}" alt="E-Building" class="brand-image" style="opacity: .8">
                    <span class="brand-text font-weight-light">E-Building</span>
                </a>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown text-capitalize">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-user-circle"></i>
                            <b>{{ Auth::user()->pegawai->nama_pegawai }}</b>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-item dropdown-header">
                                {{ Auth::user()->pegawai->nama_pegawai }} <br> {{ Auth::user()->pegawai->instansi }}
                            </span>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('admin-user/profil/user/'. Auth::user()->id) }}" class="dropdown-item">
                                <i class="fas fa-user mr-2"></i> Profil
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('keluar') }}" class="dropdown-item dropdown-footer">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="content-wrapper" style="min-height: 730.4px;">
            @yield('content')
        </div>



        <aside class="control-sidebar control-sidebar-dark" style="display: none;">

            <div class="p-3 control-sidebar-content text-capitalize">
                <h5>{{ Auth::user()->pegawai->nama_pegawai }}</h5>
                <p class="card-text">
                    {{ Auth::user()->pegawai->instansi == 'kemenkes' ? Auth::user()->pegawai->unitKerja->nama_unit_kerja :
                       Auth::user()->pegawai->penyedia->nama_penyedia }}
                </p>
                <hr class="mb-2">
                <div class="mb-4"><input type="checkbox" value="1" class="mr-1"><span>Dark Mode</span></div>
                <h6>Header Options</h6>
            </div>
        </aside>


        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>

<script>
    // Select
    $(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        $("#pegawai").select2()
    })
</script>
