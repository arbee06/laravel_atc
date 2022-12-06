<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use App\Models\CPanelBot;
use Log;

class ChatBotController extends Controller
{
    public function sendAll()
    {
        $CPanelBot = CPanelBot::all();
        foreach ($CPanelBot as $field) {
            $nama = $field->nama;
            $hp = $field->no_hp;
            $hp = preg_replace('/^0/', '62', $hp);
            $survey_link = $field->survey_link;
            $npk = $field->npk;
            if($field->status == 's'){
                $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                    "chatId"=> $hp."@c.us",
                    "text"=> sprintf("Halo %s (%s), Anda telah terdaftar dalam program PEGADAIAN Assesment Culture Transformation BATCH 1.\nMohon untuk segera menyelesaikan survey di bawah ini sebelum tanggal *2022-12-28*.\n%s"
            ,$nama,$npk,$survey_link),
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
        if($status == 's'){
            $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                "chatId"=> $hp."@c.us",
                // "text"=> $nama.", Please do your survey in link below\n".$survey_link,
                "text"=> sprintf("Halo %s (%s), Anda telah terdaftar dalam program PEGADAIAN Assesment Culture Transformation BATCH 1.\nMohon untuk segera menyelesaikan survey di bawah ini sebelum tanggal *2022-12-28*.\n%s"
            ,$nama,$npk,$survey_link),
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
