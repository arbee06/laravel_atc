<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;

class ChatBotLivewire extends Component
{
    public $chat = 'test';
    public function render()
    {
        $data = DB::table('c_panel_bots')->get();
        return view('livewire.chat-bot-livewire',compact(['data']));
    }
}
