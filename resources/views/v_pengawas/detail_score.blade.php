@extends('v_pengawas.layout.app')

    @section('content')

		<!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

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
                    <p>{{ $message }}</p>
                </div>
              @endif        
              @if ($message = Session::get('delete'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
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
		      @foreach($score as $data)
		      <div class="row">
		      	<div class="col-md-12">
	            <div class="card card-warning">
	              <div class="card-header">
	                <h3 class="card-title"><b>TEMUAN KARTU KUNING ({{ $data->id_employee }} - {{ $data->emp_name }})</b></h3>
	                <div class="card-tools">
	                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                  </button>
	                </div>
	              </div>
	              <!-- /.card-header -->
	              <div class="card-body">
	              	<form action="{{ url('pengawas/update_score/'. $data->id_score ) }}" method="post">
	              		<input type="hidden" name="user_id" value="{{ $data->user_id }}">
	              		<input type="hidden" name="emp_id" value="{{ $data->id_employee }}">
	              		<input type="hidden" name="total_score" value="{{ $data->total_score }}">
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
		                      <input type="text" class="form-control" value="{{ $data->working_area_name }}" readonly>
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
		                      @foreach($detail_sp as $row)
		                      <div class="row">
		                        <div class="col-md-6">
		                        	<div class="form-group">
			                        	<input type="hidden" name="criteria_id[]" value="{{ $row->id_criteria }}">
			                          {{ $row->criteria_name}} : 
		                        	</div>
		                        </div>
		                        <div class="col-md-2">
		                        	<div class="form-group">
		                          	<input type="checkbox"  class="form-control" name="score[{{ $row->id_criteria }}]" id="score" value="1"<?php if($row->score == "1") echo "checked"; ?> onclick="return false;">
		                          </div>
		                        </div>
		                        <div class="col-md-4">
		                        	<div class="form-group input-group mb-3">
		                        		<input type="text" class="form-control" name="description[]" value="{{ $row->description }}">
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
	                	</div>
	                </form>
	              </div>
	            </div>
	          </div>

          @endforeach
          </div>
        </div>
      </div>
    </section>
@endsection