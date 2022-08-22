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
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
          <a href="{{ url('pengawas/show_profile') }}" class="dropdown-item">
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
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('assets/img/logo-ebuilding-1a.png') }}" alt="E-BUILDING" class="brand-image">
      <span class="brand-text font-weight-light"><b>E-BUILDING</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/img/logo-pengawas.png') }}" class="img-circle elevation-2" alt="Admin Master">
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
            <a href="{{ url('pengawas/dashboard') }}" class="nav-link {{ request()->is('pengawas/dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-header"><b>DATA PEGAWAI</b></li>
          <li class="nav-item">
            <a href="{{ url('pengawas/show_pegawai') }}" class="nav-link {{ request()->is('pengawas/show_pegawai') ? 'active' : '' }}">
              <i class="fas fa-users nav-icon"></i>
              <p>Pegawai</p>
            </a>
          </li>
          <li class="nav-header"><b>DATA PENILAIAN</b></li>
          <li class="nav-item">
            <a href="{{ url('pengawas/show_criteria') }}" class="nav-link {{ request()->is('pengawas/show_criteria') ? 'active' : '' }}">
              <i class="fas fa-clipboard-list nav-icon"></i>
              <p>Kriteria Penilaian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('pengawas/show_score') }}" class="nav-link {{ request()->is('pengawas/show_score') ? 'active' : '' }}">
              <i class="far fa-envelope nav-icon"></i>
              <p>Data Penilaian</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
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
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/js/demo.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<!-- Chart -->
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
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

    $("#table2a").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength":4
    }).buttons().container().appendTo('.col-md-6:eq(0)');

    $("#table2b").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength":4
    }).buttons().container().appendTo('.col-md-6:eq(0)');

    $("#table2c").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength":4
    }).buttons().container().appendTo('.col-md-6:eq(0)');

    $("#table2d").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength":4
    }).buttons().container().appendTo('.col-md-6:eq(0)');

    $("#table2e").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength":4
    }).buttons().container().appendTo('.col-md-6:eq(0)');

    $("#table3").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "searching":false
    }).buttons().container().appendTo('.col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });

  $(function () {
    //-------------
    //- BAR CHART BANQUET & MULTIMEDIA -
    //-------------
    var url = "{{ url('pengawas-khusus/chart_discovery') }}"
    var WorkingArea   = new Array();
    var TotalDiscovery = new Array();
    $(document).ready(function(){
      $.get(url, function(response){
          response.forEach(function(data){
            WorkingArea.push(data.working_area_name);
            TotalDiscovery.push(data.totaldiscovery);
          });
      var barChartCanvas = $('#chartDiscovery').get(0).getContext('2d')
      var barChartData = {
        labels  : WorkingArea,
        datasets: [
          {
            label               : 'Total Temuan',
            backgroundColor     : ['#26aaff','#4ddec1'],
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : TotalDiscovery
          }
              
        ]
      }

        var barChartOptions = {
            title: {
              display: true,
              text: 'Total Temuan',
              position: 'top',
              fontSize: 16,
              fontColor: '#111',
              padding: 20
          },
          legend: {
            display: true,
            position: 'bottom',
            labels: {
                boxWidth: 20,
                fontColor: '#111',
                padding: 15
            }
        },
          responsive: true,
          maintainAspectRatio     : false,
              scaleLabel: {
               display: true,
               labelString: "Percentage"
           }
        }

        new Chart(barChartCanvas, {
          type: 'doughnut',
          data: barChartData,
          options: barChartOptions
        })
      });
    });

  });
  // ====================
  // SELECT DATA PEGAWAI
  // ====================

  var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
  $(document).ready(function(){

    $( "#select-area" ).select2({
      ajax: { 
        url: "{{ url('pengawas-khusus/get_area') }}",
        type: "post",
        dataType: 'json',
        delay: 250,
        data: function (params) {
          return {
            _token: CSRF_TOKEN,
            search: params.term // search term
          };
        },
        processResults: function (response) {
          return {
            results: response
          };
        },
        cache: true
      }

    });

  });


</script>
</body>
</html>
