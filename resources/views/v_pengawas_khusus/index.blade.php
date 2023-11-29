@extends('v_pengawas_khusus.layout.app')
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
      <div class="col-md-12 form-group">
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
            <form action="{{ url('pengawas-khusus/create_score') }}" method="POST">
              @csrf
              <div class="row">
                @if($data->is_pet_control == 1)
                <input type="hidden" name="emp_category" value="pc">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Area Temuan :</label><br>
                    <select class="form-control workarea-lainya" id="select-area" name="area" required>
                      <option>-- Pilih Area Kerja --</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Detail Area <span style="font-size:12px;">(Contoh: Ruang Rapat)</span> :</label><br>
                    <input type="text" class="form-control" name="score_notes" placeholder="(Tulis - apabila tidak diisi)" required>
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
      <div class="col-md-8 form-group">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <canvas id="chartDiscovery" class="pie-chart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endforeach
@endsection