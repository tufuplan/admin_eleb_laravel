<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    //完成管理员的登录
    public function create()
    {
        return view('Admin/login');
    }
    //完成管理员的登录验证
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha',

        ],[
            'name.required'=>'名字不能为空',
            'password'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码输入错误'
        ]);
        //数据验证完成
        if (Auth::attempt([ 'name'=>$request->name, 'password' => $request->password],$request->has('remember'))){
            // 该用户存在于数据库，且用户名和密码相符合
            //登录成功,跳转到管理首页
            //提示成功
            session()->flash('success','登录成功,进入管理页面');
            return redirect()->route('categorys.index');
        }
        else{
            session()->flash('danger','没有这个用户');
            //登录失败进入登录页面
            return redirect()->back()->withInput();
        }
    }
}
