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
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Penilaian</li>
                </ol>
            </div>
        </div>
    </div>
</section>



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
        <div class="row">

            <div class="col-12 col-md-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 1 ? 'active' : '' }}" id="temuan" data-toggle="pill" href="#temuan-tab" role="tab" aria-selected="true">Temuan Kartu Kuning</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $tab == 2 ? 'active' : '' }}" id="riwayat" data-toggle="pill" href="#riwayat-tab" role="tab" aria-selected="false">Riwayat Kartu Kuning</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade {{ $tab == 1 ? 'active show' : '' }} " id="temuan-tab" role="tabpanel" aria-labelledby="temuan">

                                <form action="{{ route('penilaian.create') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Posisi Bagian*</label>
                                        <div class="col-md-10">
                                            <select id="kategori" name="posisi_id" class="form-control" required>
                                                <option value="">-- PILIH POSISI BAGIAN --</option>
                                                @foreach($kategori->where('id_kategori','!=',0) as $row)
                                                <option value="{{ $row->id_kategori }}">{{ strtoupper($row->nama_kategori) }}</option>
                                                @endforeach
                                            </select>
                                            <p class="card-text text-danger" id="error-message"></p>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">Pegawai*</label>
                                        <div class="col-md-10">
                                            <select id="pegawai" name="pegawai_id" class="form-control" required>
                                                <option value="">-- PILIH PEGAWAI --</option>
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
                                        <span class="temuan-title"></span>
                                        <span class="temuan"></span>
                                    </div>
                                    <div class="text-right">
                                        <button id="btn-submit" class="btn btn-primary font-weight-bold" onclick="return confirm('Tambah Penilaian ?')" disabled>
                                            <i class="fas fa-paper-plane"></i> Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade {{ $tab == 2 ? 'active show' : '' }}" id="riwayat-tab" role="tabpanel" aria-labelledby="riwayat">
                                <form action="{{ route('penilaian.filter') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="filter" value="true">
                                    <div class="form-group row">
                                        <h6 class="col-12 card-title mb-2">Filter</h6>
                                        <div class="col-4">
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
                                        <div class="col-4">
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
                                        <div class="col-2">
                                            <button class="btn btn-primary btn-sm font-weight-bold btn-block">Apply</button>
                                        </div>
                                        <div class="col-2">
                                            <a href="{{ route('dashboard') }}" class="btn btn-danger btn-sm font-weight-bold btn-block">
                                                <i class="fas fa-undo"></i>
                                            </a>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <table id="table-show" class="table table-striped table-bordered text-capitalize">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="pb-4" style="width: 0%;">No</th>
                                            <th class="pb-4" style="width: 90%;">Penilai</th>
                                            <th class="pb-4" style="width: 10%;">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($temuan)
                                        @foreach($temuan as $i => $row)
                                        <tr>
                                            <td class="text-center">{{ $i+1 }}</td>
                                            <td>
                                                <div class="form-group row">
                                                    <div class="col-4 col-md-2 card-text">Tanggal</div>:
                                                    <div class="col-7 col-md-9 card-text">
                                                        {{ \Carbon\carbon::parse($row->created_at)->isoFormat('DD-MMM-YY') }}
                                                    </div>
                                                    <div class="col-4 col-md-2 card-text">Pengawas</div>:
                                                    <div class="col-7 col-md-9 card-text">
                                                        {{ $row->pengawas->pegawai->nama_pegawai }}
                                                    </div>
                                                    <div class="col-4 col-md-2 card-text">Pegawai</div>:
                                                    <div class="col-7 col-md-9 card-text">
                                                        {{ $row->pegawai->nama_pegawai }}
                                                    </div>
                                                    <div class="col-4 col-md-2 card-text">Posisi</div>:
                                                    <div class="col-7 col-md-9 card-text">
                                                        {{ $row->pegawai->kategori->nama_kategori }}
                                                    </div>
                                                    <div class="col-4 col-md-2 card-text">Jumlah</div>:
                                                    <div class="col-7 col-md-9 card-text">
                                                        {{ $row->detail->count() }} temuan
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a type="button" data-toggle="modal" onclick="showModal('{{ $row->id_penilaian }}')" class="btn btn-primary btn-sm" data-toggle="dropdown">
                                                    <i class="fas fa-id-card"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@foreach ($temuan as $i => $row)
