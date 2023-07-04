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
                    <li class="breadcrumb-item active">Daftar User</li>
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
                <h3 class="card-title">Daftar Penyedia</h3>
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
                            <th class="text-center">No</th>
                            <th>Role</th>
                            <th>Instansi</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Password</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    @php $no = 1; @endphp
                    <tbody class="text-capitalize">
                        @foreach($user as $row)
                        <tr>
                            <td class="pt-3 text-center">{{ $no++ }} </td>
                            <td class="pt-3 text-center">{{ $row->role->nama_role }} </td>
                            <td>
                                {{ $row->pegawai->instansi }} <br>
                                {{ $row->pegawai->instansi == 'kemenkes' ? $row->pegawai->unitKerja->nama_unit_kerja : $row->pegawai->penyedia->nama_penyedia }}
                            </td>
                            <td class="pt-3 text-center">{{ $row->nip }}</td>
                            <td class="pt-3">{{ $row->pegawai->nama_pegawai }}</td>
                            <td class="pt-3 text-center">{{ $row->password_teks }}</td>
                            <td class="pt-3 text-center">{{ $row->pegawai->jabatan->nama_jabatan }}</td>
                            <td class="pt-3 text-center">{{ $row->status->nama_status }}</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </a>
                                <div class="dropdown-menu">
                                    @if (Auth::user()->role_id == 1)
                                    <a class="dropdown-item btn" type="button" href="{{ route('user.edit', $row->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn" type="button" href="{{ route('user.delete', $row->id) }}" onclick="return confirm('Ingin Menghapus Data?')">
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
            "searching": true
        }).buttons().container().appendTo('#table-show_wrapper .col-md-6:eq(0)')
    })
</script>
@endsection

@endsection
