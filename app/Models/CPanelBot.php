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
        'npk_atasan',
        'nama_atasan',
        'status_atasan',
        'no_hp_atasan',
        'npk_bawahan',
        'nama_bawahan',
        'status_bawahan',
        'no_hp_bawahan',
        'survey_link',
    ];
    public $timestamps = false;
}
