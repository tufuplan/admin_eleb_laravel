<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $fillable =[
        'name','content','status','start_time','end_time'
    ];
}
