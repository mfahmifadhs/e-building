<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penilaian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_penilaian";
    protected $primaryKey = "id_penilaian";
    public $timestamps = false;

    protected $fillable = [
        'pengawas_id',
        'pegawai_id',
        'area_kerja_id',
    ];

    public function detail() {
        return $this->hasMany(PenilaianDetail::class, 'penilaian_id')->join('t_kriteria_penilaian','id_kriteria','kriteria_id');
    }

    public function pengawas() {
        return $this->belongsTo(User::class, 'pengawas_id');
    }

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function areaKerja() {
        return $this->belongsTo(AreaKerja::class, 'area_kerja_id');
    }
}
