<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //使用该user信息完成登录和注册等功能
    //显示登录表单,在登录表单上有注册功能
    public function create()
    {
        return view('Admin.login');
    }
}
