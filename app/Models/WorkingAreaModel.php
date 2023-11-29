<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingAreaModel extends Model
{
    use HasFactory;

    protected $table = "tbl_working_areas";
    protected $primary_key = "id_working_area";
    public $timestamps = false;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_working_area',
        'working_area_name',
        'working_area_category'
    ];
}
