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
            'npk'=>$row['npk'],
            'nama'=>$row['nama'],
            'status'=>$row['status'],
            'no_hp'=>$row['no_hp'],
            'email'=>$row['email'],
            'batch'=>$row['batch'],
            'category'=>$row['category'],
            'survey_link'=>$row['survey_link'],
        ]);
    }

    // public function headingRow(): int
    // {
    //     return 2;
    // }
}
