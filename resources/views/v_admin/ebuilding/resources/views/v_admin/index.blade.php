@extends('v_admin.layout.app')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
      <h2>Dashboard <br></h2>
  </div>
</section>

<!-- Chart content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $banquetmm }}</h3>
                
            <p>Total Pegawai Banquet & Multimedia</p>
          </div>
          <div class="icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <a href="{{ url('admin-master/show_banquet_mm') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $cleanservice }}</sup></h3>

            <p>Total Pegawai Cleaning Service</p>
          </div>
          <div class="icon">
            <i class="fas fa-building"></i>
          </div>
          <a href="{{ url('admin-master/show_cleaning_service') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ $gardener }}</h3>

            <p>Total Pegawai Taman</p>
          </div>
          <div class="icon">
            <i class="fas fa-user-shield"></i>
          </div>
          <a href="{{ url('admin-master/show_gardener') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $security }}</h3>
            <p>Total Pegawai Security</p>
          </div>
          <div class="icon">
            <i class="fas fa-file-signature"></i>
          </div>
          <a href="{{ url('admin-master/show_security') }}" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
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
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h5 class="card-title"><b>PENILAIAN PEGAWAI JASA PENGELOLAAN GEDUNG</b></h5>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-7">
                        <div class="card">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <div class="row">             
                              <div class="col-md-12">
                                <div class="form-group">
                                  <canvas id="barChart" style="height:67vh;"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /.col -->
                      <div class="col-md-5">
                        <div class="form-group">
                          <table id="table3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No </th>
                              <th>Nama Pegawai</th>
                              <th>Total KK</th>
                              <th>Kategori</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php $no=1;?>
                              @foreach($rating as $data)
                              <tr>
                                <td class="td-status"><a class="btn btn-dark btn-sm" href="{{ url('admin-master/show_score_person',$data->id_employee) }}">
                                    <b>{{ $no++ }}</b></a>
                                </td>
                                <td>{{ $data->emp_name }}</td>
                                <td>{{ $data->totalscore }} Kartu Kuning</td>
                                <td class="text-center">
                                  @if($data->emp_category == 'CS')
                                    <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                                  @endif
                                  @if($data->emp_category == 'MM')
                                    <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                                  @endif
                                  @if($data->emp_category == 'BQ')
                                    <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                                  @endif
                                  @if($data->emp_category == 'GD')
                                    <a class="btn btn-success btn-sm disabled font-weight-bold">GD</a>
                                  @endif
                                  @if($data->emp_category == 'SC')
                                    <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                                  @endif
                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                            <th>NIP </th>
                              <th>Nama Pegawai</th>
                              <th>Total Kartu Kuning</th>
                              <th>Kategori</th>
                            </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- ./card-body -->
                  <div class="card-footer">
                    <div class="row">
                      @foreach($totalm as $total_month)
                      <div class="col-sm-3 col-6 ">
                        <div class="description-block border-right">
                          <h5 class="description-header">{{ $total_month->totalscore }} Kartu Kuning</h5>
                          <span class="description-text">TOTAL BULAN {{ \Carbon\Carbon::parse($total_month->month)->isoFormat('MMMM') }}</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      @endforeach
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.card-footer -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>

            <div class="row">
              <!-- DATA PENILAIAN CLEANING SERVICE -->
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                        <b>DATA PENILAIAN CLEANING SERVICE</b>
                    </h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4" style="text-transform:uppercase">
                        <div class="card card-warning">
                          <div class="card-header">
                            <a href="{{ url('admin-master/show_score_month_22/cs', 2022) }}">
                              <h3 class="card-title"><i class="fas fa-book-reader"></i>&emsp;<b>TOTAL : {{ $totalkk22cs->totalscore }} Kartu Kuning</b></h3>
                            </a>
                          </div>
                        </div>
                        @foreach($totalkkm22cs as $data)
                        <a href="{{ url('admin-master/show_score_month_22/cs', $data->month) }}">
                          <div class="info-box mb-3" style="background-color:#FFC107;color: black;">
                            <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text"><b>{{ \Carbon\Carbon::parse($data->month)->isoFormat('MMMM') }}</b></span>
                              <span class="info-box-number">{{$data->totalscore}} Kartu Kuning</span>
                            </div>
                          </div>
                        </a>
                        @endforeach
                      </div>
                      <div class="col-md-8">
                        <table id="table1a" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>No </th>
                            <th>Tanggal </th>
                            <th>Nama Petugas</th>
                            <th>Kartu Kuning</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $no=1;?>
                            @foreach($score22cs as $data)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                                  {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                              </td>
                              <td>{{ $data->emp_name }}</td>
                              <td>{{ $data->total_score }} Kartu Kuning</td>
                              <td class="text-center">
                                @if($data->emp_category == 'CS')
                                  <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                                @endif
                                @if($data->emp_category == 'MM')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                                @endif
                                @if($data->emp_category == 'BQ')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                                @endif
                                @if($data->emp_category == 'GD')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">GD</a>
                                @endif
                                @if($data->emp_category == 'SC')
                                  <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                                @endif
                              </td>
                              <td class="text-center">                        
                                <a class="btn btn-warning btn-md" href="{{ url('admin-master/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
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
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DATA PENILAIAN BANQUET & MM -->
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                        <b>DATA PENILAIAN BANQUET & MULTIMEDIA</b>
                    </h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4" style="text-transform:uppercase">
                        <div class="card card-warning">
                          <div class="card-header">
                            <a href="{{ url('admin-master/show_score_month_22/bm', 2022) }}">
                              <h3 class="card-title"><i class="fas fa-book-reader"></i>&emsp;<b>TOTAL : {{ $totalkk22bm->totalscore }} Kartu Kuning</b></h3>
                            </a>
                          </div>
                        </div>
                        @foreach($totalkkm22bm as $data)
                        <a href="{{ url('admin-master/show_score_month_22/bm', $data->month) }}">
                          <div class="info-box mb-3" style="background-color:#FFC107;color: black;">
                            <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text"><b>{{ \Carbon\Carbon::parse($data->month)->isoFormat('MMMM') }}</b></span>
                              <span class="info-box-number">{{$data->totalscore}} Kartu Kuning</span>
                            </div>
                          </div>
                        </a>
                        @endforeach
                      </div>
                      <div class="col-md-8">
                        <table id="table1b" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>No </th>
                            <th>Tanggal </th>
                            <th>Nama Petugas</th>
                            <th>Kartu Kuning</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $no=1;?>
                            @foreach($score22bm as $data)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                                  {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                              </td>
                              <td>{{ $data->emp_name }}</td>
                              <td>{{ $data->total_score }} Kartu Kuning</td>
                              <td class="text-center">
                                @if($data->emp_category == 'CS')
                                  <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                                @endif
                                @if($data->emp_category == 'MM')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                                @endif
                                @if($data->emp_category == 'BQ')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                                @endif
                                @if($data->emp_category == 'GD')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">GD</a>
                                @endif
                                @if($data->emp_category == 'SC')
                                  <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                                @endif
                              </td>
                              <td class="text-center">                        
                                <a class="btn btn-warning btn-md" href="{{ url('admin-master/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
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
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DATA PENILAIAN TAMAN -->
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                        <b>DATA PENILAIAN TAMAN</b>
                    </h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4" style="text-transform:uppercase">
                        <div class="card card-warning">
                          <div class="card-header">
                            <a href="{{ url('admin-master/show_score_month_22/gd', 2022) }}">
                              <h3 class="card-title"><i class="fas fa-book-reader"></i>&emsp;<b>TOTAL : {{ $totalkk22gd->totalscore }} Kartu Kuning</b></h3>
                            </a>
                          </div>
                        </div>
                        @foreach($totalkkm22gd as $data)
                        <a href="{{ url('admin-master/show_score_month_22/gd', $data->month) }}">
                          <div class="info-box mb-3" style="background-color:#FFC107;color: black;">
                            <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text"><b>{{ \Carbon\Carbon::parse($data->month)->isoFormat('MMMM') }}</b></span>
                              <span class="info-box-number">{{$data->totalscore}} Kartu Kuning</span>
                            </div>
                          </div>
                        </a>
                        @endforeach
                      </div>
                      <div class="col-md-8">
                        <table id="table1c" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>No </th>
                            <th>Tanggal </th>
                            <th>Nama Petugas</th>
                            <th>Kartu Kuning</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $no=1;?>
                            @foreach($score22gd as $data)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                                  {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                              </td>
                              <td>{{ $data->emp_name }}</td>
                              <td>{{ $data->total_score }} Kartu Kuning</td>
                              <td class="text-center">
                                @if($data->emp_category == 'CS')
                                  <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                                @endif
                                @if($data->emp_category == 'MM')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                                @endif
                                @if($data->emp_category == 'BQ')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                                @endif
                                @if($data->emp_category == 'GD')
                                  <a class="btn btn-success btn-sm disabled font-weight-bold">GD</a>
                                @endif
                                @if($data->emp_category == 'SC')
                                  <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                                @endif
                              </td>
                              <td class="text-center">                        
                                <a class="btn btn-warning btn-md" href="{{ url('admin-master/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
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
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- DATA PENILAIAN SECURITY -->
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">
                        <b>DATA PENILAIAN SECURITY</b>
                    </h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-4" style="text-transform:uppercase">
                        <div class="card card-warning">
                          <div class="card-header">
                            <a href="{{ url('admin-master/show_score_month_22/sc', 2022) }}">
                              <h3 class="card-title"><i class="fas fa-book-reader"></i>&emsp;<b>TOTAL : {{ $totalkk22sc->totalscore }} Kartu Kuning</b></h3>
                            </a>
                          </div>
                        </div>
                        @foreach($totalkkm22sc as $data)
                        <a href="{{ url('admin-master/show_score_month_22/sc', $data->month) }}">
                          <div class="info-box mb-3" style="background-color:#FFC107;color: black;">
                            <span class="info-box-icon"><i class="fas fa-file-signature"></i></span>
                            <div class="info-box-content">
                              <span class="info-box-text"><b>{{ \Carbon\Carbon::parse($data->month)->isoFormat('MMMM') }}</b></span>
                              <span class="info-box-number">{{$data->totalscore}} Kartu Kuning</span>
                            </div>
                          </div>
                        </a>
                        @endforeach
                      </div>
                      <div class="col-md-8">
                        <table id="table1d" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th>No </th>
                            <th>Tanggal </th>
                            <th>Nama Petugas</th>
                            <th>Kartu Kuning</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $no=1;?>
                            @foreach($score22sc as $data)
                            <tr>
                              <td>{{ $no++ }}</td>
                              <td>{{ date('H:i', strtotime($data->score_tm)) }} / 
                                  {{ \Carbon\Carbon::parse($data->score_dt)->isoFormat('DD MMM Y') }}
                              </td>
                              <td>{{ $data->emp_name }}</td>
                              <td>{{ $data->total_score }} Kartu Kuning</td>
                              <td class="text-center">
                                @if($data->emp_category == 'CS')
                                  <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                                @endif
                                @if($data->emp_category == 'MM')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                                @endif
                                @if($data->emp_category == 'BQ')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                                @endif
                                @if($data->emp_category == 'GD')
                                  <a class="btn btn-warning btn-sm disabled font-weight-bold">GD</a>
                                @endif
                                @if($data->emp_category == 'SC')
                                  <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                                @endif
                              </td>
                              <td class="text-center">                        
                                <a class="btn btn-warning btn-md" href="{{ url('admin-master/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
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
                            <th>Kategori</th>
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

          <!-- 2021 -->
          <div class="tab-pane fade" id="custom-content-below-exititem" role="tabpanel" aria-labelledby="custom-content-below-exititem-tab">
            <div class="row">
              <div class="col-md-4" style="text-transform:uppercase;">
                <div class="card card-primary">
                  <div class="card-header">
                    <a href="{{ url('admin-master/show_score_month_21', 2021) }}">
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
                <a href="{{ url('admin-master/show_score_month_21', $data->month) }}">
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
                          <table id="table2a" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th>No </th>
                              <th>Nama Pegawai</th>
                              <th>Total Kartu Kuning</th>
                              <th>Kategori</th>
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
                                  @if($data->emp_category == 'CS')
                                    <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                                  @endif
                                  @if($data->emp_category == 'MM')
                                    <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                                  @endif
                                  @if($data->emp_category == 'BQ')
                                    <a class="btn btn-warning btn-sm disabled font-weight-bold">BQ</a>
                                  @endif
                                  @if($data->emp_category == 'GD')
                                    <a class="btn btn-success btn-sm disabled font-weight-bold">GD</a>
                                  @endif
                                  @if($data->emp_category == 'SC')
                                    <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                                  @endif
                                </td>
                                <td class="text-center">
                                  <a class="btn btn-warning btn-md" href="{{ url('admin-master/show_score_person_21',$data->id_employee) }}">
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
                              <th>Kategori</th>
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
                      <table id="table2b" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>No </th>
                          <th>Tanggal </th>
                          <th>Nama Petugas</th>
                          <th>Kartu Kuning</th>
                          <th>Kategori</th>
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
                              @if($data->emp_category == 'CS')
                                <a class="btn btn-primary btn-sm disabled font-weight-bold">CS</a>
                              @endif
                              @if($data->emp_category == 'MM')
                                <a class="btn btn-warning btn-sm disabled font-weight-bold">MM</a>
                              @endif
                              @if($data->emp_category == 'GD')
                                <a class="btn btn-success btn-sm disabled font-weight-bold">GD</a>
                              @endif
                              @if($data->emp_category == 'SC')
                                <a class="btn btn-dark btn-sm disabled font-weight-bold">SC</a>
                              @endif
                            </td>
                            <td class="text-center">                        
                              <a class="btn btn-warning btn-md" href="{{ url('admin-master/detail_score',$data->id_score) }}"><b><i class="fas fa-file-signature"></i></b></a>
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
                          <th>Kategori</th>
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