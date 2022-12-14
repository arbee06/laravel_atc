<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use App\Models\CPanelBot;
use Log;
use DB;


class ChatBotController extends Controller
{
    public function remindAll()
    {
        $CPanelBot = CPanelBot::all();
        // $remind_chat = "Halo %s (%s), Anda telah terdaftar dalam program PEGADAIAN Assesment Culture Transformation BATCH 1.\nMohon untuk segera menyelesaikan survey di bawah ini sebelum tanggal *2022-12-28*.\n%s";
        $template = DB::table('chat_wa_template')->get();;
        $remind_chat = $template[0]->content;
        $template_diganti = ["[nama]", "[npk]", "[survey_link]"];
        foreach ($CPanelBot as $field) {
            $nama = $field->nama;
            $hp = $field->no_hp;
            $hp = preg_replace('/^0/', '62', $hp);
            $survey_link = $field->survey_link;
            $npk = $field->npk;
            $assets = [$nama,$npk,$survey_link];
            if($field->status == 's' || $field->status == 'S' ){
                $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                    "chatId"=> $hp."@c.us",
                    "text"=> str_replace('\n', "\n", str_replace($template_diganti, $assets, $remind_chat)),
                    "session"=> "default"
                ]);
            }
        }
        return redirect()->back();
    }

    public function prologueAll()
    {
        $CPanelBot = CPanelBot::all();
        // $prologue_chat = 
        // "Kepada Yth.\nBapak/Ibu %s\nProgram Gerakan Pinca Gaspol Winning Team\nPT Pegadaian\n\nPerihal : Survei untuk Program Gerakan Pinca Gaspol Winning Team
        // \nDengan hormat,\n\nDengan ini kami informasikan bahwa kami telah mengirimkan Survei kepada Bapak/Ibu melalui email. Mohon kiranya Bapak/Ibu dapat meluangkan waktu hanya 5 menit untuk segera melengkapi survei tersebut.
        // \nDibawah ini adalah Link Survei Bapak/Ibu:\n\n%s\nHasil pengisian survei diharapkan sudah kami terima selambat-lambatnya pada hari Jumat, 23 Desember 2022 pukul 17.00 WIB.\n\nKerjasama Bapak/Ibu akan sangat membantu kesuksesan dari Gerakan Gaspol Pegadaian.
        // \nTerima kasih atas perhatian serta kerjasama Bapak/Ibu.\n\n\nHormat kami,\n\nEvent Production Team\nAndrewTani & Co.";
        $template = DB::table('chat_wa_template')->get();;
        $prologue_chat = $template[1]->content;
        $template_diganti = ["[nama]", "[npk]", "[survey_link]"];
        foreach ($CPanelBot as $field) {
            $nama = $field->nama;
            $hp = $field->no_hp;
            $hp = preg_replace('/^0/', '62', $hp);
            $survey_link = $field->survey_link;
            $npk = $field->npk;
            $assets = [$nama,$npk,$survey_link];
            if($field->status == 's' || $field->status == 'S'){
                $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                    "chatId"=> $hp."@c.us",
                    "text"=> str_replace('\n', "\n", str_replace($template_diganti, $assets, $prologue_chat)),
                    "session"=> "default"
                ]);
            }
        }
        return redirect()->back();
    }

    public function sendChat(Request $request)
    {
        $data_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data')){
                $hp_key = $key;
            }
        }
        $data_value = $request->input($hp_key);
        $data = explode(';',$data_value);
        $hp = preg_replace('/^0/', '62', $data[0]);
        $status = $data[1];
        $nama =$data[2];
        $survey_link = $data[3];
        $npk = $data[4];
        // $remind_chat = "Halo %s (%s), Anda telah terdaftar dalam program PEGADAIAN Assesment Culture Transformation BATCH 1.\nMohon untuk segera menyelesaikan survey di bawah ini sebelum tanggal *2022-12-28*.\n%s";
        $template = DB::table('chat_wa_template')->get();;
        $remind_chat = $template[0]->content;
        $template_diganti = ["[nama]", "[npk]", "[survey_link]"];
        $assets = [$nama,$npk,$survey_link];
        if($status == 's'){
            $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                "chatId"=> $hp."@c.us",
                "text"=> str_replace('\n', "\n", str_replace($template_diganti, $assets, $remind_chat)),
                "session"=> "default"
            ]);
        }
        return redirect()->back();

    }

    public function prologueChat(Request $request)
    {
        $data_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data')){
                $hp_key = $key;
            }
        }
        $data_value = $request->input($hp_key);
        $data = explode(';',$data_value);
        $hp = preg_replace('/^0/', '62', $data[0]);
        $status = $data[1];
        $nama =$data[2];
        $survey_link = $data[3];
        $npk = $data[4];
        // $prologue_chat = 
        // "Kepada Yth.\nBapak/Ibu %s\nProgram Gerakan Pinca Gaspol Winning Team\nPT Pegadaian\n\nPerihal : Survei untuk Program Gerakan Pinca Gaspol Winning Team
        // \nDengan hormat,\n\nDengan ini kami informasikan bahwa kami telah mengirimkan Survei kepada Bapak/Ibu melalui email. Mohon kiranya Bapak/Ibu dapat meluangkan waktu hanya 5 menit untuk segera melengkapi survei tersebut.
        // \nDibawah ini adalah Link Survei Bapak/Ibu:\n\n%s\nHasil pengisian survei diharapkan sudah kami terima selambat-lambatnya pada hari Jumat, 23 Desember 2022 pukul 17.00 WIB.\n\nKerjasama Bapak/Ibu akan sangat membantu kesuksesan dari Gerakan Gaspol Pegadaian.
        // \nTerima kasih atas perhatian serta kerjasama Bapak/Ibu.\n\n\nHormat kami,\n\nEvent Production Team\nAndrewTani & Co.";
        $template = DB::table('chat_wa_template')->get();;
        $prologue_chat = $template[1]->content;
        $template_diganti = ["[nama]", "[npk]", "[survey_link]"];
        $assets = [$nama,$npk,$survey_link];
        if($status == 's'){
            $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                "chatId"=> $hp."@c.us",
                "text"=> str_replace('\n', "\n", str_replace($template_diganti, $assets, $prologue_chat)),
                "session"=> "default"
            ]);
        }
        return redirect()->back();

    }

    // public function sendImage(Request $request)
    // {
    //     $data = $request->all();
    //     $data_atasan_key ="";
    //     $data_bawahan_key ="";
    //     foreach ($request->except('_token') as $key => $value) {
    //         if(str_contains($key,'data')){
    //             $hp_key = $key;
    //         }
    //         elseif(str_contains($key,'data_bawahan')){
    //             $hp_bawahan_key = $key;
    //         }
    //     }
    //     $data_value = $request->input($hp_key);
    //     $data_bawahan_value = $request->input($hp_bawahan_key);
    //     $data = explode(':',$data_value);
    //     $data_bawahan = explode(':',$data_bawahan_value);
    //     $hp = preg_replace('/^0/', '62', $data[0]);
    //     $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
    //     $status = $data[1];
    //     $status_bawahan = $data_bawahan[1];
    //     $resp = Http::post('http://188.166.214.90:3005/api/sendImage',[
    //         "chatId"=> $hp."@c.us",
    //         "file"=> array(
    //             "mimetype"=> "image/jpeg",
    //             "filename"=> "output.jpeg",
    //             "url"=> "https://verloop.io/wp-content/uploads/WhatsApp-Interactive-Messages-List-Messages-and-Reply-Buttons-12-scaled-1.jpg"
    //         ),
    //         "caption"=> "caption",
    //         "session"=> "default"
    //     ]);
    //     return redirect()->back();

    // }

    // public function sendFile(Request $request)
    // {
    //     $data = $request->all();
    //     $data_atasan_key ="";
    //     $data_bawahan_key ="";
    //     foreach ($request->except('_token') as $key => $value) {
    //         if(str_contains($key,'data')){
    //             $hp_key = $key;
    //         }
    //         elseif(str_contains($key,'data_bawahan')){
    //             $hp_bawahan_key = $key;
    //         }
    //     }
    //     $data_value = $request->input($hp_key);
    //     $data_bawahan_value = $request->input($hp_bawahan_key);
    //     $data = explode(':',$data_value);
    //     $data_bawahan = explode(':',$data_bawahan_value);
    //     $hp = preg_replace('/^0/', '62', $data[0]);
    //     $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
    //     $status = $data[1];
    //     $status_bawahan = $data_bawahan[1];
    //     $resp = Http::post('http://188.166.214.90:3005/api/sendFile',[
    //         "chatId"=> $hp."@c.us",
    //         "file"=> array (
    //             "mimetype"=> "application/octet-stream",
    //             "filename"=> "file",
    //             "url" => "https://file-examples.com/wp-content/uploads/2017/04/file_example_MP4_480_1_5MG.mp4"
    //         ),
    //         "session"=> "default"
    //     ]);
    //     return redirect()->back();
    // }

    // public function sendVoice(Request $request)
    // {
    //     $data = $request->all();
    //     $data_atasan_key ="";
    //     $data_bawahan_key ="";
    //     foreach ($request->except('_token') as $key => $value) {
    //         if(str_contains($key,'data')){
    //             $hp_key = $key;
    //         }
    //         elseif(str_contains($key,'data_bawahan')){
    //             $hp_bawahan_key = $key;
    //         }
    //     }
    //     $data_value = $request->input($hp_key);
    //     $data_bawahan_value = $request->input($hp_bawahan_key);
    //     $data = explode(':',$data_value);
    //     $data_bawahan = explode(':',$data_bawahan_value);
    //     $hp = preg_replace('/^0/', '62', $data[0]);
    //     $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
    //     $status = $data[1];
    //     $status_bawahan = $data_bawahan[1];
    //     $resp = Http::post('http://188.166.214.90:3005/api/sendVoice',[
    //         "chatId"=> $hp."@c.us",
    //         "file"=> array (
    //         "mimetype"=> "audio/ogg; codecs=opus",
    //         "filename"=> "output.mp3",
    //         "url"=>"https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
    //         ),
    //         "session"=> "default"
    //     ]);
    //     return redirect()->back();

    // }
}
