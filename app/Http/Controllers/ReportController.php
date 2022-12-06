<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;

class ReportController extends Controller
{
    //

    public function create_per_tabular(Request $request)
    {
        $data = $request->all();
        $data_atasan_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data_atasan')){
                $hp_atasan_key = $key;
            }
        }
        date_default_timezone_set('Asia/Jakarta');
        $curr_date = date('F d,Y');
        $data_atasan_value = $request->input($hp_atasan_key);
        $data_atasan = explode(':',$data_atasan_value);
        $hp_atasan = preg_replace('/^0/', '62', $data_atasan[0]);
        $status_atasan = $data_atasan[1];
        $nama_atasan =$data_atasan[2];
        $report_code = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('per_tabular_template.docx');
        $phpWord->setValues([
            'name'=>$nama_atasan,
            'name_side'=>$nama_atasan,
            'qmli_score'=>'90',
            'manage_score'=>'85',
            'leader_score'=>'75',
            'survey_date'=>'2022-11-25',
            'report_code'=>$report_code,
            'curr_date'=>$curr_date,
            'result_qmli_team'=>'Good',
            'result_manage_team'=>'Fair',
            'result_leader_team'=>'Fair',
            'result_qmli_self'=>'Good',
            'result_manage_self'=>'Good',
            'result_leader_self'=>'Good',
        ]);
        $pathToSave = 'PER_TABULAR_'.strtoupper($nama_atasan).'.docx';
        $pathToSavePdf = 'PER_TABULAR_'.strtoupper($nama_atasan).'.pdf';
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        try {
            $phpWord->saveAs(storage_path($pathToSave));
            // $pdfConvert = IOFactory::load($pathToSave);
            // $pdfConvert->save($pathToSavePdf,'PDF');    
        } catch (Exception $e) {
        }
        // return response()->download($pathToSavePdf);
        return response()->download(storage_path($pathToSave));

    }

    // public function home()
    // {
    //     return view('reports.home');
    // }

    // public function index()
    // {
    //     $phpWord = new \PhpOffice\PhpWord\TemplateProcessor('per_tabular12345.docx');
    //     $phpWord->setValues([
    //         'name'=>'arbikh'
    //     ]);
    //     $pathToSave = 'result_per1.docx';
    //     try {
    //         $phpWord->saveAs(storage_path($pathToSave));
    //     } catch (Exception $e) {
    //     }
    //     return response()->download(storage_path($pathToSave));

    // }
}
