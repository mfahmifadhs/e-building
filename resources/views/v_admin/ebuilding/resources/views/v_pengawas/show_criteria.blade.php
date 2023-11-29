@extends('v_pengawas.layout.app')

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

    <!-- KRITERIA BANQUET MM -->
    @if($data->is_banquet_multimedia == 1 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 0)
      <div class="col-md-12">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Banquet & MM</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1c" class="table table-bordered table-striped">
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
    @endif

    <!-- KRITERIA CLEANING SERVICE -->
    @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 1 & $data->is_security == 0)
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Cleaning Service</b></h3>
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
                @foreach($cleanservice as $row)
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

    <!-- KRITERIA TAMAN -->
    @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 1 & $data->is_cleaning_service == 0 & $data->is_security == 0)
      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Taman</b></h3>
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
        </div>
      </div>
    @endif

    <!-- KRITERIA SECURITY -->
    @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 1)
      <div class="col-md-12">
        <div class="card card-dark">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Security</b></h3>
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    @endif

    <!-- KRITERIA SEMUA -->
    @if($data->is_banquet_multimedia == 1 & $data->is_gardener == 1 & $data->is_cleaning_service == 1 & $data->is_security == 1)
      <div class="col-md-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Cleaning Service</b></h3>
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
                @foreach($cleanservice as $row)
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

      <!-- Kriteria Penilaian Security -->
      <div class="col-md-6">
        <div class="card card-dark">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Security</b></h3>
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
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      <!-- Kriteria PENILAIAN Taman -->
      <div class="col-md-6">
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Taman</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1b" class="table table-bordered table-striped">
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

      <!-- Kriteria Penilaian Banquet & MM -->
      <div class="col-md-6">
        <div class="card card-warning">
          <div class="card-header">
            <h3 class="card-title-data"><b>Kriteria Penilaian Banquet & MM</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1c" class="table table-bordered table-striped">
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
    @endif

    </div>
  </div>
</section>
@endforeach

@endsection