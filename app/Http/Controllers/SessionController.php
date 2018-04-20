<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    //用以登录的控制器
    public function login()
    {
        //显示一个登录表单
        return view('Session.login');
    }
        //登录检测等
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required|min:2',
            'password'=>'required|min:3',
        ],[
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名至少2位',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最少要3位'
        ]);
        //认证用户
        $result = Auth::attempt(['name'=>$request->name,'password'=>$request->password],$request->has('remember'));
        if($result==true){
            session()->flash('success','登录成功');
            return redirect()->route('categorys.index');
        }
        else{
            session()->flash('danger','登录失败');
           return redirect()->back()->withInput();
        }

    }
    //退出登录
    public function logout()
    {
        Auth::logout();
        session()->flash('success','您已成功注销');
        return redirect('/login');
    }
}
