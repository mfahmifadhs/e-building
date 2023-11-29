@extends('layout.app')

@section('content')

<!-- Content Header -->
<section class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-capitalize">E-BUILDING</h1>
                <h6>Sistem Informasi Manajemen Penilaian Jasa Pengelola Gedung</h6>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-capitalize">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('penilaian.show') }}">Daftar Penilaian</a></li>
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
                <h3 class="card-title">Edit Penilaian</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('penilaian.edit', $id) }}" method="POST">
                <div class="card-body">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Posisi Bagian*</label>
                        <div class="col-md-10">
                            <select id="kategori" name="posisi_id" class="form-control" disabled>
                                <option value="">{{ $temuan->pegawai->kategori->nama_kategori }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Pegawai*</label>
                        <div class="col-md-10">
                            <input type="hidden" name="pengawas_id" value="{{ $temuan->pengawas_id }}">
                            <input type="hidden" name="pegawai_id" value="{{ $temuan->pegawai_id }}">
                            <select id="pegawai" name="pegawai_id" class="form-control" disabled>
                                <option value="">{{ $temuan->pegawai->nama_pegawai }}</option>
                            </select>
                            <p class="card-text text-danger" id="error-message"></p>
                        </div>
                    </div>

                    <div class="card pegawai" style="display: none;font-size:13px;">
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-12 mb-2">
                                    <h6 class="text-center">Informasi Pegawai</h6>
                                </div>
                                <div class="col-6 mb-3">
                                    <span class="card-text">Nama Pegawai</span>
                                    <p class="card-text" id="nama-pegawai">Muhammad Fahmi</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <span class="card-text">NIP</span>
                                    <p class="card-text" id="nip">24331</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <span class="card-text">Posisi</span>
                                    <p class="card-text" id="posisi">Cleaning Service</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <span class="card-text">Penyedia</span>
                                    <p class="card-text" id="penyedia">PT. Trans Dana Profitri</p>
                                </div>
                                <div class="col-6 mb-2">
                                    <span class="card-text">Jenis Kelamin</span>
                                    <p class="card-text" id="jenis-kelamin">Pria</p>
                                </div>
                                <div class="col-6">
                                    <span class="card-text">No. Hp</span>
                                    <p class="card-text" id="no-hp">085772652563</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Area Kerja*</label>
                        <div class="col-md-10">
                            <select id="area-kerja" name="area_kerja_id" class="form-control" required>
                                <option value="">-- PILIH AREA KERJA --</option>
                            </select>
                            <p class="card-text text-danger" id="error-message"></p>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label class="col-md-2 col-form-label">Temuan Kartu Kuning*</label>
                        <div class="col-md-10 mt-2">

                            @foreach($kriteria as $i => $row)
                            <div class="form-group row">
                                <div class="col-md-1">
                                    <input type="hidden" class="form-control" name="kriteria[{{ $row->id_kriteria }}]" value="{{ $row->id_kriteria }}">
                                    <input type="hidden" class="form-control" name="temuan[{{ $row->id_kriteria }}]" value="">
                                    <input type="checkbox" style="width:30px;height:30px;" name="temuan[{{ $row->id_kriteria }}]" value="true" {{ $temuan->detail->where('kriteria_id', $row->id_kriteria)->isNotEmpty() ? 'checked' : '' }}>
                                </div>
                                <div class="col-md-10">
                                    {{ $row->nama_kriteria }} <br>
                                    <input type="text" class="form-control input-border-bottom" name="keterangan[{{ $row->id_kriteria }}]" value="{{ $temuan->detail->where('kriteria_id', $row->id_kriteria)->pluck('keterangan')->implode(', ') }}">
                                    <input type="hidden" name="detail[{{ $row->id_kriteria }}]" value="{{ $temuan->detail->where('kriteria_id', $row->id_kriteria)->pluck('id_detail')->implode(', ') }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <button id="btn-submit" class="btn btn-primary font-weight-bold" onclick="return confirm('Tambah Penilaian ?')">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@section('js')
<script>
    $(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
        $("#area-kerja").select2();
        var pegawaiId = '{{ $temuan->pegawai->id_pegawai }}'
        $.ajax({
            type: "GET",
            url: "/gedung/area-kerja/select/" + pegawaiId,
            dataType: 'JSON',
            success: function(res) {
                if (res) {
                    $("#area-kerja").empty();
                    $('#area-kerja').append(
                        '<option value="">-- PILIH AREA KERJA --</option>'
                    );
                    $.each(res, function(index, area) {
                        var area_kerja = area.nama_gedung.toUpperCase() + ' - ' + area.nama_area_kerja.toUpperCase();
                        var selected = (area.id_area_kerja == "{{ $temuan->area_kerja_id }}") ? 'selected' : '';
                        $("#area-kerja").append(
                            '<option value="' + area.id_area_kerja + '" ' + selected + '>' + area_kerja + '</option>'
                        );
                    });
                } else {
                    $("#area-kerja").empty();
                }
            }
        });
    })
</script>
@endsection

@endsection
