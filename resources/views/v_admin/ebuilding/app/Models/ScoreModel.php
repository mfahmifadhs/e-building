<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScoreModel extends Model
{
    use HasFactory;

    protected $table = "tbl_scores";
    protected $primary_key = "id_score";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'emp_id',
        'working_area_id ',
        'total_score',
        'total_score_accumulation',
        'score_notes',
        'score_tm',
        'score_dt'
    ];
}
