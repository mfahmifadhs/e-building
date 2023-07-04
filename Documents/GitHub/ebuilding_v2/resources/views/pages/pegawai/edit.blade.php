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
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Content Header -->

<section class="content">
    <div class="container">
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
                <h3 class="card-title">Edit Pegawai</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('pegawai.edit', $pegawai->id_pegawai) }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group row instansi">
                        <label class="col-md-2 col-form-label">Instansi*</label>
                        <div class="col-md-10 mt-2">
                            <span class="mr-4">
                                <input type="radio" name="instansi" value="kemenkes" <?php echo $pegawai->instansi == 'kemenkes' ? 'checked' : ''; ?>> Kemenkes
                            </span>
                            <span class="mr-3">
                                <input type="radio" name="instansi" value="penyedia" <?php echo $pegawai->instansi == 'penyedia' ? 'checked' : ''; ?>> Penyedia
                            </span>
                        </div>
                    </div>

                    @if ($pegawai->instansi != 'kemenkes')
                    <div class="form-group row kemenkes" style="display: none;">
                    @else
                    <div class="form-group row penyedia">
                    @endif
                        <label class="col-md-2 col-form-label">Unit Kerja*</label>
                        <div class="kemenkes-select col-md-10">
                            <select name="unit_kerja_id" class="form-control">
                                @if ($pegawai->instansi == 'kemenkes')
                                <option value="{{ $pegawai->unit_kerja_id }}">
                                    {{ strtoupper($pegawai->unitKerja->nama_unit_kerja) }}
                                </option>
                                @else
                                <option value="">-- PILIH PENYEDIA --</option>
                                @endif
                                @foreach ($unitKerja->where('id_unit_kerja','!=',$pegawai->unit_kerja_id) as $row)
                                <option value="{{ $row->id_unit_kerja }}">{{ strtoupper($row->nama_unit_kerja) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if ($pegawai->instansi != 'penyedia')
                    <div class="form-group row penyedia" style="display: none;">
                    @else
                    <div class="form-group row penyedia">
                    @endif
                        <label class="col-md-2 col-form-label">Penyedia*</label>
                        <div class="col-md-10">
                            <select id="penyedia" name="penyedia_id" class="form-control">
                                @if ($pegawai->instansi == 'penyedia')
                                <option value="{{ $pegawai->penyedia_id }}">
                                    {{ $pegawai->penyedia->nama_penyedia }}
                                </option>
                                @else
                                <option value="">-- PILIH PENYEDIA --</option>
                                @endif
                                @foreach ($penyedia->where('id_penyedia','!=',$pegawai->penyedia_id) as $row)
                                <option value="{{ $row->id_penyedia }}">{{ $row->nama_penyedia }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nomor Induk Pegawai</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="nip" value="{{ $pegawai->nip }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nama Pegawai*</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="nama_pegawai" value="{{ $pegawai->nama_pegawai }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jabatan Pegawai*</label>
                        <div class="col-md-10">
                            <select id="penyedia" name="jabatan_id" class="form-control" required>
                                <option value="{{ $pegawai->jabatan_id }}">{{ $pegawai->jabatan->nama_jabatan }}</option>
                                @foreach ($jabatan->where('id_jabatan','!=',$pegawai->jabatan_id) as $row)
                                <option value="{{ $row->id_jabatan }}">{{ $row->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Jenis Kelamin*</label>
                        <div class="col-md-10 mt-2">
                            <span class="mr-4">
                                <input type="radio" name="jenis_kelamin" value="L" <?php echo $pegawai->jenis_kelamin == 'L' ? 'checked' : ''; ?>> Pria
                            </span>
                            <span class="mr-3">
                                <input type="radio" name="jenis_kelamin" value="P" <?php echo $pegawai->jenis_kelamin == 'P' ? 'checked' : ''; ?>> Wanita
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">No. Handphone*</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" name="no_hp" placeholder="Nomor HP" value="{{ $pegawai->no_hp }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Alamat*</label>
                        <div class="col-md-10">
                            <textarea name="alamat" class="form-control" placeholder="Alamat Pegawai">{{ $pegawai->alamat }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status Pegawai*</label>
                        <div class="col-md-4">
                            <select class="form-control" name="status_id" required>
                                <option value="1" {{ $pegawai->status_id == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="2" {{ $pegawai->status_id == 2 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
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
