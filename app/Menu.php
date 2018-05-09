<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Menu extends Model
{
    //
    protected $fillable = [
        'name', 'url', 'parent_id',
    ];
    static public function nav()
    {
        $menus = self::where('parent_id',1)->get();
        foreach ($menus as $menu){
           echo  '
<ul class="nav navbar-nav">
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.$menu->name.'<span class="caret"></span></a>
                   <ul class="dropdown-menu">';
               $children = self::where('parent_id',$menu->id)->get();
               foreach ($children as $child){
                   $user = Auth::user();
//                  if($user->can($child->url)){
                       echo '
                        <li><a href="'.route($child->url).'">'.$child->name.'</a></li>';
               };
                   echo '
                    </ul>
                </li>';
   }
    }
}
