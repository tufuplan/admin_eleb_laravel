<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
        'title', 'content', 'signup_start','signup_end','prize_date','signup_num','is_prize'
    ];
}
