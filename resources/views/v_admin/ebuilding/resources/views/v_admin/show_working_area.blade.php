@extends('v_admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Area Kerja</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <div class="breadcrumb float-sm-right">
          <a href="#add-workingarea" data-toggle="modal" data-target="#add-workingarea"  class="btn btn-primary">
            <i class="fas fa-plus-circle"></i>
          </a>
          &emsp;
          <a href="#upload-working-area" data-toggle="modal" data-target="#upload-working-area"  class="btn btn-success">
            <i class="fas fa-file-upload"></i>
          </a>
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
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
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">

      <!-- Kriteria Penilaian Cleaning Service -->
      <div class="col-md-6">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title-data"><b>Area Kerja Cleaning Service</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($cleanservice as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->working_area_name }}</td>
                  <td class="text-center">
                    <!-- <form action="{{ url('admin-master/delete_working_area',$data->id_working_area) }}" method="POST">
                      @csrf -->
                      <a href="#edit-workingarea-cleanservice" data-toggle="modal" data-target="#edit-workingarea-cleanservice{{$data->id_working_area}}" class="btn btn-info add-data fas fa-edit fa-2x"></a>
                      <!-- <button class="btn btn-danger btn-bg" onclick="return confirm('Yakin ingin menghapus data?')">
                          <i class="fas fa-trash"></i>
                      </button>
                    </form> -->
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
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
            <h3 class="card-title-data"><b>Area Kerja Security</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1a" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($security as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->working_area_name }}</td>
                  <td class="text-center">
                    <!-- <form action="{{ url('admin-master/delete_working_area',$data->id_working_area) }}" method="POST">
                      @csrf -->
                      <a href="#edit-workingarea-security" data-toggle="modal" data-target="#edit-workingarea-security{{$data->id_working_area}}" class="btn btn-dark add-data fas fa-edit fa-2x"></a>
                      <!-- <button class="btn btn-danger btn-bg" onclick="return confirm('Yakin ingin menghapus data?')">
                          <i class="fas fa-trash"></i>
                      </button>
                    </form> -->
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
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
            <h3 class="card-title-data"><b>Area Kerja Pegawai Taman</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1b" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($gardener as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->working_area_name }}</td>
                  <td class="text-center">
                    <a href="#edit-workingarea-gardener" data-toggle="modal" data-target="#edit-workingarea-gardener{{$data->id_working_area}}" class="btn btn-success add-data fas fa-edit fa-2x"></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
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
            <h3 class="card-title-data"><b>Area Kerja Banquet & MM</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="table1c" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
              </tr>
              </thead>
              <tbody>
                <?php $no=1;?>
                @foreach($banquetmm as $data)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $data->working_area_name }}</td>
                  <td class="text-center">
                    <a href="#edit-workingarea-banquetmm" data-toggle="modal" data-target="#edit-workingarea-banquetmm{{$data->id_working_area}}" class="btn btn-warning add-data fas fa-edit fa-2x"></a>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No </th>
                <th>Nama Kriteria</th>
                <th>Aksi</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

    </div>
  </div>
</section>

<!-- Model Upload Working Area -->
<div class="modal fade" id="upload-working-area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><b>Upload Area Kerja</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/upload_working_area/') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">             
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload File Area Kerja Pegawai :</label>
                <input type="file" class="form-control" name="upload-working-area" required>
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

<!-- Modal Add Working Area -->
<div class="modal fade" id="add-workingarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
     <div class="modal-header" style="background-color:#11B7AE;color: white;">
       <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Area Kerja Baru</b></h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <form action="{{ url('admin-master/add_working_area/') }}" method="POST">
      @csrf
      <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori :</label>
                <select class="form-control" name="working_area_category" required>
                  <b><option value="">-- Pilih Kategori Pegawai --</option></b>
                  <option value="bm">BANQUET & MULTIMEDIA</option>
                  <option value="cs">CLEANING SERVICE</option>
                  <option value="gd">TAMAN</option>
                  <option value="sc">SECURITY</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Area Kerja :</label>
                <textarea class="form-control" name="working_area_name" placeholder="Masukan Area Kerja" required></textarea>
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

@foreach($cleanservice as $data)
<!-- Modal Edit Working Area Cleaning Service -->
<div class="modal fade" id="edit-workingarea-cleanservice{{$data->id_working_area}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Area Kerja Cleaning Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_working_area/'. $data->id_working_area ) }}" method="POST">
        <input type="hidden" name="working_area_category" value="{{ $data->working_area_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Area Kerja :</label>
                  <textarea class="form-control" name="working_area_name">{{ $data->working_area_name }}</textarea>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach   

@foreach($security as $data)
<!-- Modal Edit Working Area Cleaning Service -->
<div class="modal fade" id="edit-workingarea-security{{$data->id_working_area}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Area Kerja Security</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_working_area/'. $data->id_working_area ) }}" method="POST">
        <input type="hidden" name="working_area_category" value="{{ $data->working_area_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Area Kerja :</label>
                  <textarea class="form-control" name="working_area_name">{{ $data->working_area_name }}</textarea>
                </div>  
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach  

@foreach($gardener as $data)
<!-- Modal Edit Working Area Cleaning Service -->
<div class="modal fade" id="edit-workingarea-gardener{{$data->id_working_area}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Penilaian Taman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_working_area/'. $data->id_working_area ) }}" method="POST">
        <input type="hidden" name="working_area_category" value="{{ $data->working_area_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Kriteria :</label>
                  <textarea class="form-control" name="working_area_name">{{ $data->working_area_name }}</textarea>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@foreach($banquetmm as $data)
<!-- Modal Edit Working Area Cleaning Service -->
<div class="modal fade" id="edit-workingarea-banquetmm{{$data->id_working_area}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Penilaian Banquet & Multimedia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_working_area/'. $data->id_working_area ) }}" method="POST">
        <input type="hidden" name="working_area_category" value="{{ $data->working_area_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Kriteria :</label>
                  <textarea class="form-control" name="working_area_name">{{ $data->working_area_name }}</textarea>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Ubah</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection