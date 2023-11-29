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
                    <li class="breadcrumb-item"><a href="{{ route('gedung.show') }}">Daftar Gedung</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('area_kerja.show') }}">Daftar Area Kerja</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
                <h3 class="card-title">Tambah Area Kerja</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('area_kerja.create') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Kategori*</label>
                        <div class="kemenkes-select col-md-10">
                            <select name="kategori_id" class="form-control">
                                <option value="">-- PILIH KATEGORI --</option>
                                @foreach ($kategori->whereIn('id_kategori', [4,6]) as $row)
                                <option value="{{ $row->id_kategori }}">{{ strtoupper($row->nama_kategori) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gedung*</label>
                        <div class="kemenkes-select col-md-10">
                            <select name="gedung_id" class="form-control">
                                <option value="">-- PILIH GEDUNG --</option>
                                @foreach ($gedung as $row)
                                <option value="{{ $row->id_gedung }}">{{ strtoupper($row->nama_gedung) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Area Kerja*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_area_kerja" placeholder="Area Kerja" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Keterangan*</label>
                        <div class="col-md-10">
                            <textarea name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary" onclick="return confirm('Tambah Baru ?')">
                        <i class="fas fa-paper-plane fa-1x"></i> <b>Submit</b>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
