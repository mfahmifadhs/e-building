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
                    <li class="breadcrumb-item"><a href="{{ route('pegawai.show') }}">Daftar Pegawai</a></li>
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
                <h3 class="card-title">Tambah Pegawai</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('pegawai.create') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row instansi">
                        <label class="col-md-2 col-form-label">Instansi*</label>
                        <div class="col-md-10 mt-2">
                            <span class="mr-4">
                                <input type="radio" name="instansi" value="kemenkes" required> Kemenkes
                            </span>
                            <span class="mr-3">
                                <input type="radio" name="instansi" value="penyedia" required> Penyedia
                            </span>
                        </div>
                    </div>
                    <div class="form-group row kemenkes" style="display: none;">
                        <label class="col-md-2 col-form-label">Unit Kerja*</label>
                        <div class="col-md-10">
                            <select name="unit_kerja_id" class="form-control">
                                <option value="">-- PILIH UNIT KERJA --</option>
                                @foreach ($unitKerja as $row)
                                <option value="{{ $row->id_unit_kerja }}">{{ strtoupper($row->nama_unit_kerja) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row penyedia" style="display: none;">
                        <label class="col-md-2 col-form-label">Penyedia*</label>
                        <div class="col-md-10">
                            <select id="penyedia" name="penyedia_id" class="form-control">
                                <option value="">-- PILIH PENYEDIA --</option>
                                @foreach ($penyedia as $row)
                                <option value="{{ $row->id_penyedia }}">{{ $row->nama_penyedia }}</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-md-2 mt-3 col-form-label">Posisi*</label>
                        <div class="col-md-10 mt-4">
                            <span class="mr-4">
                                <input type="radio" name="kategori_id" value="1" required> Banquet
                            </span>
                            <span class="mr-4">
                                <input type="radio" name="kategori_id" value="2" required> Cleaning Service
                            </span>
                            <span class="mr-4">
                                <input type="radio" name="kategori_id" value="3" required> Multimedia
                            </span>
                            <span class="mr-4">
                                <input type="radio" name="kategori_id" value="4" required> Security
                            </span>
                            <span class="mr-3">
                                <input type="radio" name="kategori_id" value="5" required> Taman
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nomor Induk Pegawai</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="nip" placeholder="Nomor Induk Pegawai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Pegawai*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_pegawai" placeholder="Nama Pegawai" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jabatan Pegawai*</label>
                        <div class="col-md-10">
                            <select id="penyedia" name="jabatan_id" class="form-control" required>
                                <option value="">-- PILIH JABATAN --</option>
                                @foreach ($jabatan as $row)
                                <option value="{{ $row->id_jabatan }}">{{ $row->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jenis Kelamin*</label>
                        <div class="col-md-10 mt-2">
                            <span class="mr-4">
                                <input type="radio" name="jenis_kelamin" value="L" required> Pria
                            </span>
                            <span class="mr-3">
                                <input type="radio" name="jenis_kelamin" value="P" required> Wanita
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">No. Handphone*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="no_hp" placeholder="Nomor HP" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat*</label>
                        <div class="col-md-10">
                            <textarea name="alamat" class="form-control" placeholder="Alamat Pegawai"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status Pegawai*</label>
                        <div class="col-md-4">
                            <select class="form-control" name="status_id" required>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                            </select>
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

@section('js')
<script>
    $(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

        $('input[name="instansi"]').change(function() {
            var selectedValue = $(this).val();

            // Menampilkan/menyembunyikan div berdasarkan nilai yang dipilih
            if (selectedValue === 'kemenkes') {
                $('.kemenkes').show();
                $('.penyedia').hide();
            } else if (selectedValue === 'penyedia') {
                $('.kemenkes').hide();
                $('.penyedia').show();
            }
        });
    })
</script>
@endsection

@endsection
