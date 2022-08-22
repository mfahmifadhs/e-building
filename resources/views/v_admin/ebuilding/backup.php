    <html lang="en">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Cleaning Service Monitoring</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
      <!-- Tempusdominus Bootstrap 4 -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
      <!-- JQVMap -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
      <!-- Theme style -->
      <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
      <!-- summernote -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
        <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
      <!-- Select 2 -->
      <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    </head>











    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <!-- <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script> -->
    <!-- Sparkline -->
    <!-- <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script> -->
    <!-- JQVMap -->
    <!-- <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script> -->
    <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('asset/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <!-- DataTables  & Plugins -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script> -->
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });

        $('.select2').select2()

      });

      //Menampilkan Lokasi Lantai Sesuai Gedung
      $('#building').change(function(){
          var buildId = $(this).val();    
          if(buildId){
              $.ajax({
                 type:"GET",
                 url:"/pengawas/get_floor?buildId="+buildId,
                 dataType: 'JSON',
                 success:function(res){               
                  if(res){
                      $("#floor").empty();
                      $("#floor").append('<option>---Pilih Lantai---</option>');
                      $.each(res,function(floor_name,id){
                          $("#floor").append('<option value="'+id+'">'+floor_name+'</option>');
                      });
                  }else{
                     $("#floor").empty();
                  }
                 }
              });
          }else{
              $("#floor").empty();
          }      
         });      

      //Menampilkan Pegawai Sesuai Lokasi Lantai dan Gedung
      $('#floor').change(function(){
          var pegawaiId = $(this).val();    
          if(pegawaiId){
              $.ajax({
                 type:"GET",
                 url:"/pengawas/get_pegawai?pegawaiId="+pegawaiId,
                 dataType: 'JSON',
                 success:function(res){               
                  if(res){
                      $("#pegawai").empty();
                      $("#pegawai").append('<option>---Pilih Pegawai---</option>');
                      $.each(res,function(cleaningservice_id,jobplacement_id){
                          $("#pegawai").append('<option value="'+jobplacement_id+'">'+cleaningservice_id+'</option>');
                      });
                  }else{
                     $("#pegawai").empty();
                  }
                 }
              });
          }else{
              $("#pegawai").empty();
          }      
         });

    // CSRF Token
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // $(document).ready(function(){

        //   $( "#search-pegawai" ).select2({
        //     ajax: { 
        //       url: "{{ url('pengawas/get_pegawai2') }}",
        //       type: "post",
        //       dataType: 'json',
        //       delay: 250,
        //       data: function (params) {
        //         return {
        //           _token: CSRF_TOKEN,
        //           search: params.term // search term
        //         };
        //       },
        //       processResults: function (response) {
        //         return {
        //           results: response
        //         };
        //       },
        //       cache: true
        //     }

        //   });

        // });

    </script>
    </body>
</html>