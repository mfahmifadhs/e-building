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
                    <li class="breadcrumb-item"><a href="{{ route('gedung.show') }}">Daftar Gedung</a></li>
                    <li class="breadcrumb-item active">Area Kerja</li>
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
                <h3 class="card-title">Area Kerja</h3>
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
                            <th>Kategori</th>
                            <th>Nama Gedung</th>
                            <th>Area Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    @php $no = 1; @endphp
                    <tbody class="text-capitalize">
                        @foreach($area as $row)
                        <tr>
                            <td class="pt-3 text-center">{{ $no++ }} </td>
                            <td class="pt-3">{{ $row->kategori->nama_kategori }}</td>
                            <td class="pt-3">{{ $row->gedung->nama_gedung }}</td>
                            <td class="pt-3">{{ $row->nama_area_kerja }}</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-primary btn-sm" data-toggle="dropdown">
                                    <i class="fas fa-bars"></i>
                                </a>
                                <div class="dropdown-menu">
                                    @if (Auth::user()->role_id == 1)
                                    <a class="dropdown-item btn" type="button" href="{{ route('area_kerja.edit', $row->id_area_kerja) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a class="dropdown-item btn" type="button" href="{{ route('area_kerja.delete', $row->id_area_kerja) }}" onclick="return confirm('Ingin Menghapus Data?')">
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
