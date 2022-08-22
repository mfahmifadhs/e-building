@extends('v_admin.layout.app')

@section('content')

@foreach($pegawai as $data)
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
            <a href="{{ url('admin-master/dashboard') }}" style="color:#17a2b8;">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><b>Data Penilaian - {{ $data->emp_name }}</b></li>
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
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><b>DATA PENILAIAN</b></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-md-6">
                  <h6><b>Nama Petugas <span style="padding-right: 5vh;"></span>: </b>{{ $data->emp_name }}</h6>
                  <h6><b>Total Kartu Kuning &ensp;: </b>{{ $data->totalscore }} Kartu Kuning</h6>
                </div>
                <table id="table3" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No </th>
                    <th>NIP </th>
                    <th>Pegawai</th>
                    <th>Area Kerja</th>
                    <th>Kartu Kuning</th>
                    <th>Tanggal</th>
                    <th>Pengawas</th>
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
                      <td>{{ $data->working_area_name }}</td>
                      <td>{{ $data->total_score }} Kartu Kuning</td>
                      <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                          {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                      </td>
                      <td>{{ $data->name }}</td>
                      <td class="text-center">                           
                        <a class="btn btn-warning btn-bg" href="{{ url('admin-master/detail_score',$data->id_score) }}"><i class="fas fa-edit"></i></a>
                        <!-- <a class="btn btn-info btn-sm" href="#"><b>Lokasi Kerja</b></a> -->
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No </th>
                    <th>NIP </th>
                    <th>Pegawai</th>
                    <th>Area Kerja</th>
                    <th>Kartu Kuning</th>
                    <th>Tanggal</th>
                    <th>Pengawas</th>
                    <th>Aksi</th>
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


@endforeach
@endsection