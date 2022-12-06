<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPanelBot extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'npk',
        'nama',
        'email',
        'no_hp',
        'batch',
        'survey_link',
        'status',
        'category',

    ];
    public $timestamps = false;
}
