<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaModel extends Model
{
    use HasFactory;

    protected $table = "tbl_criterias";
    protected $primary_key = "id_criteria";
    public $timestamps = false;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_criteria',
        'criteria_category',
        'criteria_name'
    ];
}
