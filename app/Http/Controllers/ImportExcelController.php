<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Models\CPanelBot;


class ImportExcelController extends Controller
{
    function index(){
        $data = DB::table('c_panel_bots')->get();
        $template = DB::table('chat_wa_template')->get();;
        return view('import_bot.index',compact(['data'],'template'));
    }

    public function import(Request $request)
    {
        CPanelBot::truncate();
        $data = $request->file('select_file');
        $namafile = $data->getClientOriginalName();
        $data->move('UploadsImport',$namafile);
        config(['excel.import.startRow' => 2]);
        $rows = Excel::import(new ExcelImport, \public_path('/UploadsImport/'.$namafile));
        return redirect()->back();
    }
}
