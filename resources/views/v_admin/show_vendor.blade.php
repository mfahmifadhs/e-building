@extends('v_admin.layout.app')

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
            <a href="{{ url('admin-master/dashboard') }}" style="color:#17a2b8;">Dashboard</a>
          </li>
          <li class="breadcrumb-item active"><b>Data Penyedia</b></li>
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
            <h3 class="card-title-data"><b>DAFTAR PENYEDIA</b></h3>
            <a href="{{ url('admin-master/create_user') }}" class="btn btn-primary add-data">
              <i class="fas fa-plus-circle"></i>
            </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1a" class="table table-bordered table-striped">
              <thead align="center">
              <tr>
                <th>NO </th>
                <th>NAMA PERUSAHAAN</th>
                <th>USERNAME</th>
                <th>TOTAL PEGAWAI</th>
                <th>STATUS</th>
                <th>AKSI</th>
              </tr>
              </thead>
              <tbody align="center">
                <?php $no=1;?>
                @foreach($vendor as $row)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $row->name }}</td>
                  <td>{{ $row->username }}</td>
                  <td>{{ $row->totalpegawai }} Pegawai</td>
                  <td>
                    @if($row->status_name == 'Aktif')
                      <a class="btn btn-success btn-sm disabled" style="text-transform:uppercase;"><b>{{ $row->status_name }}</b></a>
                    @endif
                     @if($row->status_name == 'Tidak Aktif')
                      <a class="btn btn-danger btn-sm disabled" style="text-transform:uppercase;"><b>{{ $row->status_name }}</b></a>
                    @endif
                  </td>
                  <td class="text-center">               
                    <a class="btn btn-warning btn-md" href="{{ url('admin-master/show_profile',$row->id) }}">
                      <i class="fas fa-user-edit"></i>
                    </a>               
                    <a class="btn btn-info btn-md" href="{{ url('admin-master/show_employee',$row->id) }}">
                      <i class="fas fa-users"></i>
                    </a>    
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot align="center">
                <tr>
                  <th>NO </th>
                  <th>NAMA PERUSAHAAN</th>
                  <th>USERNAME</th>
                  <th>TOTAL PEGAWAI</th>
                  <th>STATUS</th>
                  <th>AKSI</th>
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