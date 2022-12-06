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
            $nama_atasan = $field->nama_atasan;
            $nama_bawahan = $field->nama_bawahan;
            $hp1 = $field->no_hp_atasan;
            $hp2 = $field->no_hp_bawahan;
            $hp_atasan = preg_replace('/^0/', '62', $hp1);
            $hp_bawahan = preg_replace('/^0/', '62', $hp2);
            $survey_link = $field->survey_link;
            if($field->status_atasan == 'c'){
                if($field->status_bawahan == 's'){
                    $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                        "chatId"=> $hp_bawahan."@c.us",
                        "text"=> $nama_bawahan.", Please do your survey in link below\n".$survey_link,
                        "session"=> "default"
                    ]);
                }
            }
            elseif($field->status_atasan == 's'){
                $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                    "chatId"=> $hp_atasan."@c.us",
                    "text"=> $nama_atasan.", Please do your survey in link below\n".$survey_link,
                    "session"=> "default"
                ]);
                if($field->status_bawahan == 's'){
                    $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                        "chatId"=> $hp_bawahan."@c.us",
                        "text"=> $nama_bawahan.", Please do your survey in link below\n".$survey_link,
                        "session"=> "default"
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    public function sendChat(Request $request)
    {
        $data = $request->all();
        $data_atasan_key ="";
        $data_bawahan_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data_atasan')){
                $hp_atasan_key = $key;
            }
            elseif(str_contains($key,'data_bawahan')){
                $hp_bawahan_key = $key;
            }
        }
        $data_atasan_value = $request->input($hp_atasan_key);
        $data_bawahan_value = $request->input($hp_bawahan_key);
        $data_atasan = explode(';',$data_atasan_value);
        $data_bawahan = explode(';',$data_bawahan_value);
        $hp_atasan = preg_replace('/^0/', '62', $data_atasan[0]);
        $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
        $status_atasan = $data_atasan[1];
        $status_bawahan = $data_bawahan[1];
        $nama_atasan =$data_atasan[2];
        $nama_bawahan =$data_bawahan[2];
        $survey_link = $data_atasan[3];
        if($status_atasan == 'c'){
            if($status_bawahan == 's'){
                $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                    "chatId"=> $hp_bawahan."@c.us",
                    "text"=> $nama_bawahan.", Please do your survey in link below\n".$survey_link,
                    "session"=> "default"
                ]);
            }
        }
        elseif($status_atasan == 's'){
            $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                "chatId"=> $hp_atasan."@c.us",
                "text"=> $nama_atasan.", Please do your survey in link below\n".$survey_link,
                "session"=> "default"
            ]);
            if($status_bawahan == 's'){
                $resp = Http::post('http://188.166.214.90:3005/api/sendText',[
                    "chatId"=> $hp_bawahan."@c.us",
                    "text"=> $nama_bawahan.", Please do your survey in link below\n".$survey_link,
                    "session"=> "default"
                ]);
            }
        }
        return redirect()->back();

    }

    public function sendImage(Request $request)
    {
        $data = $request->all();
        $data_atasan_key ="";
        $data_bawahan_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data_atasan')){
                $hp_atasan_key = $key;
            }
            elseif(str_contains($key,'data_bawahan')){
                $hp_bawahan_key = $key;
            }
        }
        $data_atasan_value = $request->input($hp_atasan_key);
        $data_bawahan_value = $request->input($hp_bawahan_key);
        $data_atasan = explode(':',$data_atasan_value);
        $data_bawahan = explode(':',$data_bawahan_value);
        $hp_atasan = preg_replace('/^0/', '62', $data_atasan[0]);
        $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
        $status_atasan = $data_atasan[1];
        $status_bawahan = $data_bawahan[1];
        $resp = Http::post('http://188.166.214.90:3005/api/sendImage',[
            "chatId"=> $hp_atasan."@c.us",
            "file"=> array(
                "mimetype"=> "image/jpeg",
                "filename"=> "output.jpeg",
                "url"=> "https://verloop.io/wp-content/uploads/WhatsApp-Interactive-Messages-List-Messages-and-Reply-Buttons-12-scaled-1.jpg"
            ),
            "caption"=> "caption",
            "session"=> "default"
        ]);
        return redirect()->back();

    }

    public function sendFile(Request $request)
    {
        $data = $request->all();
        $data_atasan_key ="";
        $data_bawahan_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data_atasan')){
                $hp_atasan_key = $key;
            }
            elseif(str_contains($key,'data_bawahan')){
                $hp_bawahan_key = $key;
            }
        }
        $data_atasan_value = $request->input($hp_atasan_key);
        $data_bawahan_value = $request->input($hp_bawahan_key);
        $data_atasan = explode(':',$data_atasan_value);
        $data_bawahan = explode(':',$data_bawahan_value);
        $hp_atasan = preg_replace('/^0/', '62', $data_atasan[0]);
        $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
        $status_atasan = $data_atasan[1];
        $status_bawahan = $data_bawahan[1];
        $resp = Http::post('http://188.166.214.90:3005/api/sendFile',[
            "chatId"=> $hp_atasan."@c.us",
            "file"=> array (
                "mimetype"=> "application/octet-stream",
                "filename"=> "file",
                "url" => "https://file-examples.com/wp-content/uploads/2017/04/file_example_MP4_480_1_5MG.mp4"
            ),
            "session"=> "default"
        ]);
        return redirect()->back();
    }

    public function sendVoice(Request $request)
    {
        $data = $request->all();
        $data_atasan_key ="";
        $data_bawahan_key ="";
        foreach ($request->except('_token') as $key => $value) {
            if(str_contains($key,'data_atasan')){
                $hp_atasan_key = $key;
            }
            elseif(str_contains($key,'data_bawahan')){
                $hp_bawahan_key = $key;
            }
        }
        $data_atasan_value = $request->input($hp_atasan_key);
        $data_bawahan_value = $request->input($hp_bawahan_key);
        $data_atasan = explode(':',$data_atasan_value);
        $data_bawahan = explode(':',$data_bawahan_value);
        $hp_atasan = preg_replace('/^0/', '62', $data_atasan[0]);
        $hp_bawahan = preg_replace('/^0/', '62', $data_bawahan[0]);
        $status_atasan = $data_atasan[1];
        $status_bawahan = $data_bawahan[1];
        $resp = Http::post('http://188.166.214.90:3005/api/sendVoice',[
            "chatId"=> $hp_atasan."@c.us",
            "file"=> array (
            "mimetype"=> "audio/ogg; codecs=opus",
            "filename"=> "output.mp3",
            "url"=>"https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3"
            ),
            "session"=> "default"
        ]);
        return redirect()->back();

    }
}
