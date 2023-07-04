<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KriteriaPenilaian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_kriteria_penilaian";
    protected $primaryKey = "id_kriteria";
    public $timestamps = false;

    protected $fillable = [
        'id_kriteria',
        'kategori_id',
        'nama_kriteria'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
