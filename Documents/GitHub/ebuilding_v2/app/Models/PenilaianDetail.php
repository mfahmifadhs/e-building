<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PenilaianDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_penilaian_detail";
    protected $primaryKey = "id_detail";
    public $timestamps = false;

    protected $fillable = [
        'penilaian_id',
        'kriteria_id',
        'keterangan'
    ];

    public function penilaian() {
        return $this->belongsTo(Penilaian::class, 'penilaian_id');
    }

    public function kriteria() {
        return $this->belongsTo(KriteriaPenilaian::class, 'kriteria_id');
    }
}
