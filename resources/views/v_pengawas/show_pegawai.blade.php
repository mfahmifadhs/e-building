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
          <li class="breadcrumb-item active"><b>Data Pegawai</b></li>
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
        <div class="card">
          <div class="card-header" style="background-color:#11B7AE;color: white;">
            <h3 class="card-title-data"><b>DATA PEGAWAI</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>NIP </th>
                <th>Nama Petugas</th>
                <th>Posisi</th>
                <th>No. Hp</th>
                <th>Status</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($pegawai as $row)
                <tr>
                  <td>{{ $no++ }}</td>
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
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>NIP </th>
                <th>Nama Petugas</th>
                <th>Posisi</th>
                <th>No. Hp</th>
                <th>Status</th>
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
<div class="modal fade" id="add-import-banquetmm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><b>{{ Auth::user()->name }} - Upload Data Banquet & Multimedia</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/upload_banquet_mm/') }}" method="POST" enctype="multipart/form-data">
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
<div class="modal fade" id="add-banquetmm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><b>{{ Auth::user()->name }} - Tambah Data Banquet & Multimedia</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/add_banquet_mm/') }}" method="POST">
        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        <input type="hidden" name="status_id" value="1">
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
                <label>Pilih Bidang :</label>
                <select class="form-control" name="emp_category" required>
                  <option value="">-- Pilih Bidang --</option>
                  <option value="BANQUET">BANQUET</option>
                  <option value="MULTIMEDIA">MULTIMEDIA</option>
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
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat  :</label>
                <textarea class="form-control" name="emp_address" placeholder="Masukan Alamat Lengkap"></textarea>
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