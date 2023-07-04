<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AreaKerja extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_area_kerja";
    protected $primaryKey = "id_area_kerja";
    public $timestamps = false;

    protected $fillable = [
        'kategori_id',
        'gedung_id',
        'nama_area_kerja',
        'keterangan'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function gedung() {
        return $this->belongsTo(Gedung::class, 'gedung_id');
    }
}
