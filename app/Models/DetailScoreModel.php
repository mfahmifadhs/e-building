<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailScoreModel extends Model
{
    use HasFactory;

    protected $table = "tbl_score_details";
    protected $primary_key = "id_score_detail";
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_score_detail',
        'score_id',
        'criteria_id ',
        'score',
        'description',
        'img_discovery'
    ];
}
