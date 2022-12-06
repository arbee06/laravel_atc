<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;


class ImportExcelController extends Controller
{
    function index(){
        $data = DB::table('c_panel_bots')->get();
        return view('botwa.home',compact(['data']));
    }

    public function import(Request $request)
    {
        $data = $request->file('select_file');
        $namafile = $data->getClientOriginalName();
        $data->move('UploadsImport',$namafile);
        config(['excel.import.startRow' => 2]);
        $rows = Excel::import(new ExcelImport, \public_path('/UploadsImport/'.$namafile));
        return redirect()->back();
    }
}
