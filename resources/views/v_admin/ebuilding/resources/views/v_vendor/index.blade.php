@extends('v_vendor.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
      <h2>Dashboard <br></h2>
  </div>
</section>

<!-- Warehouse content -->
<section class="content">
  <div class="container-fluid">
    <div class="card card-primary card-outline">

      <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="custom-content-below-entryitem-tab" data-toggle="pill" href="#custom-content-below-entryitem" role="tab" aria-controls="custom-content-below-entryitem" aria-selected="true" style="color:#11B7AE;font-size: 20px;">
            <b>2022</b></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="custom-content-below-exititem-tab" data-toggle="pill" href="#custom-content-below-exititem" role="tab" aria-controls="custom-content-below-exititem" aria-selected="false" style="color:#11B7AE;font-size: 20px;">
            <b>2021</b></a>
        </li>
      </ul>

      <div class="card-body">
        <div class="tab-content" id="custom-content-below-tabContent">
          <!-- 2022 -->
          <div class="tab-pane fade show active" id="custom-content-below-entryitem" role="tabpanel" aria-labelledby="custom-content-below-entryitem-tab">

            <div class="row">
              <div class="col-md-4" style="text-transform:uppercase;">
                <div class="card card-primary">
                  <div class="card-header">
                    <a href="{{ url('vendor/show_score_month_22', 2022) }}">
                      <h3 class="card-title"><i class="fas fa-book-reader"></i>&emsp;<b>{{ $totalkk22->totalscore }} Kartu Kuning</b></h3>
                    </a>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                </div>
                @foreach($totalkkm22 as $data)
                <a href="{{ url('vendor/show_score_month_22', $data->month) }}">
                  <div class="info-box mb-3" style="background-color:#11B7AE;color: white;">
                    <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text"><b>{{ \Carbon\Carbon::parse($data->month)->isoFormat('MMMM') }}</b></span>
                      <span class="info-box-number">{{$data->totalscore21}} Kartu Kuning</span>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
                  
              <!--GRAFIK TOTAL KARTU KUNING-->
              <div class="col-md-8">
                <div class="card card-primary">
                  <div class="card-header">
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">             
                      <div class="col-md-12">
                        <div class="form-group">
                          <canvas id="barChart" style="height:62vh;"></canvas>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">
                          <b>DATA PEGAWAI</b>
                      </h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="table2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No </th>
                          <th>Tanggal </th>
                          <th>Nama Petugas</th>
                          <th>Kartu Kuning</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $no=1;?>
                            @foreach($score22 as $data)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                                {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                            </td>
                            <td>{{ $data->emp_name }}</td>
                            <td>{{ $data->total_score }} Kartu Kuning</td>
                            <td class="text-center">                        
                              <a class="btn btn-warning btn-md" href="{{ url('vendor/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
                              <!-- <a class="btn btn-info btn-sm" href="#"><b>Lokasi Kerja</b></a> -->
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>No </th>
                          <th>Tanggal </th>
                          <th>Nama Pegawai</th>
                          <th>Kartu Kuning</th>
                          <th>Aksi</th>
                        </tr>
                        </tfoot>
                      </table>
                  </div>
                </div>

              </div>



              <div class="col-md-8">
              </div>
            </div>

          </div>

          <!-- 2021 -->
          <div class="tab-pane fade" id="custom-content-below-exititem" role="tabpanel" aria-labelledby="custom-content-below-exititem-tab">
            <div class="row">
              <div class="col-md-4" style="text-transform:uppercase;">
                <div class="card card-primary">
                  <div class="card-header">
                    <a href="{{ url('vendor/show_score_month_21', 2021) }}">
                      <h3 class="card-title"><i class="fas fa-book-reader"></i>&emsp;<b>{{ $totalkk21->totalscore }} Kartu Kuning</b></h3>
                    </a>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                </div>
                @foreach($totalkkm21 as $data)
                <a href="{{ url('vendor/show_score_month_21', $data->month) }}">
                  <div class="info-box mb-3" style="background-color:#11B7AE;color: white;">
                    <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text"><b>{{ \Carbon\Carbon::parse($data->month)->isoFormat('MMMM') }}</b></span>
                      <span class="info-box-number">{{$data->totalscore21}} Kartu Kuning</span>
                    </div>
                  </div>
                </a>
                @endforeach
              </div>
              <div class="col-md-8">
                <div class="card card-primary">
                  <div class="card-header">
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">             
                      <div class="col-md-12">
                        <div class="form-group">
                          <table id="table1a" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No </th>
                              <th>Nama Pegawai</th>
                              <th>Total Kartu Kuning</th>
                              <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php $no=1;?>
                              @foreach($rating21 as $data)
                              <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->emp_name }}</td>
                                <td>{{ $data->totalscore }} Kartu Kuning</td>
                                <td class="text-center">
                                  <a class="btn btn-warning btn-md" href="{{ url('vendor/show_score_person_21',$data->id_employee) }}">
                                  <i class="fas fa-info"></i></a>
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>NIP </th>
                              <th>Nama Pegawai</th>
                              <th>Total Kartu Kuning</th>
                              <th>Aksi</th>
                            </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                      <h3 class="card-title">
                          <b>DATA PETUGAS KEBERSIHAN</b>
                      </h3>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                        </button>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="table1c" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No </th>
                          <th>Tanggal </th>
                          <th>Nama Petugas</th>
                          <th>Kartu Kuning</th>
                          <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $no=1;?>
                            @foreach($score21 as $data)
                          <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                                {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                            </td>
                            <td>{{ $data->emp_name }}</td>
                            <td>{{ $data->total_score }} Kartu Kuning</td>
                            <td class="text-center">                        
                              <a class="btn btn-warning btn-md" href="{{ url('vendor/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
                              <!-- <a class="btn btn-info btn-sm" href="#"><b>Lokasi Kerja</b></a> -->
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                          <th>No </th>
                          <th>Tanggal </th>
                          <th>Nama Pegawai</th>
                          <th>Kartu Kuning</th>
                          <th>Aksi</th>
                        </tr>
                        </tfoot>
                      </table>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</section><br>


@endsection