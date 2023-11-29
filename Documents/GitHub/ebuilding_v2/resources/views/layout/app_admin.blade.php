<body class="hold-transition sidebar-mini sidebar-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
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
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="{{ route('dashboard') }}" class="brand-link text-center">
                <img src="{{ asset('dist/img/logo-ebuilding.png') }}" alt="E-Building" class="img-fluid" width="100">
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">
                            <h6>{{ Auth::user()->pegawai->nama_pegawai }}</h6>
                        </a>
                    </div>
                </div>

                <nav class="mt-2 mb-5">
                    <ul class="nav nav-pills nav-sidebar flex-column m" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('penilaian.show') }}" class="nav-link">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>Penilaian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Kriteria Penilaian
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('kriteria.show') }}" class="nav-link">
                                        <i class="nav-icon fas fa"></i>
                                        <p>Daftar Kriteria Penilaian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('kriteria.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usds"></i>
                                        <p>Tambah Kriteria Penilaian</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header font-weight-bold">Area Kerja</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-vihara"></i>
                                <p>
                                    Area Kerja
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('area_kerja.show') }}" class="nav-link">
                                        <i class="nav-icon fas fa"></i>
                                        <p>Daftar Area Kerja</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('area_kerja.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usds"></i>
                                        <p>Tambah Area Kerja</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-hotel"></i>
                                <p>
                                    Gedung Kemenkes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('gedung.show') }}" class="nav-link">
                                        <i class="nav-icon fas fa"></i>
                                        <p>Daftar Gedung</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('gedung.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usds"></i>
                                        <p>Tambah Gedung</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header font-weight-bold">Pegawai</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Pengguna
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('user.show') }}" class="nav-link">
                                        <i class="nav-icon fas fa"></i>
                                        <p>Daftar Pengguna</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('user.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usds"></i>
                                        <p>Tambah Pengguna</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Pegawai
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('pegawai.show') }}" class="nav-link">
                                        <i class="nav-icon fas fa"></i>
                                        <p>Daftar Pegawai</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pegawai.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usds"></i>
                                        <p>Tambah Pegawai</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Penyedia
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ">
                                <li class="nav-item">
                                    <a href="{{ route('penyedia.show') }}" class="nav-link">
                                        <i class="nav-icon fas fa"></i>
                                        <p>Daftar Penyedia</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('penyedia.create') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hand-holding-usds"></i>
                                        <p>Tambah Penyedia</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            @yield('content')
            <br>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2022 <a href="https://roum.kemkes.go.id/">Biro Umum</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2
            </div>
        </footer>
    </div>
</body>
