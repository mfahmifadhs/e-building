@extends('v_vendor.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kriteria Penilaian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ url('pengawas/dashboard') }}" style="color:#17a2b8;">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><b>Kriteria Penilaian</b></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
@foreach($pegawai as $data)
<section class="content">
  <div class="container-fluid">
    <div class="row">

    <!-- KRITERIA PT. SENDIKA -->
    @if($data->id == 2)
      <div class="col-md-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Banquet & MM</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($banquetmm as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->criteria_name }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <div class="col-md-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Taman</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1a" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($gardener as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->criteria_name }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    @endif

    <!-- KRITERIA PT. ALFIRA -->
    @if($data->id == 3)
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Banquet & Multimedia</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($banquetmm as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->criteria_name }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    @endif

    <!-- KRITERIA PT. TRANS DANA -->
    @if($data->id == 4)
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Security</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($security as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->criteria_name }}</td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    @endif

    </div>
  </div>
</section>
@endforeach

@endsection