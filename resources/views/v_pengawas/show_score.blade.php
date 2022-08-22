@extends('v_pengawas.layout.app')

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
            <a href="{{ url('pengawas/dashboard') }}" style="color:#17a2b8;">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><b>Penilaian</b></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->


@foreach($pegawai as $data)
<!-- Data Penilaian content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
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
        @if ($message = Session::get('error'))
          <div class="alert alert-danger">
              <p style="margin:0;">{{ $message }}</p>
          </div>
        @endif
      </div>
      <div class="col-md-3">
          <!-- Info Boxes Style 2 -->
          <div class="card card-primary">
            <div class="card-body">
              <form action="{{ url('pengawas/search_score') }}" method="POST">
                @csrf
                <div class="col-md-12">
                  <label>Pilih Tanggal: </label>
                  <div class="form-group">
                    <input type="date" name="start_dt" class="form-control">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="date" name="end_dt" class="form-control">
                  </div>
                </div>
                @if($data->is_banquet_multimedia == 1 & $data->is_gardener == 1 & $data->is_cleaning_service == 1 & $data->is_security == 1)
                <div class="col-md-12">
                  <label>Pilih Petugas:</label>
                  <div class="form-group">
                    <select class="form-control" name="emp_category">
                      <option value="">-- Pilih Petugas --</option>
                      <option value="bm">BANQUET & MULTIMEDIA</option>
                      <option value="cs">CLEANING SERVICES</option>
                      <option value="sc">SECURITY</option>
                      <option value="gd">TAMAN</option>
                    </select>
                  </div>
                </div>
                @endif
                <div class="col-md-12">
                  <p>
                    <button class="btn btn-info btn-sm"><b>CARI</b></button>
                    <a href="{{ url('pengawas/show_score') }}" class="btn btn-danger btn-sm">
                      <i class="fas fa-sync"></i>
                    </a>
                  </p>
                </div>    
              </form>
            </div>
          </div>
      </div>

      <div class="col-md-9">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title-data"><b>HASIL PENILAIAN</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">             
              <div class="col-md-12">
                <div class="form-group">
                  <table id="table1" class="table table-bordered table-striped" style="font-size:14px;">
                    <thead>
                      <tr>
                        <th>No </th>
                        <th>NIP </th>
                        <th>Nama</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=1;?>
                      @foreach($score as $data)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $data->id_employee }}</td>
                        <td>{{ $data->emp_name }}</td>
                        <td>
                          @if($data->score_notes != null)
                            {{ $data->score_notes}}
                          @endif
                          @if($data->score_notes == null)
                            {{ $data->working_area_name}}
                          @endif
                        </td>
                        <td>{{ $data->total_score }} Kartu Kuning</td>
                        <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                            {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}</td>
                        <td class="text-center">
                          @if($data->emp_category == 'CS')
                            <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                          @endif
                          @if($data->emp_category == 'MM')
                            <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                          @endif
                          @if($data->emp_category == 'BQ')
                            <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                          @endif
                          @if($data->emp_category == 'GD')
                            <a class="btn btn-success btn-sm disabled font-weight-bold">GD</a>
                          @endif
                          @if($data->emp_category == 'SC')
                            <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                          @endif
                        </td>
                        <td class="text-center">                        
                          <a class="btn btn-warning btn-sm" href="{{ url('pengawas/detail_score',$data->id_score) }}"><b><i class="fas fa-edit"></i></b></a>
                          <!-- <a class="btn btn-info btn-sm" href="#"><b>Lokasi Kerja</b></a> -->
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>No </th>
                        <th>NIP </th>
                        <th>Nama</th>
                        <th>Area Kerja</th>
                        <th>Jumlah Kartu Kuning</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->
@endforeach

@endsection