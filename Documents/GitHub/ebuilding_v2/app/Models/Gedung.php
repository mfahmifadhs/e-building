<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gedung extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "t_gedung";
    protected $primaryKey = "id_gedung";
    public $timestamps = false;

    protected $fillable = [
        'nama_gedung'
    ];

    public function detail() {
        return $this->hasMany(GedungDetail::class, 'gedung_id');
    }
}