<div class="modal fade" id="temuan-{{ $row->id_penilaian }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectModal">Temuan Kartu Kuning</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" name="status" value="false">
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-12 mb-2">
                        <h6>Informasi Pegawai</h6>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="card-text">Nama Pegawai</span>
                        <p class="card-text">{{ $row->pegawai->nama_pegawai }}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="card-text">NIP</span>
                        <p class="card-text">{{ $row->pegawai->nip }}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="card-text">Posisi</span>
                        <p class="card-text">{{ $row->pegawai->kategori->nama_kategori }}</p>
                    </div>
                    <div class="col-6 mb-3">
                        <span class="card-text">Penyedia</span>
                        <p class="card-text">{{ $row->pegawai->penyedia->nama_penyedia }}</p>
                    </div>
                    <div class="col-6">
                        <span class="card-text">Jenis Kelamin</span>
                        <p class="card-text">{{ $row->pegawai->jenis_kelamin == 'P' ? 'Pria' : 'Wanita' }}</p>
                    </div>
                    <div class="col-6">
                        <span class="card-text">No. Hp</span>
                        <p class="card-text">{{ $row->pegawai->no_hp }}</p>
                    </div>
                    <div class="col-12 mb-2">
                        <hr>
                        <h6>Area Kerja</h6>
                        <p class="card-text">
                            {{ $row->areaKerja->gedung->nama_gedung }} - {{ $row->areaKerja->nama_area_kerja }}
                        </p>
                    </div>
                    <div class="col-12 mb-2">
                        <hr>
                        <h6>Temuan Kartu Kuning</h6>
                    </div>
                    @foreach ($row->detail as $y => $subRow)
                    <div class="col-1 mb-2">
                        <span class="card-text mr-2">{{ $y+1 }}.</span>
                    </div>
                    <div class="col-11 mb-2">
                        <span class="card-text">{{ $subRow->kriteria->nama_kriteria }}</span> <br>
                        <span class="card-text">
                            Keterangan : {{ $subRow->keterangan ? $subRow->keterangan : '-' }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@section('js')
<script>
    $(document).ready(function() {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')

        $("#pegawai").select2();
        $('#kategori').on('change', function() {
            var kategori = $(this).val()
            if (kategori) {
                $.ajax({
                    type: "GET",
                    url: "/pegawai/select/" + kategori,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res) {
                            $("#pegawai").empty();
                            $('#pegawai').append(
                                '<option value="">-- PILIH PEGAWAI --</option>'
                            );
                            $.each(res, function(index, pegawai) {
                                var nama_pegawai = pegawai.nama_pegawai.toUpperCase();
                                $("#pegawai").append(
                                    '<option value="' + pegawai.id_pegawai + '">' + pegawai.nip + ' - ' + nama_pegawai + '</option>'
                                );
                            });
                        } else {
                            $("#pegawai").empty();
                        }
                    }
                });
            } else {
                $("#pegawai").empty();
            }
        });

        $('#pegawai').on('change', function() {
            var pegawaiId = $(this).val()
            if (pegawaiId !== '') {
                $('.pegawai').show()
                $('.temuan').show()
                $('#btn-submit').prop('disabled', false);

                $.ajax({
                    url: '/pegawai/info/' + pegawaiId,
                    type: 'GET',
                    success: function(response) {
                        $('#nama-pegawai').text(response.nama_pegawai);
                        $('#nip').text(response.nip);
                        $('#posisi').text(response.posisi);
                        $('#penyedia').text(response.penyedia);
                        $('#jenis-kelamin').text(response.jenis_kelamin);
                        $('#no-hp').text(response.no_hp);
                    },
                    error: function(xhr) {
                        var errorMessage = xhr.responseText;
                        $('#error-message').text('Terjadi kesalahan: ' + errorMessage);
                    }
                })

                $.ajax({
                    url: '/penilaian/kriteria/info/' + pegawaiId, // Ganti URL dengan endpoint yang sesuai
                    type: 'GET',
                    success: function(response) {
                        $('.temuan .temuan-title .kriteria-penilaian').remove();
                        $('.temuan-title').empty()
                        $('.temuan-title').append(
                            '<label class="col-12 col-form-label">Temuan Kartu Kuning</label>'
                        );
                        $.each(response, function(index, kriteria) {
                            var kriteriaHtml =
                                `
                                    <div class="col-1 ml-2">
                                        <input type="hidden" class="form-control" name="kriteria[` + index + `]" value="` + kriteria.id_kriteria + `">
                                        <input type="hidden" class="form-control" name="temuan[` + index + `]" value="">
                                        <input type="checkbox" class="form-control" name="temuan[` + index + `]" value="true">
                                    </div>
                                    <div class="col-10 mt-1">
                                        <p class="card-text">` + (index + 1) + `. ` + kriteria.nama_kriteria + `</p>
                                        <p>
                                            <input type="text" name="keterangan[]" class="form-control input-border-bottom" placeholder="Keterangan">
                                        </p>
                                    </div>
                                `


                            $('.temuan').append('<div class="row kriteria-penilaian">' + kriteriaHtml + '</div>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });

                $("#area-kerja").select2();
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
                                $("#area-kerja").append(
                                    '<option value="' + area.id_area_kerja + '">' + area_kerja + '</option>'
                                );
                            });
                        } else {
                            $("#area-kerja").empty();
                        }
                    }
                });

            } else {
                $('.pegawai').show()
                $('.temuan').show()
            }
        })

        $(document).ready(function() {
            $('.form-temuan').submit(function(event) {
                var checkboxes = $('input[name^="temuan["]:checked');
                if (checkboxes.length < 1) {
                    event.preventDefault();
                    alert('Pilih minimal satu temuan.');
                }
            });
        });

        $("#table-show").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            "info": true,
            "paging": true,
            "searching": true
        }).buttons().container().appendTo('#table-show_wrapper .col-md-6:eq(0)')
    })

    function showModal(id_temuan) {
        var modal_target = "#temuan-" + id_temuan;
        $(modal_target).modal('show');
    }
</script>
@endsection

@endsection
