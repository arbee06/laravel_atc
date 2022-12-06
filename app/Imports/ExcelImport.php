<?php

namespace App\Imports;

use App\Models\CPanelBot;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ExcelImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CPanelBot([
            'npk_atasan'=>$row['npk_atasan'],
            'nama_atasan'=>$row['nama_atasan'],
            'status_atasan'=>$row['status_atasan'],
            'no_hp_atasan'=>$row['no_hp_atasan'],
            'npk_bawahan'=>$row['npk_bawahan'],
            'nama_bawahan'=>$row['nama_bawahan'],
            'status_bawahan'=>$row['status_bawahan'],
            'no_hp_bawahan'=>$row['no_hp_bawahan'],
            'survey_link'=>$row['survey_link'],
        ]);
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
