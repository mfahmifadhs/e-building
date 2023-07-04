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
                    <li class="breadcrumb-item active">Daftar Penyedia</li>
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
                <h3 class="card-title">Daftar Pegawai</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table id="table-show" class="table table-bordered table-striped" style="font-size: 15px;">
                    <thead class="text-center">
                        <tr>
                            <th>No</th>
                            <th>ID</th>
                            <th>Intansi</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Jenis Kelamin</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php $no = 1; @endphp
                    <tbody class="text-capitalize">
                        @foreach($pegawai as $row)
                        <tr>
                            <td class="pt-3 text-center">{{ $no++ }} </td>
                            <td class="pt-3 text-center">{{ $row->id_pegawai }} </td>
                            <td>
                                {{ $row->instansi == 'kemenkes' ? $row->instansi : $row->instansi.' - '.$row->kategori->nama_kategori }} <br>
                                {{ $row->instansi == 'kemenkes' ? $row->unitKerja->nama_unit_kerja : $row->penyedia->nama_penyedia }}
                            </td>
                            <td class="pt-3 text-center">{{ $row->nip }}</td>
                            <td class="pt-3">{{ $row->nama_pegawai }}</td>
                            <td class="pt-3 text-center">{{ $row->jabatan->nama_jabatan }}</td>
                            <td class="pt-3 text-center">{{ $row->jenis_kelamin == 'L' ? 'Pria' : 'Wanita' }}</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </a>
                                <div class="dropdown-menu">
                                    @if (Auth::user()->role_id == 1)
                                    <a class="dropdown-item btn" type="button" href="{{ route('pegawai.edit', $row->id_pegawai) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn" type="button" href="{{ route('pegawai.delete', $row->id_pegawai) }}" onclick="return confirm('Ingin Menghapus Data?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                    @endif
                                </div>
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
        $("#table-show").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "info": true,
            "paging": true,
            "searching": true,
            "columnDefs": [{
                "width": "0%",
                "targets": 0,

            }, {
                "width": "0%",
                "targets": 1,

            }, {
                "width": "20%",
                "targets": 2
            }, {
                "width": "0%",
                "targets": 3
            }, {
                "width": "12%",
                "targets": 6
            }
        ]
        }).buttons().container().appendTo('#table-show_wrapper .col-md-6:eq(0)')
    })
</script>
@endsection

@endsection
