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
                    <li class="breadcrumb-item active">Daftar Penilaian</li>
                    <li class="breadcrumb-item"><a href="{{ route('penilaian.laporan.show') }}">Laporan Penilaian</a></li>
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
                <h3 class="card-title">Daftar Penilaian (Temuan kartu kuning)</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-header mt-2">
                <form action="{{ route('penilaian.filter.admin') }}" method="POST">
                    @csrf
                    <input type="hidden" name="filter" value="true">
                    <div class="form-group row">
                        <div class="col-5">
                            <select name="bulan" class="form-control form-control-sm">
                                <option value="">Seluruh Bulan</option>
                                @if ($bulanPick)
                                <option value="{{ $bulanPick->first()['id'] }}" selected>{{ $bulanPick->first()['nama_bulan'] }}</option>
                                @endif
                                @foreach ($bulan as $i => $row)
                                <option value="{{ $row['id'] }}">{{ $row['nama_bulan'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-5">
                            <select name="kategori" class="form-control form-control-sm small">
                                <option value="">Seluruh Kategori</option>
                                @if ($kategoriPick)
                                <option value="{{ $kategoriPick->id_kategori }}" selected>{{ $kategoriPick->nama_kategori }}</option>
                                @endif
                                @foreach ($kategori->where('id_kategori','!=',0) as $row)
                                <option value="{{ $row->id_kategori }}">{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-1">
                            <button class="btn btn-primary btn-sm font-weight-bold btn-block">Apply</button>
                        </div>
                        <div class="col-1">
                            <a href="{{ route('penilaian.show') }}" class="btn btn-danger btn-sm font-weight-bold btn-block">
                                <i class="fas fa-undo"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table id="table-show" class="table table-bordered table-striped" style="font-size: 15px;">
                    <thead class="text-center">
                        <tr>
                            <th style="width:0%;">No</th>
                            <th style="width:10%;">Tanggal</th>
                            <th style="width:20%;">Penyedia</th>
                            <th style="width:15%;">Pegawai</th>
                            <th style="width:40%;">Temuan</th>
                            <th style="width:15%;">Pengawas</th>
                            <th style="width:0%;">Aksi</th>
                        </tr>
                    </thead>
                    @php $no = 1; @endphp
                    <tbody class="text-capitalize">
                        @foreach($temuan as $row)
                        <tr>
                            <td class="text-center">{{ $no++ }} </td>
                            <td class="text-center">{{ \Carbon\carbon::parse($row->created_at)->isoFormat('DD-MMM-YY') }} </td>
                            <td class="text-center">{{ $row->pegawai->penyedia->nama_penyedia }}</td>
                            <td>{{ $row->pegawai->nip.' - '.$row->pegawai->nama_pegawai }}</td>
                            <td>
                                @foreach ($row->detail as $i => $subRow)
                                <li class="mb-1">
                                    {{ $subRow->kriteria->nama_kriteria }} <br>
                                    @if($subRow->keterangan)
                                    <small class="ml-4">Keterangan : {{ $subRow->keterangan }} </small>
                                    @endif
                                </li>
                                @endforeach
                            </td>
                            <td>{{ $row->pegawai->nip.' - '.$row->pengawas->pegawai->nama_pegawai }}</td>
                            <td class="text-center pt-2">
                                <a type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </a>
                                <div class="dropdown-menu">
                                    @if (Auth::user()->role_id == 1)
                                    <a class="dropdown-item btn" type="button" href="{{ route('penilaian.edit', $row->id_penilaian) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn" type="button" href="{{ route('penilaian.delete', $row->id_penilaian) }}" onclick="return confirm('Ingin Menghapus Data?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                    @endif
                                </div>
                            </td>
                            <td class="hide export">
                                {{ $row->detail->map(function ($subRow) {
                                    return $subRow->kriteria->nama_kriteria . ($subRow->keterangan ? ' (' . $subRow->keterangan . ')' : '');
                                })->implode(', ') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
        $("#table-show").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "info": true,
            "paging": true,
            "searching": true,
            columnDefs: [{
                "bVisible": false,
                "aTargets": [7]
            }, ],
            buttons: [{
                    extend: 'pdf',
                    text: ' Download (.pdf)',
                    className: 'fas fa-file btn btn-danger mr-2 rounded',
                    title: 'show',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 7, 5]
                    },
                    messageTop: datetime
                },
                {
                    extend: 'excel',
                    text: ' Download (.xlsx)',
                    className: 'fas fa-file btn btn-success mr-2 rounded',
                    title: 'show',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 7, 5]
                    },
                    messageTop: datetime
                }
            ]
        }).buttons().container().appendTo('#table-show_wrapper .col-md-6:eq(0)')
    })
</script>
@endsection

@endsection
