<?php

namespace App\Imports;

use App\Models\EmployeesModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Auth;
use DB;


class ImportDataPegawai implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // return new EmployeesModel([
        //     'id_employee'       => $row[0],
        //     'user_id'           => $row[1],
        //     'emp_category'      => $row[2],
        //     'emp_name'          => $row[3],
        //     'emp_position'      => $row[4],
        //     'emp_phone_number'  => $row[5],
        //     'emp_gender'        => $row[6],
        //     'emp_religion'      => $row[7],
        //     'emp_address'       => $row[8],
        //     'status_id'         => 1
        // ]);


        foreach ($row as $data){
            $data = DB::table('tbl_employees')->where('id_employee', $row[0])->first();
            if ($data == '') {
                EmployeesModel::create ([
                    'id_employee'       => $row[0],
                    'user_id'           => $row[1],
                    'emp_category'      => strtoupper($row[2]),
                    'emp_name'          => strtoupper($row[3]),
                    'emp_position'      => strtoupper($row[4]),
                    'emp_phone_number'  => $row[5],
                    'emp_gender'        => strtoupper($row[6]),
                    'emp_religion'      => strtoupper($row[7]),
                    'emp_address'       => strtoupper($row[8]),
                    'status_id'         => 1
                ]);
            }
        }
    }


    public function startRow(): int
    {
        return 2;
    }
}
