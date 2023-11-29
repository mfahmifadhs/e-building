@extends('v_pengawas.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

    </div>
  </div>
</section>
<!-- Content Header (Page header) -->


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
		      @foreach($pegawai as $data)
		      <div class="row">
		      	<div class="col-md-12">
	            <div class="card card-primary">
	              <div class="card-header">
	                <h3 class="card-title"><b>DATA PETUGAS ({{ $data->emp_name }} - {{ $data->name }})</b></h3>
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
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
			                	<select class="form-control" name="emp_position" readonly>
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
			                	<input type="text" class="form-control" name="emp_name" value="{{ $data->emp_name }}" placeholder="{{ $data->emp_name }}" readonly>
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
			                	<input type="text" class="form-control" name="emp_phone_number" value="{{ $data->emp_phone_number }}" readonly>
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
			                	<select class="form-control" name="gender" readonly>
			                		<option value="{{ $data->emp_gender }}">{{ $data->emp_gender }}</option>
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
			                	<select class="form-control" name="religion" readonly>
			                		<option value="{{ $data->emp_religion }}">{{ $data->emp_religion }}</option>
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
			                	<input type="text" class="form-control" name="emp_address" value="{{ $data->emp_address }}" readonly>
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
			                	<select class="form-control" name="status_id" readonly>
			                		<option value="{{ $data->status_id }}" readonly><b>{{ $data->status_name }}</b></option >
			                	</select>
			                	<div class="input-group-append">
							            <div class="input-group-text">
							              <span class="fas fa-house-user"></span>
							            </div>
							        	</div>
		                	</div>
		                </div> 	 
	                </div>
	              </div>
	              <!-- /.card-body -->
	            </div>
	          </div>
          </div>
          @endforeach
      </div>
    </div>
  </div>
</section>

<!-- Section Penilaian Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">

    </div>
  </div>
</section>
<!-- Section Penilaian Header -->

<!-- Scoring Content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
		      
      	@foreach($pegawai as $data)
		      <div class="row">
		      	<div class="col-md-12">
	            <div class="card card-warning">
	              <div class="card-header">
	                <h3 class="card-title"><b>TEMUAN KARTU KUNING ({{ $data->emp_name }} - {{ $data->name }})</b></h3>
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	<form action="{{ url('pengawas/add_score/') }}" method="POST">
	              		<input type="hidden" name="emp_id" value="{{ $data->id_employee }}">
	              		<input type="hidden" name="working_area_id" value="{{ $workingarea->id_working_area }}">
	              		<input type="hidden" name="score_notes" value="{{ $scorenote }}" style="text-transform:uppercase;">
	              		@csrf
	                	<div class="row">
		                	<div class="col-md-6">
		                    <label>Nama Pegawai :</label>
		                    <div class="form-group input-group mb-3">
		                    	<input type="text" class="form-control" value="{{ $data->emp_name }}" readonly>
		                      <div class="input-group-append">
							            	<div class="input-group-text">
							              	<span class="fas fa-building"></span>
							            	</div>
							        		</div>
		                    </div>
		                  </div> 
		                	<div class="col-md-6">
		                    <label>Area Kerja :</label>
		                    <div class="form-group input-group mb-3">
		                    	<input type="text" class="form-control" value="{{ $workingarea->working_area_name }}" readonly>
		                      <div class="input-group-append">
							            	<div class="input-group-text">
							              	<span class="fas fa-building"></span>
							            	</div>
							        		</div>
		                    </div>
		                  </div>

		                  <div class="col-md-12">
		                  	<hr><br>
		                    <div class="form-group">
		                      @foreach($criteria as $data)
		                      <div class="row">
		                        <div class="col-md-6">
		                        	<div class="form-group">
			                        	<input type="hidden" name="criteria_id[]" value="{{ $data->id_criteria }}">
			                          {{ $data->criteria_name}} : 
		                        	</div>
		                        </div>
		                        <div class="col-md-2">
		                        	<div class="form-group">
		                          	<input type="checkbox" class="form-control" name="score[{{ $data->id_criteria }}]" value="1">
		                          </div>
		                        </div>
		                        <div class="col-md-4">
		                        	<div class="form-group input-group mb-3">
		                        		<input type="text" class="form-control" name="description[]" placeholder="Masukan keterangan">
		                        		<div class="input-group-append">
										            	<div class="input-group-text">
										              	<span class="fas fa-file-medical"></span>
										            	</div>
										        		</div>
		                        	</div>
		                        </div>
		                      </div>
		                      @endforeach
		                    </div>
		                  </div>
		                  <div class="col-md-6">
		                  	<div class="form-group">
		                  		<button type="submit" class="btn btn-info form-control">TAMBAH</button>
		                  	</div>
		                  </div>
		                  <div class="col-md-6">
		                  	<div class="form-group">
		                  		<button type="reset" class="btn btn-danger form-control" value="reset">BATAL</button>
		                  	</div>
		                  </div>    
	                	</div>
	                </form>
	              </div>
	              <!-- /.card-body -->
	            </div>
	          </div>
          @endforeach

      </div>
    </div>
  </div>
</section>
@endsection