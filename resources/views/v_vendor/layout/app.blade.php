<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>E-BUILDING | KEMENKES</title>
  <link rel="icon" href="{{ asset('assets/img/logo-ebuilding-1a.jpg') }}"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('assets/img/logo-ebuilding-1a.png') }}" alt="E-BUILDING" width="20%">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Detail Profile -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user-circle fa-2x" style="color:black;"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>
          <div class="dropdown-divider"></div>
          <a href="{{ url('vendor/show_profile', Auth::user()->id ) }}" class="dropdown-item">
            <i class="fas fa-user-cog mr-2"></i> Profil
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('signout') }}" class="dropdown-item dropdown-footer">
            <i class="fas fa-power-off"></i> Keluar
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('vendor/dashboard') }}" class="brand-link">
      <img src="{{ asset('assets/img/logo-ebuilding-1a.png') }}" alt="E-BUILDING" class="brand-image">
      <span class="brand-text font-weight-light"><b>E-BUILDING</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/img/logo-vendor.png') }}" class="img-circle elevation-2" alt="Admin Master">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('vendor/dashboard') }}" class="nav-link {{ request()->is('vendor/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('admin-master/show_working_area') }}" class="nav-link {{ request()->is('admin-master/show_working_area') ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Area Kerja
              </p>
            </a>
          </li>
          <li class="nav-header"><b>PENILAIAN</b></li>
          <li class="nav-item">
            <a href="{{ url('vendor/show_criteria/') }}" class="nav-link {{ request()->is('vendor/show_criteria') ? 'active' : '' }}">
              <i class="fas fa-user-secret nav-icon"></i>
              <p>Kriteria Penilaian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('vendor/show_score_all/') }}" class="nav-link {{ request()->is('vendor/show_score_all') ? 'active' : '' }}">
              <i class="fas fa-people-carry nav-icon"></i>
              <p>Penilaian</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>BIRO UMUM &copy; 2021</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>KEMENKES RI</b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
<!-- Chart -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Data Tables -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>

  function showPassword() {
      var x = document.getElementById("Password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
  }

  function showOldPassword() {
      var x = document.getElementById("OldPassword");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
  }
  function showNewPassword() {
      var x = document.getElementById("NewPassword");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
  }

  $(function () {
      $("#table1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "info":false, "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
      }).buttons().container().appendTo('.col-md-6:eq(0)');

      $("#table1a").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "info":false, "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
      }).buttons().container().appendTo('.col-md-6:eq(0)');

      $("#table1b").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "info":false, "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
      }).buttons().container().appendTo('.col-md-6:eq(0)');

      $("#table1c").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        "info":false, "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
      }).buttons().container().appendTo('.col-md-6:eq(0)');


      //-------------
      //- BAR CHART -
      //-------------
      var url = "{{ url('vendor/chart_rating_2022') }}"
      var Month      = new Array();
      var TotalScore = new Array();
      $(document).ready(function(){
        $.get(url, function(response){
            response.forEach(function(data){
              Month.push(data.month);
              TotalScore.push(data.totalscore);
            });

        var barChartCanvas = $('#barChart').get(0).getContext('2d')
        var barChartData = {
          labels  : Month,
          datasets: [
            {
              label               : 'Total Kartu Kuning',
              backgroundColor     : '#FFC107',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : TotalScore
            }
                
          ]
        }
        var temp0 = barChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
          responsive              : true,
          maintainAspectRatio     : false,
          scales : {
                yAxes : [{
                    ticks : {
                        beginAtZero : true
                    }   
                }]
            }
        }

        new Chart(barChartCanvas, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })
      });
    });
  });

  $(function () {
      //-------------
      //- BAR CHART -
      //-------------
      var url = "{{ url('vendor/chart_rating_2021') }}"
      var Month      = new Array();
      var TotalScore = new Array();
      $(document).ready(function(){
        $.get(url, function(response){
            response.forEach(function(data){
              Month.push(data.month);
              TotalScore.push(data.totalscore);
            });

        var barChartCanvas = $('#ratingChart2021').get(0).getContext('2d')
        var barChartData = {
          labels  : Month,
          datasets: [
            {
              label               : 'Total Kartu Kuning',
              backgroundColor     : '#FFC107',
              borderColor         : 'rgba(60,141,188,0.8)',
              pointRadius          : false,
              pointColor          : '#3b8bba',
              pointStrokeColor    : 'rgba(60,141,188,1)',
              pointHighlightFill  : '#fff',
              pointHighlightStroke: 'rgba(60,141,188,1)',
              data                : TotalScore
            }
                
          ]
        }
        var temp0 = barChartData.datasets[0]
        barChartData.datasets[0] = temp0

        var barChartOptions = {
          responsive              : true,
          maintainAspectRatio     : false,
          scales : {
                yAxes : [{
                    ticks : {
                        beginAtZero : true
                    }   
                }]
            }
        }

        new Chart(barChartCanvas, {
          type: 'bar',
          data: barChartData,
          options: barChartOptions
        })
      });
    });
  });
</script>
</body>
</html>
