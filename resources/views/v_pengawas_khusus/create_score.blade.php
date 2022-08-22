@extends('v_pengawas_khusus.layout.app')

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
        @foreach($pengawas as $data)
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><b>DATA PETUGAS ({{ $data->name }})</b></h3>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title"><b>TEMUAN HEWAN / HAMAN DI AREA KERJA</b></h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('pengawas-khusus/add_score/') }}" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="working_area_id" value="{{ $areadiscov->id_working_area }}">
                  @csrf
                  <div class="row">
                    <div class="col-md-6">
                      <label>Area Temuan :</label>
                      <div class="form-group input-group mb-3">
                        <input type="text" class="form-control" value="{{ $areadiscov->working_area_name }}" readonly>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-building"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <label>Detail Area :</label>
                      <div class="form-group input-group mb-3">
                        <input type="text" class="form-control" name="score_notes" value="{{ $scorenote }}" readonly>
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
                          <div class="col-md-3">
                            <label>Temuan :</label>
                            <div class="form-group">
                              <input type="hidden" name="criteria_id" value="{{ $data->id_criteria }}">
                              {{ $data->criteria_name}} :
                            </div>
                          </div>
                          <div class="col-md-2">
                            <label>&nbsp;</label>
                            <div class="form-group">
                              <input type="checkbox" class="form-control" value="1" required>
                            </div>
                          </div>
                          <div class="col-md-5">
                            <label>Keterangan :</label>
                            <div class="form-group input-group mb-3">
                              <input type="text" class="form-control text-capitalize" name="description" placeholder="Contoh: Ditemukan Tikus Mati">
                              <div class="input-group-append">
                                <div class="input-group-text">
                                  <span class="fas fa-file-medical"></span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <label>Foto :</label>
                            <div class="form-group input-group mb-3">
                              <input type="file" class="form-control" name="img_discovery">
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" class="btn btn-info">TAMBAH</button>
                        <button type="reset" class="btn btn-danger" value="reset">BATAL</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
</section>



@endsection