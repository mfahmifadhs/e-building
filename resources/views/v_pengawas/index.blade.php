@extends('v_pengawas.layout.app')
@section('content')

@foreach($pegawai as $data)

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
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
    </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4" style="text-transform:uppercase;">
        <!-- Info Boxes Style 2 -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title"><b>PENGAWAS</b></h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              <p>
                <h6>Nama pengawas : {{ Auth::user()->name }}</h6>
              </p>
            </div>
            <div class="form-group">
              <p>
                <h6>
                  Hak Akses : 
                  <div class="form-group">
                    <p class="checkbox-inline mr-4 mt-2">
                      @if($data->is_banquet_multimedia == 1 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 0)
                        <p>
                          <input type="checkbox" value="1" name="is_banquet_multimedia" onclick="return false;" checked> Banquet & Multimedia
                        </p>
                      @endif
                      @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 1 & $data->is_security == 0)
                        <p style="margin-bottom:4.5vh;">
                          <input type="checkbox" value="1" name="is_cleaning_service" onclick="return false;" checked> Cleaning Service 
                        </p>
                      @endif
                      @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 1 & $data->is_cleaning_service == 0 & $data->is_security == 0)
                        <p><input type="checkbox" value="1" name="is_gardener" onclick="return false;" checked> Taman</p>
                      @endif
                      @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 1)
                        <p><input type="checkbox" value="1" name="is_security" onclick="return false;" checked> Security </p>
                      @endif
                      @if($data->is_banquet_multimedia == 1 & $data->is_cleaning_service == 1 & $data->is_gardener == 1 & $data->is_security == 1)
                        <p>
                          <input type="checkbox" value="1" name="is_banquet_multimedia" onclick="return false;" checked> Banquet & Multimedia
                        </p>
                        <p>
                          <input type="checkbox" value="1" name="is_cleaning_service" onclick="return false;" checked> Cleaning Service 
                        </p>
                        <p>
                          <input type="checkbox" value="1" name="is_gardener" onclick="return false;" checked> Taman
                        </p>
                        <p>
                          <input type="checkbox" value="1" name="is_security" onclick="return false;" checked> Security 
                        </p>
                      @endif
                    </p>
                  </div>
                </h6>
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card card-primary">
          <div class="card-header">
              <h3 class="card-title">
                  <b>PILIH PEGAWAI</b>
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
          </div>
          <div class="card-body">
            <form action="{{ url('pengawas/create_score') }}" method="POST">
              @csrf
              <div class="row">
                @if($data->is_banquet_multimedia == 1 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 0)
                <input type="hidden" name="emp_category" value="cs">             
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Nama Petugas Banquet / Multimedia :</label><br>
                      <select class="form-control select-bm" name="id_employee" required>
                        <option>-- Pilih Petugas --</option>
                      </select>
                  </div>
                </div>             
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Area Kerja :</label><br>
                      <select class="form-control workarea-lainya" id="select-workarea-bm" name="working_area" required>
                        <option>-- Pilih Area Kerja --</option>
                      </select>
                  </div>
                </div>
                @endif
                @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 1 & $data->is_security == 0)
                <input type="hidden" name="emp_category" value="cs">             
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Nama Petugas Kebersihan :</label><br>
                      <select class="form-control select-cs" name="id_employee" required>
                        <option>-- Pilih Petugas --</option>
                      </select>
                  </div>
                </div>             
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Area Kerja :</label><br>
                      <select class="form-control workarea-lainya" id="select-workarea-cs" name="working_area" required>
                        <option>-- Pilih Area Kerja --</option>
                      </select>
                  </div>
                </div>
                @endif
                @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 1)
                <input type="hidden" name="emp_category" value="sc">
                <div class="col-md-6">
                  <div class="form-group">      
                      <label>Nama Security :</label><br>
                      <select class="form-control select-sc" name="id_employee" required>
                        <option>-- Pilih Petugas --</option>
                      </select>
                  </div>
                </div>             
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Area Kerja :</label><br>
                      <select class="form-control" id="select-workarea-sc" name="working_area" required>
                        <option>-- Pilih Area Kerja --</option>
                      </select>
                  </div>
                </div>
                @endif
                @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 1 & $data->is_cleaning_service == 0 & $data->is_security == 0)
                <input type="hidden" name="emp_category" value="gd">
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Nama Petugas Taman :</label><br>
                      <select class="form-control select-gd" name="id_employee" required>
                        <option>-- Pilih Petugas --</option>
                      </select>
                  </div>
                </div>             
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Area Kerja :</label><br>
                      <select class="form-control workarea-lainya" id="select-workarea-gd" name="working_area" required>
                        <option>-- Pilih Area Kerja --</option>
                      </select>
                  </div>
                </div>
                @endif
                @if($data->is_banquet_multimedia == 1 & $data->is_cleaning_service == 1 & $data->is_gardener == 1 & $data->is_security == 1)
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Ketegori Pegawai :</label><br>
                      <select class="form-control select-all select-work-area" id="kategori-pegawai" name="emp_category" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="bq">BANQUET</option>
                        <option value="mm">MULTIMEDIA</option>
                        <option value="cs">CLEANING SERVICE</option>
                        <option value="gd">TAMAN</option>
                        <option value="sc">SECURITY</option>
                      </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Nama Pegawai :</label><br>
                      <select class="form-control select-all" id="pegawai" name="id_employee" required>
                        <option value="">-- Pilih Pegawai --</option>
                      </select>
                  </div>
                </div> 
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Area Kerja :</label>
                      <select class="form-control workarea-lainya" id="workarea-all" name="working_area" required>
                        <option value="">-- Pilih Area Kerja --</option>
                      </select>
                  </div>
                </div>
                @endif
                <div class="col-md-12">
                  <div class="form-group">
                    <span id="add-lainya"></span>
                  </div>
                </div>           
                <div class="col-md-6">
                  <div class="form-group">
                    <button class="form-control btn btn-info">PILIH</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="content">
  <div class="container-fluid">

    <!-- CHART BANQUET MM -->
    @if($data->is_banquet_multimedia == 1 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 0)
    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>BANQUET & MULTIMEDIA</b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2a" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scorebm as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="bmChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    @endif

    <!-- CHART CLEANING SERVICE -->
    @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 1 & $data->is_security == 0)
    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title-data"><b>CLEANING SERVICE</b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2a" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scorecs as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="csChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    @endif

    <!-- CHART TAMAN -->
    @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 1 & $data->is_cleaning_service == 0 & $data->is_security == 0)
    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>TAMAN</b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2a" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scoregd as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="gdChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    @endif

    <!-- CHART SECURITY -->
    @if($data->is_banquet_multimedia == 0 & $data->is_gardener == 0 & $data->is_cleaning_service == 0 & $data->is_security == 1)
    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>SECURITY</b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2a" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scoresc as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="secChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    @endif

    @if($data->is_banquet_multimedia == 1 & $data->is_cleaning_service == 1 & $data->is_gardener == 1 & $data->is_security == 1)
    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>Cleaning Service</b></h3>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2a" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scorecs as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="csChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>SECURITY</b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                    <table id="table2b" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scoresc as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="secChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>BANQUET & MULTIMEDIA  </b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2c" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scorebm as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="bmChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="card card-primary">
      <div class="card-header mb-4">
        <h3 class="card-title"><b>TAMAN</b></h3>
      </div>
      <div class="row">

        <div class="col-md-5">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <table id="table2d" class="table table-bordered" style="font-size:13px;">
                      <thead>
                        <th>No</th>
                        <th>Nama Petugas</th>
                        <th>Area Kerja</th>
                        <th>Kartu Kuning</th>
                        <th>Tanggal</th>
                      </thead>
                      <tbody>
                        <?php $no=1;?>
                        @foreach($scoregd as $row)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ $row->emp_name }}</td>
                              <td>{{ $row->working_area_name }}</td>
                              <td>{{ $row->total_score }} Kartu Kuning</td>
                              <td>{{ \Carbon\Carbon::parse($row->score_dt)->isoFormat('DD-MM-YY') }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        
                      </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-7">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">             
                <div class="col-md-12">
                  <div class="form-group">
                      <canvas id="gdChart" class="pie-chart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    @endif
  </div>
</section>





@endforeach
@endsection