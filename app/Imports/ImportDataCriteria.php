<?php

namespace App\Imports;

use App\Models\CriteriaModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Auth;
use DB;


class ImportDataCriteria implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        foreach ($row as $data){
            $data = DB::table('tbl_criterias')->where('id_criteria', $row[0])->first();
            if ($data == '') {
                CriteriaModel::create ([
                    'id_criteria'       => $row[0],
                    'criteria_category' => $row[1],
                    'criteria_name'     => $row[2],
                ]);
            }
        }
    }


    public function startRow(): int
    {
        return 2;
    }
}
