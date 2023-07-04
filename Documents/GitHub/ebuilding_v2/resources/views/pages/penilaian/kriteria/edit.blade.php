@extends('layout.app')

@section('content')

<!-- Content Header -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-capitalize">E - BUILDING</h1>
                <h6>Sistem Informasi Manajemen Penilaian Jasa Pengelola Gedung</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-capitalize">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('kriteria.show') }}">Kriteria Penilaian</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Content Header -->

<section class="content">
    <div class="container">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Edit Kriteria Penilaian</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('kriteria.edit', $kriteria->id_kriteria) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kategori*</label>
                        <div class="kemenkes-select col-md-10">
                            <select name="kategori_id" class="form-control">
                                <option value="{{ $kriteria->kategori_id }}">{{ $kriteria->kategori->nama_kategori }}</option>
                                @foreach ($kategori->where('id_kategori','!=',$kriteria->kategori_id) as $row)
                                <option value="{{ $row->id_kategori }}">{{ strtoupper($row->nama_kategori) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Kriteria*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" placeholder="Kriteria Penilaian">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Simpan Perubahan ?')">
                        <i class="fas fa-save fa-1x"></i> <b>Simpan</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
