<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeesModel extends Model
{
    use HasFactory;

    protected $table = "tbl_employees";
    protected $primary_key = "id_employee";
    public $timestamps = false;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_employee',
        'user_id',
        'emp_category',
        'emp_name',
        'emp_position',
        'emp_phone_number',
        'emp_gender',
        'emp_religion',
        'emp_address',
        'status_id'
    ];
}
