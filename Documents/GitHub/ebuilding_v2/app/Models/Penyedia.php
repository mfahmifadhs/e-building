<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penyedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_penyedia";
    protected $primaryKey = "id_penyedia";
    public $timestamps = false;

    protected $fillable = [
        'nama_penyedia'
    ];

    public function pegawai() {
        return $this->belongsTo(Pegawai::class, 'penyedia_id');
    }
}
