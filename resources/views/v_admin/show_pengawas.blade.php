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
          <li class="breadcrumb-item active"><b>Data Pengawas</b></li>
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
                <h2 class="card-title-data"><b>DAFTAR PENGAWAS</b></h3>
                <a href="{{ url('admin-master/create_user') }}" class="btn btn-primary add-data">
                  <i class="fas fa-plus-circle"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="table1" class="table table-bordered table-striped">
                  <thead align="center">
                  <tr>
                    <th rowspan="2">NO </th>
                    <th rowspan="2">NAMA</th>
                    <th rowspan="2">USERNAME</th>
                    <th colspan="5">HAK AKSES</th>
                    <th rowspan="2">STATUS</th>
                    <th rowspan="2">AKSI</th>
                  </tr>
                  <tr>
                    <th>Banquet & MM</th>
                    <th>Cleaning Service</th>
                    <th>Pegawai Taman</th>
                    <th>Security</th>
                    <th>Pengendalian Hama</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $no=1;?>
                    @foreach($pengawas as $row)
                    <tr>
                      <td align="center">{{ $no++ }}</td>
                      <td>{{ $row->name }}</td>
                      <td align="center">{{ $row->username }}</td>
                      <td align="center">
                        @if($row->is_banquet_multimedia == 1)
                          <b>YA</b>  
                        @endif
                      </td>
                      <td align="center">
                        @if($row->is_cleaning_service == 1)
                          <b>YA</b>  
                        @endif
                      </td align="center">
                      <td align="center">
                        @if($row->is_gardener == 1)
                          <b>YA</b>  
                        @endif
                      </td>
                      <td align="center">
                        @if($row->is_security == 1)
                          <b>YA</b>
                        @endif
                      </td>
                      <td align="center">
                        @if($row->is_pet_control == 1)
                          <b>YA</b>
                        @endif
                      </td>
                      <td align="center">
                        @if($row->status_name == 'Aktif')
                            <a class="btn btn-success btn-sm disabled" style="text-transform:uppercase;"><b>{{ $row->status_name }}</b></a>
                        @endif
                        @if($row->status_name == 'Tidak Aktif')
                            <a class="btn btn-danger btn-sm disabled" style="text-transform:uppercase;"><b>{{ $row->status_name }}</b></a>
                        @endif
                      </td>
                      <td class="text-center">
                        <form action="{{ url('admin-master/delete_pengawas',$row->id) }}" method="POST">
                          @csrf
                          <a class="btn btn-warning btn-md" href="{{ url('admin-master/edit_pengawas',$row->id) }}">
                            <i class="fas fa-user-edit"></i>
                          </a>
                          <!-- <button class="btn btn-danger btn-bg" onclick="return confirm('Yakin ingin menghapus data?')">
                              <i class="fas fa-trash"></i>
                          </button> -->
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                  <tfoot align="center">
                  <tr>
                    <th>NO </th>
                    <th>NAMA</th>
                    <th>USERNAME</th>
                    <th colspan="5">HAK AKSES</th>
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