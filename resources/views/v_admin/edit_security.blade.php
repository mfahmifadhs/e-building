@extends('v_admin.layout.app')

  @section('content')

	<!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
         <b>DETAIL PEGAWAI</b>
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
	        @if ($message = Session::get('delete'))
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
			    @foreach($security as $data)
			    <div class="row">
			    	<div class="col-md-12">
		         	<div class="card">
		          	<div class="card-header" style="background-color:#11B7AE;color: white;">
	                <h3 class="card-title-data">
	                	<b>{{ $data->id_employee }} - {{ $data->emp_name }}</b>
	                </h3>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	<form action="{{ url('admin-master/update_security/'. $data->id_employee ) }}" method="POST">
	              		<input type="hidden" name="user_id" value="{{ $data->user_id }}">
	              		<input type="hidden" name="emp_category" value="{{ $data->emp_category }}">
	              		@csrf
	                	<div class="row">
											<div class="col-md-6">
				                <label>Penyedia :</label>
			                	<div class="form-group input-group mb-3">
			                		<input type="text" class="form-control" value="{{ $data->name }}" readonly>
				                	<div class="input-group-append">
										        <div class="input-group-text">
										           <span class="fas fa-building"></span>
										        </div>
								        	</div>
			                	</div>
			                </div>                	
			                <div class="col-md-6">
			                	<label>Posisi :</label>
			                	<div class="form-group input-group mb-3">
				                	<select class="form-control" name="emp_position">
				                		<option value="{{ $data->emp_position }}">{{ $data->emp_position}}</option>
				                	</select>
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-user"></span>
								            </div>
								        	</div>
			                	</div>
			                </div>                	
			                <div class="col-md-6">
			                	<label>Nama Pegawai :</label>
			                	<div class="form-group input-group mb-3">
				                	<input type="text" class="form-control" name="emp_name" value="{{ $data->emp_name }}" placeholder="{{ $data->emp_name }}" required>
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-id-card"></span>
								            </div>
								        	</div>
			                	</div>
			                </div> 
			                <div class="col-md-6">
				                <label>	No. Handphone :</label>
			                	<div class="form-group input-group mb-3">
				                	<input type="text" class="form-control" name="emp_phone_number" value="{{ $data->emp_phone_number }}">
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-phone-square"></span>
								            </div>
								        	</div>
			                	</div>
			                </div>  
			                <div class="col-md-6">
				                <label>	Jenis Kelamin :</label>
			                	<div class="form-group input-group mb-3">
				                	<select class="form-control" name="emp_gender">
				                		<option value="{{ $data->emp_gender }}">{{ $data->emp_gender }}</option>
				                		@if($data->emp_gender == 'L')
				                			<option value="P">P</option>
				                		@elseif($data->emp_gender == 'P')
				                			<option value="L">L</option>
				                		@endif
				                	</select>
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-venus-double"></span>
								            </div>
								        	</div>
			                	</div>
			                </div>  
			                <div class="col-md-6">
				                <label>	Agama :</label>
			                	<div class="form-group input-group mb-3">
				                	<select class="form-control" name="emp_religion">
				                			<option value="{{ $data->emp_religion }}">{{ $data->emp_religion }}</option>
						        				@if($data->emp_religion == 'ISLAM')
				                			<option value="PROTESTAN">PROTESTAN</option>
				                			<option value="KATOLIK">KATOLIK</option>
				                			<option value="HINDU">HINDU</option>
				                			<option value="BUDDHA">BUDDHA</option>
				                			<option value="KHONGHUCU">KHONGHUCU</option>

				                		@elseif($data->emp_religion == 'PROTESTAN')
					                		<option value="ISLAM">ISLAM</option>
				                			<option value="KATOLIK">KATOLIK</option>
				                			<option value="HINDU">HINDU</option>
				                			<option value="BUDDHA">BUDDHA</option>
				                			<option value="KHONGHUCU">KHONGHUCU</option>

				                		@elseif($data->emp_religion == 'KATOLIK')
					                		<option value="ISLAM">ISLAM</option>
				                			<option value="PROTESTAN">PROTESTAN</option>
				                			<option value="HINDU">HINDU</option>
				                			<option value="BUDDHA">BUDDHA</option>
				                			<option value="KHONGHUCU">KHONGHUCU</option>

				                		@elseif($data->emp_religion == 'HINDU')
					                		<option value="ISLAM">ISLAM</option>
				                			<option value="PROTESTAN">PROTESTAN</option>
				                			<option value="KATOLIK">KATOLIK</option>
				                			<option value="BUDDHA">BUDDHA</option>
				                			<option value="KHONGHUCU">KHONGHUCU</option>

				                		@elseif($data->emp_religion == 'BUDDHA')
					                		<option value="ISLAM">ISLAM</option>
				                			<option value="PROTESTAN">PROTESTAN</option>
				                			<option value="KATOLIK">KATOLIK</option>
				                			<option value="HINDU">HINDU</option>
				                			<option value="KHONGHUCU">KHONGHUCU</option>

				                		@elseif($data->emp_religion == 'KHONGHUCU')
					                		<option value="ISLAM">ISLAM</option>
				                			<option value="PROTESTAN">PROTESTAN</option>
				                			<option value="KATOLIK">KATOLIK</option>
				                			<option value="HINDU">HINDU</option>
				                			<option value="BUDDHA">BUDDHA</option>
				                		@endif
				                	</select>
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-pray"></span>
								            </div>
								        	</div>
			                	</div>
			                </div>  
			                <div class="col-md-6">
				                <label>	Alamat :</label>
			                	<div class="form-group input-group mb-3">
				                	<input type="text" class="form-control" name="emp_address" value="{{ $data->emp_address }}">
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-house-user"></span>
								            </div>
								        	</div>
			                	</div>
			                </div>   
			                <div class="col-md-6">
				                <label>	Status :</label>
			                	<div class="form-group input-group mb-3">
				                	<select class="form-control" name="status_id" >
				                		<option value="{{ $data->status_id }}"><b>{{ $data->status_name }}</b></option>
				                		@if($data->status_name != 'Tidak Aktif')
				                			<option value="0">Tidak Aktif</option>
				                		@elseif($data->status_name != 'Aktif')
				                			<option value="1">Aktif</option>
				                		@endif
				                	</select>
				                	<div class="input-group-append">
								            <div class="input-group-text">
								              <span class="fas fa-house-user"></span>
								            </div>
								        	</div>
			                	</div>
			                </div> 	                	
			                <div class="col-md-12">
			                	<button type="submit" class="form-control btn btn-info" onclick="return confirm('Yakin ingin mengubah data ?')">
			                		<b>UPDATE</b>
			                	</button>
			                </div>
	                	</div>
		            	</form>
	              </div>
		          </div>
		      	</div>
		      </div>
					@endforeach
        </div>
      </div>
    </div>
  </section>
@endsection