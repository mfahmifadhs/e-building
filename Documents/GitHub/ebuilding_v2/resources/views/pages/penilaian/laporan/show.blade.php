@extends('layout.app')

@section('content')

<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-capitalize">E-BUILDING</h1>
                <h6>Sistem Informasi Manajemen Penilaian Jasa Pengelola Gedung</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-capitalize">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('penilaian.show') }}">Daftar Penilaian</a></li>
                    <li class="breadcrumb-item active">Laporan Penilaian</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Content Header -->

<section class="content">
    <div class="container-fluid">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p style="color:white;margin: auto;">{{ $message }}</p>
        </div>
        @endif
        @if ($message = Session::get('failed'))
        <div class="alert alert-danger">
            <p style="color:white;margin: auto;">{{ $message }}</p>
        </div>
        @endif
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Total Temuan Kartu Kuning 2023 - Cleaning Service</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="table-cs" class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center small">
                            <tr>
                                <th class="align-middle text-center" style="width: 10%">No</th>
                                <th class="align-middle text-center" style="width: 10%">Pegawai</th>
                                @foreach($kriteria->where('kategori_id', 2) as $row)
                                <th class="align-middle text-justify text-center" style="width: 10%">{{ $row->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="text-capitalize">
                            @foreach($temuan->where('pegawai.kategori_id', 2)->groupBy('pegawai_id') as $group)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $group->first()->pegawai->nama_pegawai }}</td>
                                @foreach($kriteria->where('kategori_id', 2) as $subRow)
                                <td class="text-center">
                                    {{ $group->flatMap->detail->where('kriteria_id', $subRow->id_kriteria)->count() }}
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                            @if (!$temuan->where('pegawai.kategori_id', 2)->count())
                            <tr>
                                <td colspan="{{ $kriteria->where('kategori_id', 2)->count() + 2 }}" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Total Temuan Kartu Kuning 2023 - Security</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="table-sc" class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center small">
                            <tr>
                                <th class="align-middle text-center" style="width: 10%">No</th>
                                <th class="align-middle text-center" style="width: 10%">Pegawai</th>
                                @foreach($kriteria->where('kategori_id', 4) as $row)
                                <th class="align-middle text-justify text-center" style="width: 10%">{{ $row->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="text-capitalize">
                            @foreach($temuan->where('pegawai.kategori_id', 4) as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row->pegawai->nama_pegawai }}</td>
                                @foreach($kriteria->where('kategori_id', 4) as $subRow)
                                <td class="text-center">{{ $row->detail->where('kriteria_id', $subRow->id)->count() }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            @if (!$temuan->where('pegawai.kategori_id', 4)->count())
                            <tr>
                                <td colspan="{{ $kriteria->where('kategori_id', 4)->count() + 2 }}" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Total Temuan Kartu Kuning 2023 - Banquet</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="table-bq" class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center small">
                            <tr>
                                <th class="align-middle text-center" style="width: 10%">No</th>
                                <th class="align-middle text-center" style="width: 10%">Pegawai</th>
                                @foreach($kriteria->whereIn('kategori_id', 1) as $row)
                                <th class="align-middle text-justify text-center" style="width: 10%">{{ $row->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="text-capitalize">
                            @foreach($temuan->where('pegawai.kategori_id', 1) as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row->pegawai->nama_pegawai }}</td>
                                @foreach($kriteria->whereIn('kategori_id', 1) as $subRow)
                                <td class="text-center">{{ $row->detail->where('kriteria_id', $subRow->id)->count() }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            @if (!$temuan->whereIn('kategori_id', 1)->count())
                            <tr>
                                <td colspan="{{ $kriteria->whereIn('kategori_id', 1)->count() + 2 }}" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Total Temuan Kartu Kuning 2023 - Multimedia</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="table-mm" class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center small">
                            <tr>
                                <th class="align-middle text-center">No</th>
                                <th class="align-middle text-center">Pegawai</th>
                                @foreach($kriteria->whereIn('kategori_id', 3) as $row)
                                <th class="align-middle text-justify text-center">{{ $row->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="text-capitalize">
                            @foreach($temuan->where('pegawai.kategori_id', 3) as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row->pegawai->nama_pegawai }}</td>
                                @foreach($kriteria->whereIn('kategori_id', 3) as $subRow)
                                <td class="text-center">{{ $row->detail->where('kriteria_id', $subRow->id)->count() }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            @if (!$temuan->whereIn('kategori_id', 3)->count())
                            <tr>
                                <td colspan="{{ $kriteria->whereIn('kategori_id', 3)->count() + 2 }}" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Total Temuan Kartu Kuning 2023 - Taman</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <div class="card-body">
                    <table id="table-gd" class="table table-bordered table-striped" style="font-size: 15px;">
                        <thead class="text-center small">
                            <tr>
                                <th class="align-middle text-center" style="width: 10%">No</th>
                                <th class="align-middle text-center" style="width: 10%">Pegawai</th>
                                @foreach($kriteria->whereIn('kategori_id', 4) as $row)
                                <th class="align-middle text-justify text-center" style="width: 10%">{{ $row->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        @php $no = 1; @endphp
                        <tbody class="text-capitalize">
                            @foreach($temuan->where('pegawai.kategori_id', 4) as $i => $row)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $row->pegawai->nama_pegawai }}</td>
                                @foreach($kriteria->whereIn('kategori_id', 4) as $subRow)
                                <td class="text-center">{{ $row->detail->where('kriteria_id', $subRow->id)->count() }}</td>
                                @endforeach
                            </tr>
                            @endforeach
                            @if (!$temuan->whereIn('kategori_id', 4)->count())
                            <tr>
                                <td colspan="{{ $kriteria->whereIn('kategori_id', 4)->count() + 2 }}" class="text-center">
                                    Tidak ada data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@section('js')
<script>
    $(function() {
        var currentdate = new Date();
        var datetime = "Tanggal: " + currentdate.getDate() + "/" +
            (currentdate.getMonth() + 1) + "/" +
            currentdate.getFullYear() + " \n Pukul: " +
            currentdate.getHours() + ":" +
            currentdate.getMinutes() + ":" +
            currentdate.getSeconds()

        $("#table-cs").DataTable({
            "info": false,
            "paging": false,
            "searching": true,
            buttons: [{
                extend: 'excel',
                text: ' Download (.xlsx)',
                className: 'fas fa-file btn btn-success mr-2 rounded',
                title: 'show',
                messageTop: datetime
            }]
        }).buttons().container().appendTo('#table-cs_wrapper .col-md-6:eq(0)')

        $("#table-sc").DataTable({
            "info": false,
            "paging": false,
            "searching": true,
            buttons: [{
                extend: 'excel',
                text: ' Download (.xlsx)',
                className: 'fas fa-file btn btn-success mr-2 rounded',
                title: 'show',
                messageTop: datetime
            }]
        }).buttons().container().appendTo('#table-sc_wrapper .col-md-6:eq(0)')

        $("#table-bq").DataTable({
            "info": false,
            "paging": false,
            "searching": true,
            buttons: [{
                extend: 'excel',
                text: ' Download (.xlsx)',
                className: 'fas fa-file btn btn-success mr-2 rounded',
                title: 'show',
                messageTop: datetime
            }]
        }).buttons().container().appendTo('#table-bq_wrapper .col-md-6:eq(0)')

        $("#table-mm").DataTable({
            "info": false,
            "paging": false,
            "searching": true,
            buttons: [{
                extend: 'excel',
                text: ' Download (.xlsx)',
                className: 'fas fa-file btn btn-success mr-2 rounded',
                title: 'show',
                messageTop: datetime
            }]
        }).buttons().container().appendTo('#table-mm_wrapper .col-md-6:eq(0)')

        $("#table-gd").DataTable({
            "info": false,
            "paging": false,
            "searching": true,
            buttons: [{
                extend: 'excel',
                text: ' Download (.xlsx)',
                className: 'fas fa-file btn btn-success mr-2 rounded',
                title: 'show',
                messageTop: datetime
            }]
        }).buttons().container().appendTo('#table-gd_wrapper .col-md-6:eq(0)')


    })
</script>
@endsection

@endsection
