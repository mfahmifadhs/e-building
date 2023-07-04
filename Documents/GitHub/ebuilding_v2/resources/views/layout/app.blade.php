<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-BUILDING</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icon Title -->
    <link rel="icon" type="image/png" href="{{ asset('dist/img/logo-kemenkes-icon.png') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('dist/plugins/select2/css/select2.min.css') }}">
</head>

@extends(Auth::user()->role_id == 4 ? 'layout.app_user' : 'layout.app_admin')

<script src="{{ asset('dist/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('dist/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>

<script src="{{ asset('dist/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('dist/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('dist/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('dist/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<script src="{{ asset('dist/plugins/chart.js/Chart.min.js') }}"></script>

<script src="{{ asset('dist/js/demo.js') }}"></script>
<script src="{{ asset('dist/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('dist/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('dist/plugins/pdfmake/pdfmake.js') }}"></script>
<script src="{{ asset('dist/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dist/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('dist/plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@yield('js')
<script>
    $(function() {
        var url = window.location;
        // for single sidebar menu
        $('ul.nav-sidebar a').filter(function() {
            return this.href == url;
        }).addClass('active');

        // for sidebar menu and treeview
        $('ul.nav-treeview a').filter(function() {
                return this.href == url;
            }).parentsUntil(".nav-sidebar > .nav-treeview")
            .css({
                'display': 'block'
            })
            .addClass('menu-open').prev('a')
            .addClass('active');
    });
</script>

</html>
