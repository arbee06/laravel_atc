<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatWaTemplate;

class ChatTemplateController extends Controller
{
    //
    public function updateRemind(Request $request)
    {
        $template = ChatWaTemplate::find(1);
        $template->update(['content'=> $request->input('remind_area', $template->content),]);
        return redirect()->back();
    }
    public function updatePrologue(Request $request)
    {
        $template = ChatWaTemplate::find(2);
        $template->update(['content'=> $request->input('prologue_area', $template->content),]);
        return redirect()->back();
    }
}
