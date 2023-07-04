<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pegawai extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_pegawai";
    protected $primaryKey = "id_pegawai";
    public $timestamps = false;

    protected $fillable = [
        'id_pegawai',
        'instansi',
        'kategori_id',
        'penyedia_id',
        'unit_kerja_id',
        'nip',
        'nama_pegawai',
        'jabatan_id',
        'jenis_kelamin',
        'no_hp',
        'agama',
        'alamat'
    ];

    public function jabatan() {
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function unitkerja() {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function penyedia() {
        return $this->belongsTo(Penyedia::class, 'penyedia_id');
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function users() {
        return $this->hasOne(User::class, 'pegawai_id');
    }
}
