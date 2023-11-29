@extends('v_admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Kriteria Penilaian</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <div class="breadcrumb float-sm-right">
          <a href="#add-criteria" data-toggle="modal" data-target="#add-criteria"  class="btn btn-primary">
            <i class="fas fa-plus-circle"></i>
          </a>
          &emsp;
          <a href="#upload-criteria" data-toggle="modal" data-target="#upload-criteria"  class="btn btn-success">
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
            <h3 class="card-title-data"><b>Kriteria Penilaian Cleaning Service</b></h3>
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
                  <td>{{ $data->criteria_name }}</td>
                  <td class="text-center">
                    <a href="#edit-criteria-cleanservice" data-toggle="modal" data-target="#edit-criteria-cleanservice{{$data->id_criteria}}" class="btn btn-info add-data fas fa-edit fa-2x"></a>
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
            <h3 class="card-title-data"><b>Kriteria Penilaian Security</b></h3>
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
                  <td>{{ $data->criteria_name }}</td>
                  <td class="text-center">
                    <a href="#edit-criteria-security" data-toggle="modal" data-target="#edit-criteria-security{{$data->id_criteria}}" class="btn btn-dark add-data fas fa-edit fa-2x"></a>
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
            <h3 class="card-title-data"><b>Kriteria Penilaian Taman</b></h3>
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
                  <td>{{ $data->criteria_name }}</td>
                  <td class="text-center">
                    <a href="#edit-criteria-gardener" data-toggle="modal" data-target="#edit-criteria-gardener{{$data->id_criteria}}" class="btn btn-success add-data fas fa-edit fa-2x"></a>
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
            <h3 class="card-title-data"><b>Kriteria Penilaian Banquet & MM</b></h3>
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
                  <td>{{ $data->criteria_name }}</td>
                  <td class="text-center">
                    <a href="#edit-criteria-banquetmm" data-toggle="modal" data-target="#edit-criteria-banquetmm{{$data->id_criteria}}" class="btn btn-warning add-data fas fa-edit fa-2x"></a>
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

<!-- Model Upload Criteria -->
<div class="modal fade" id="upload-criteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel"><b>Upload Kriteria Penilaian</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/upload_criteria/') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="row">             
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload File Kriteria Penilaian :</label>
                <input type="file" class="form-control" name="upload-criteria" required>
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

<!-- Modal Add Criteria -->
<div class="modal fade" id="add-criteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  	<div class="modal-content">
  	 <div class="modal-header" style="background-color:#11B7AE;color: white;">
  	   <h5 class="modal-title" id="exampleModalLabel"><b>Tambah Kriteria Baru</b></h5>
  	   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  	     <span aria-hidden="true">&times;</span>
  	   </button>
  	 </div>
  	 <form action="{{ url('admin-master/add_criteria/') }}" method="POST">
  	  @csrf
  		<div class="modal-body">
  		    <div class="row">
  		      <div class="col-md-12">
  		        <div class="form-group">
  		        	<label>Kategori :</label>
                <select class="form-control" name="criteria_category" required>
                  <b><option value="">-- Pilih Kategori Kriteria --</option></b>
                  <option value="BANQUETMM">BANQUET & MULTIMEDIA</option>
                  <option value="CLEANING SERVICE">CLEANING SERVICE</option>
                  <option value="TAMAN">TAMAN</option>
                  <option value="SECURITY">SECURITY</option>
                </select>
  		        </div>
  		      </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Kriteria :</label>
                <textarea class="form-control" name="criteria_name" placeholder="Masukan kriteria" required></textarea>
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
<!-- Modal Edit Criteria Cleaning Service -->
<div class="modal fade" id="edit-criteria-cleanservice{{$data->id_criteria}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Cleaning Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_criteria/'. $data->id_criteria ) }}" method="POST">
        <input type="hidden" name="criteria_category" value="{{ $data->criteria_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Kriteria :</label>
                  <textarea class="form-control" name="criteria_name">{{ $data->criteria_name }}</textarea>
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
<!-- Modal Edit Criteria Cleaning Service -->
<div class="modal fade" id="edit-criteria-security{{$data->id_criteria}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Security</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_criteria/'. $data->id_criteria ) }}" method="POST">
        <input type="hidden" name="criteria_category" value="{{ $data->criteria_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Kriteria :</label>
                  <textarea class="form-control" name="criteria_name">{{ $data->criteria_name }}</textarea>
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
<!-- Modal Edit Criteria Cleaning Service -->
<div class="modal fade" id="edit-criteria-gardener{{$data->id_criteria}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Penilaian Taman</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_criteria/'. $data->id_criteria ) }}" method="POST">
        <input type="hidden" name="criteria_category" value="{{ $data->criteria_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Kriteria :</label>
                  <textarea class="form-control" name="criteria_name">{{ $data->criteria_name }}</textarea>
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
<!-- Modal Edit Criteria Cleaning Service -->
<div class="modal fade" id="edit-criteria-banquetmm{{$data->id_criteria}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#11B7AE;color: white;">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kriteria Penilaian Banquet & Multimedia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('admin-master/update_criteria/'. $data->id_criteria ) }}" method="POST">
        <input type="hidden" name="criteria_category" value="{{ $data->criteria_category }}">
        @csrf
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Edit Kriteria :</label>
                  <textarea class="form-control" name="criteria_name">{{ $data->criteria_name }}</textarea>
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