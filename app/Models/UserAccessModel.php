<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccessModel extends Model
{
    use HasFactory;

    protected $table = "tbl_users_access";
    protected $primary_key = "id_user_access";
    public $timestamps = false;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user_access',
        'user_id',
        'is_banquet_multimedia',
        'is_cleaning_service',
        'is_gardener',
        'is_security',
        'is_pet_control'
    ];
}
