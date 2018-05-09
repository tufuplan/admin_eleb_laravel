<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    //
    public $timestamps = false;
    protected $fillable = [
        'events_id', 'name', 'description','member_id'
    ];
}
