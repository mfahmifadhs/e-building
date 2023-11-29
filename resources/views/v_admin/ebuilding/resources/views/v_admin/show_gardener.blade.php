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
          <li class="breadcrumb-item active"><b>Data Pegawai Taman</b></li>
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
        @if ($message = Session::get('delete'))
          <div class="alert alert-danger">
              <p style="margin:0;">{{ $message }}</p>
          </div>
        @endif        
        @if ($message = Session::get('error'))
          <div class="alert alert-danger">
              <p style="margin:0;">{{ $message }}</p>
          </div>
        @endif
        <div class="card">
          <div class="card-header" style="background-color:#11B7AE;color: white;">
            <h3 class="card-title-data"><b>Data Pegawai Taman</b></h3>
            <!-- <form action="{{ url('admin-master/delete_all_gardener') }}" method="POST">
              @csrf
              <button class="btn btn-danger add-data" onclick="return confirm('Yakin ingin menghapus semua data?')">
                <i class="fas fa-trash-alt"></i>
              </button>
            </form> -->
            <a href="#add-import-gardener" data-toggle="modal" data-target="#add-import-gardener" class="btn btn-success add-import-pegawai">
              <i class="fas fa-file-upload"></i>
            </a>
            <a href="#add-gardener" data-toggle="modal" data-target="#add-gardener" class="btn btn-primary add-data">
              <i class="fas fa-plus-circle"></i>
            </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>NIP </th>
                <th>Nama Petugas</th>
                <th>Posisi</th>
                <th>No. Hp</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($gardener as $row)
                <tr>
                  <td>{{ $row->id_employee }}</td>
                  <td>{{ $row->emp_name }}</td>
                  <td>{{ $row->emp_position }}</td>
                  <td>{{ $row->emp_phone_number }}</td>
                  <td align="center">
                    @if($row->status_name == 'Aktif')
                      <a class="btn btn-success btn-sm disabled" style="text-transform:uppercase;"><b>{{ $row->status_name }}</b></a>
                    @endif
                    @if($row->status_name == 'Tidak Aktif')
                      <a class="btn btn-danger btn-sm disabled" style="text-transform:uppercase;"><b>{{ $row->status_name }}</b></a>
                    @endif
                  </td>
                  <td class="text-center">                        
                    <!-- <form action="{{ url('admin-master/delete_gardener',$row->id_employee) }}" method="POST">
                      @csrf -->
                      <a class="btn btn-warning btn-md" href="{{ url('admin-master/edit_gardener',$row->id_employee) }}">
                        <i class="fas fa-edit"></i>
                      </a>
                      <!-- <button class="btn btn-danger btn-bg" onclick="return confirm('Yakin ingin menghapus data?')">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>  -->
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>NIP </th>
                <th>Nama Petugas</th>
                <th>Posisi</th>
                <th>No. Hp</th>
                <th>Status</th>
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


    <!-- Modal Add File Import Pegawai -->
    <div class="modal fade" id="add-import-gardener" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#11B7AE;color: white;">
            <h5 class="modal-title" id="exampleModalLabel"><b>{{ Auth::user()->name }} - Upload Data Pegawai Taman</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ url('admin-master/upload_gardener/') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="user_id" value="2">
            <input type="hidden" name="status_id" value="1">
            @csrf
            <div class="modal-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Upload File Pegawai :</label>
                    <input type="file" class="form-control" name="upload-pegawai" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Upload File</button>
            </div>
          </form>
        </div>
      </div>
    </div>      

    <!-- Modal Add Pegawai -->
    <div class="modal fade" id="add-gardener" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#11B7AE;color: white;">
            <h5 class="modal-title" id="exampleModalLabel"><b>{{ Auth::user()->name }} - Tambah Data Pegawai Taman</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ url('admin-master/add_gardener/') }}" method="POST">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" name="status_id" value="1">
            <input type="hidden" name="emp_category" value="Pegawai Taman">
            @csrf
            <div class="modal-body">
                <div class="row">             
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nomor Induk Pegawai (NIP) :</label>
                      <input type="text" class="form-control" name="id_employee" placeholder="Masukan Nomor Induk Pegawai" required>
                    </div>
                  </div>                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Penyedia :</label>
                      <select class="form-control" name="user_id" required>
                        <option value="">-- Pilih Penyedia --</option>
                        <option value="2">PT. ALFIRA PUTRA MANDIRI</option>
                      </select>
                    </div>
                  </div>                   
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Posisi :</label>
                      <select class="form-control" name="emp_position" required>
                        <option value="">-- Pilih Posisi --</option>
                        <option value="CLEANER">CLEANER</option>
                      </select>
                    </div>
                  </div>                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Nama Lengkap :</label>
                      <input type="text" class="form-control" name="emp_name" placeholder="Nama Lengkap" required>
                    </div>
                  </div>                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>No. Handphone :</label>
                      <input type="text" class="form-control" name="emp_phone_number" placeholder="Nomor HP Aktif" required>
                    </div>
                  </div>                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Jenis Kelamin :</label>
                      <select class="form-control" name="emp_gender" required>
                        <option value="">-- Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Agama :</label>
                      <select class="form-control" name="emp_religion" required>
                        <option value="">-- Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Protestan">Protestan</option>
                        <option value="Katolik">Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Khonghucu">Khonghucu</option>
                      </select>
                    </div>
                  </div>                
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Alamat  :</label>
                      <input type="text" class="form-control" name="emp_address" placeholder="Masukan Alamat Lengkap">
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-info">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
@endsection