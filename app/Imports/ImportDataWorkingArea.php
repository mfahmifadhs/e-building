<?php

namespace App\Imports;

use App\Models\WorkingAreaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Auth;
use DB;


class ImportDataWorkingArea implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        foreach ($row as $data){
            $data = DB::table('tbl_working_areas')->where('id_working_area', $row[0])->first();
            if ($data == '') {
                WorkingAreaModel::create ([
                    'id_working_area'       => $row[0],
                    'working_area_name'     => $row[1],
                    'working_area_category' => $row[2],
                ]);
            }
        }
    }


    public function startRow(): int
    {
        return 2;
    }
}
