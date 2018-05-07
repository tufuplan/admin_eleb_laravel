<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class Admin extends Authenticatable
{
    use LaratrustUserTrait;
    //
    protected $fillable = [
        'name','photo','password'
    ];
}
