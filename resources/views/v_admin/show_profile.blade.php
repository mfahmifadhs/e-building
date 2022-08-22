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
          <li class="breadcrumb-item active"><b>Profil</b></li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="col-md-4" style="margin: 0 auto;float: none;">
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
        <div class="card">
          <div class="card-header" style="background-color:#11B7AE;color: white;">
            <h3 class="card-title-data"><b>PROFIL</b></h3>
          </div>
          <!-- /.card-header -->
          @foreach($admin as $data)
          <div class="card-body">
            <form action="{{ url('admin-master/change_profile') }}" method="POST">
              <input type="hidden" name="id" value="{{ $data->id }}">
              <input type="hidden" name="status_id" value="{{ $data->status_id }}">
              <input type="hidden" name="password" value="{{ $data->password }}">
              <input type="hidden" name="status_id" value="{{ $data->status_id }}">
              @csrf
              <label>Nama Pengawas:</label>
              <div class="form-group">
                <input type="text" class="form-control" name="name" value="{{ $data->name }}">
              </div>
              <label>Username:</label>
              <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="{{ $data->username }}">
              </div>
              <label>Hak Akses:</label>
              @foreach($access as $access)
              <div class="form-group">
                @if($access->is_banquet_multimedia == 1 & $access->is_gardener == 0 & $access->is_cleaning_service == 0 & $access->is_security == 0)
                        <p>
                          <input type="checkbox" value="1" name="is_banquet_multimedia" onclick="return false;" checked> Banquet & Multimedia
                        </p>
                      @endif
                      @if($access->is_banquet_multimedia == 0 & $access->is_gardener == 0 & $access->is_cleaning_service == 1 & $access->is_security == 0)
                        <p style="margin-bottom:4.5vh;">
                          <input type="checkbox" value="1" name="is_cleaning_service" onclick="return false;" checked> Cleaning Service 
                        </p>
                      @endif
                        @if($access->is_banquet_multimedia == 0 & $access->is_gardener == 1 & $access->is_cleaning_service == 0 & $access->is_security == 0)
                        <p><input type="checkbox" value="1" name="is_gardener" onclick="return false;" checked> Taman</p>
                      @endif
                      @if($access->is_banquet_multimedia == 0 & $access->is_gardener == 0 & $access->is_cleaning_service == 0 & $access->is_security == 1)
                        <p><input type="checkbox" value="1" name="is_security" onclick="return false;" checked> Security </p>
                      @endif
                      @if($access->is_banquet_multimedia == 1 & $access->is_cleaning_service == 1 & $access->is_gardener == 1 & $access->is_security == 1)
                        <div class="row">
                          <div class="col-md-6">
                            <input type="checkbox" value="1" name="is_banquet_multimedia" onclick="return false;" checked> Banquet & Multimedia
                          </div>
                          <div class="col-md-6">
                            <input type="checkbox" value="1" name="is_cleaning_service" onclick="return false;" checked> Cleaning Service 
                          </div>
                          <div class="col-md-6">
                            <input type="checkbox" value="1" name="is_gardener" onclick="return false;" checked> Taman 
                          </div>
                          <div class="col-md-6">
                          <input type="checkbox" value="1" name="is_security" onclick="return false;" checked> Security 
                          </div>
                        </div> 
                      @endif
              </div>
              @endforeach
              <label>Status:</label>
              <div class="form-group">
                <input type="text" class="form-control" value="{{ $data->status_name }}" readonly>
              </div>
              <div class="form-group">
                <button class="btn btn-info col-md-12 btn-sm" onclick="return confirm('Yakin ingin mengubah data?')"><b>UBAH</b></button>
              </div>
              <div class="form-group">
                <a href="#change-password" data-toggle="modal" class="btn btn-warning col-md-12 btn-sm"><b>GANTI PASSWORD</b></a>
              </div>
              <div class="form-group">
                <a href="{{ url('admin-master/show_profile') }}" class="btn btn-danger col-md-12 btn-sm"><b>BATAL</b></a>
              </div>
            </form>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </section><br>


    <!-- Modal Add File Import Pegawai -->
    <div class="modal fade" id="change-password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#11B7AE;color: white;">
            <h5 class="modal-title" id="exampleModalLabel"><b>Ganti Password</b></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ url('admin-master/change_password/') }}" method="POST">
              <input type="hidden" name="id" value="{{ $data->id }}">
              @csrf
              @if($data->id == 1)
              <div class="col-md-12">
                <label>Password lama:</label>
                <div class="input-group mb-4">
                  <input type="password" name="old_password" class="form-control" id="OldPassword" placeholder="Password" minlength="6" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <a type="button" onclick="showOldPassword()">
                        <i class="fas fa-eye show-password"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              @endif
              <div class="col-md-12">
                <label>Password baru:</label>
                <div class="input-group mb-4">
                  <input type="password" name="new_password" class="form-control" id="NewPassword" placeholder="Password" minlength="6" required>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <a type="button" onclick="showNewPassword()">
                        <i class="fas fa-eye show-password"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <button class="btn btn-info btn-sm" onclick="return confirm('Yakin ingin mengubah data?')"><b>GANTI PASSWORD</b></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>   

@endsection