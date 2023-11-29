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
@foreach($vendor as $data)
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
            <h3 class="card-title-data"><b>Edit Pengguna - {{ $data->name }}</b></h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
	          <form action="{{ url('admin-master/update_vendor/'. $data->id) }}" method="post">
	          	<input type="hidden" name="id" value="{{ $data->id }}">
	            @csrf
	            <div class="row">
			          <div class="col-md-6">
				          <label>Pilih Role :</label>
			            <div class="form-group input-group mb-3">
				            <select class="form-control" name="role_id" readonly>
					            <option value="{{ $data->role_id }}">{{ $data->role_name }}</option>
				            </select>
				            <div class="input-group-append">
								      <div class="input-group-text">
								        <span class="fas fa-user-tag"></span>
								      </div>
								    </div>
			            </div>
			          </div>                	
	              <div class="col-md-6">
	               <label>Username :</label>
	               <div class="form-group input-group mb-3">
		               	<input type="username" class="form-control" name="username" value="{{ $data->username }}" minlength= "8" readonly>
		               	<div class="input-group-append">
							        <div class="input-group-text">
							           <span class="fas fa-envelope"></span>
							        </div>
						       	</div>
	               </div>
	              </div>                	
		            <div class="col-md-6">
		              <label>Nama Pengawas / Perusahaan Penyedia :</label>
		              <div class="form-group input-group mb-3">
			             	<input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
				            <div class="input-group-append">
									    <div class="input-group-text">
									      <span class="fas fa-id-card"></span>
									    </div>
								    </div>
		              </div>
		            </div>
	              <div class="col-md-6">
		            	<label>Pilih Status :</label>
	              	<div class="form-group input-group mb-3">
		                <select class="form-control" name="status_id">
		                	@if($data->status_id == '1')
		                		<option value="1">Aktif</option>
		                		<option value="0">Tidak Aktif</option>
		                	@endif
		                	@if($data->status_id == '0')
		                		<option value="0">Tidak Aktif</option>
		                		<option value="1">Aktif</option>
		                	@endif
		               	</select>
		               	<div class="input-group-append">
							      	<div class="input-group-text">
							        	<span class="fas fa-user-tag"></span>
							        </div>
						       	</div>
	               	</div>
	              </div>                  	
	              <div class="col-md-6">
	              	<label>&nbsp;</label>
	              	<button type="submit" class="form-control btn btn-info" onclick="return confirm('Yakin ingin mengubah data ?')">UBAH</button>
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
@endforeach
@endsection