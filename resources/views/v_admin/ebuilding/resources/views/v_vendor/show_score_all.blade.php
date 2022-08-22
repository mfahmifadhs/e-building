@extends('v_vendor.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="{{ url('vendor/dashboard') }}" style="color:#17a2b8;">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><b>Data Penilaian</b></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
          <!-- Info Boxes Style 2 -->
          <div class="card card-primary card-outline">
            <div class="card-body">
              <form action="{{ url('vendor/search_score') }}" method="POST">
                @csrf
                <div class="row">
                  <div class="col-md-4">
                    <label>Pilih Tanggal: </label>
                    <div class="form-group">
                      <input type="date" name="start_dt" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <label>&nbsp;</label>
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="-" readonly style="text-align:center;font-weight: bold;">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label>&nbsp;</label>
                    <div class="form-group">
                      <input type="date" name="end_dt" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-3">
                    <label>&nbsp;</label>
                    <p>
                      <button class="btn btn-info"><b>CARI</b></button>
                      <a href="{{ url('vendor/show_score_all') }}" class="btn btn-danger">
                        <i class="fas fa-sync"></i>
                      </a>
                    </p>
                  </div>    
                </div>
              </form>
            </div>
          </div>
      </div>

      <div class="col-md-12">
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
        @if ($message = Session::get('delete'))
          <div class="alert alert-danger">
              <p style="margin:0;">{{ $message }}</p>
          </div>
        @endif
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title-data"><b>DATA PENILAIAN PEGAWAI</b></h3>  
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>NIP </th>
                <th>Petugas</th>
                <th>Penilaian</th>
                <th>Keterangan</th>
                <th>Area Kerja</th>
                <th>Pengawas</th>
                <th>Kategori</th>
                <th>Tanggal</th>
              </tr>
              </thead>
              <tbody style="font-size:13px;">
                <?php $no=1;?>
                @foreach($score as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->id_employee }}</td>
                  <td>{{ $data->emp_name }}</td>
                  <td>{{ $data->criteria_name }}</td>
                  <td>{{ $data->description }}</td>
                  <td>
                      @if($data->score_notes != null)
                        {{ $data->score_notes}}
                      @endif
                      @if($data->score_notes == null)
                        {{ $data->working_area_name}}
                      @endif
                  </td>
                  <td>{{ $data->name }}</td>
                  <td class="text-center">
                    @if($data->emp_category == 'CS')
                      <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                    @endif
                    @if($data->emp_category == 'MM')
                      <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                    @endif
                    @if($data->emp_category == 'GD')
                      <a class="btn btn-warning btn-sm disabled font-weight-bold">GD</a>
                    @endif
                    @if($data->emp_category == 'SC')
                      <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                    @endif
                  </td>
                  <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                      {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>NIP </th>
                <th>Petugas</th>
                <th>Penilaian</th>
                <th>Keterangan</th>
                <th>Area Kerja</th>
                <th>Pengawas</th>
                <th>Kategori</th>
                <th>Tanggal</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection