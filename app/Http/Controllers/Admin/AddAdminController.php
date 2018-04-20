<?php

namespace App\Http\Controllers\Admin;


use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class AddAdminController extends Controller
{
    //
    public function index()
    {
     //显示管理员列表
        $Admins = User::paginate(3);
        return view('Admin.index',compact('Admins'));
    }

    public function create()
    {
       //完成管理员注册
        //显示注册表单
        return view('Admin.add') ;
    }
    //完成管理员的添加保存
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('users'),
            ],
            'cover'=>'required|image',
            'password'=>'required|min:6|confirmed'
        ],[
            'name.required'=>'管理员姓名不能为空',
            'name.unique'=>'管理员姓名不能重复',
            'cover.required'=>'管理员头像不能为空',
            'cover.image'=>'管理员的头像必须是一张图片',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最小要六个字符',
            'password.confirmed'=>'确认密码有误'
        ]);
        //数据验证完后保存添加
        $fileName = $request->file('cover')->store('public/cover');
        User::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'logo'=>$fileName
        ]);
        //添加成功提示
        session()->flash('success','添加管理员成功');
        //成功跳转到登录
        return redirect()->route('admins.create');



    }
    //
    public function edit(User $Admin,Request $request)
    {
        //修改管理员信息
        return view('Admin.edit',compact('Admin'));
    }

}
