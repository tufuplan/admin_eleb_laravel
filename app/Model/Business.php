<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    //可以修改的字段
    protected $fillable = [
        'account', 'password', 'category_id','logo','status'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
