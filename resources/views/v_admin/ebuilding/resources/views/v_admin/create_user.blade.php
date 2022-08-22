@extends('v_admin.layout.app')
@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">

      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

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
        @if ($errors->any())
		      <div class="alert alert-danger">
		        <ul>
		          @foreach ($errors->all() as $error)
		            {{ $error }}
		          @endforeach
		        </ul>
		      </div>
		   	@endif
        <div class="card">
          <div class="card-header" style="background-color:#11B7AE;color: white;">
            <h3 class="card-title-data"><b>Pendaftaran Pengguna</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
	          <form action="{{ route('register.custom') }}" method="post">
	            @csrf
	            <input type="hidden" name="is_delete" value="false">
	            <div class="row">
			          <div class="col-md-6">
				          <label>Pilih Role :</label>
			            <div class="form-group input-group mb-3">
				            <select class="form-control" name="role_id" required>
					            <option value="">-- Pilih Role --</option>
					           	@foreach($role as $data)
					            <option value="{{ $data->id_role }}">{{ $data->role_name }}</option>
					            @endforeach
				            </select>
				            <div class="input-group-append">
								      <div class="input-group-text">
								        <span class="fas fa-user-tag"></span>
								      </div>
								    </div>
			            </div>
			          </div>                	
		            <div class="col-md-6">
		              <label>Nama Pengawas / Perusahaan Penyedia :</label>
		              <div class="form-group input-group mb-3">
			             	<input type="text" class="form-control" name="name" placeholder="Nama Pengawas / Perusahaan Penyedia" required>
				            <div class="input-group-append">
									    <div class="input-group-text">
									      <span class="fas fa-id-card"></span>
									    </div>
								    </div>
		              </div>
		            </div>                	
	              <div class="col-md-6">
	               <label>Username :</label>
	               <div class="form-group input-group mb-3">
		               	<input type="username" class="form-control" name="username" placeholder="Masukan Username" minlength= "8" required>
		               	<div class="input-group-append">
							        <div class="input-group-text">
							           <span class="fas fa-envelope"></span>
							        </div>
						       	</div>
	               </div>
	              </div>                	
	              <div class="col-md-6">
	              	<label>Password :</label>
	              	<div class="form-group input-group mb-3">
		              	<input type="password" class="form-control" id="Password" name="password" minlength="6" 
		              	placeholder="Minimal 6 Karakter" required>
		               	<div class="input-group-append">
							        <div class="input-group-text">
							          <a type="button" onclick="showPassword()">
				                  <i class="fas fa-eye show-password"></i>
				                </a>
							        </div>
						       	</div>
		              </div>
	              </div>
	              <div class="col-md-6">
		            	<label>Pilih Status :</label>
	              	<div class="form-group input-group mb-3">
		                <select class="form-control" name="status_id">
		                	@foreach($status as $data)
		                	<option value="{{ $data->id_status }}">{{ $data->status_name }}</option>
		                	@endforeach
		               	</select>
		               	<div class="input-group-append">
							      	<div class="input-group-text">
							        	<span class="fas fa-user-tag"></span>
							        </div>
						       	</div>
	               	</div>
	              </div>
	              <div class="col-md-6">
		            	<label>Pilih Hak Akses :</label>
	              	<div class="form-group input-group mb-3">
	              		<label class="checkbox-inline mr-4 mt-2">
								      <input type="checkbox" value="1" name="is_banquet_multimedia"> Banquet & Multimedia
								    </label>
								    <label class="checkbox-inline mr-4 mt-2">
								      <input type="checkbox" value="1" name="is_cleaning_service"> Cleaning Service
								    </label>
								    <label class="checkbox-inline mr-4 mt-2">
								      <input type="checkbox" value="1" name="is_gardener"> Pegawai Taman
								    </label>
								    <label class="checkbox-inline mr-2 mt-2">
								      <input type="checkbox" value="1" name="is_security"> Security
								    </label>
	               	</div>
	              </div>                  	
	              <div class="col-md-6">
	              	<label>&nbsp;</label>
	              	<button type="submit" class="form-control btn btn-info">DAFTAR</button>
	              </div>
              </div>
            </form>
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