<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatWaTemplate extends Model
{
    use HasFactory;
    protected $table = 'chat_wa_template';
    protected $fillable = ['content'];
    public $timestamps = false;
}
