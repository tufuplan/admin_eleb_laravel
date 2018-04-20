<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //
    public function index(){
        //显示管理员列表
        $Admins = Admin::all();
        return view('Admin.index',compact('Admins'));
    }

    public function create()
    {
        //完成管理员添加显示添加表单
        return view('Admin.add');
    }

    public function store(Request $request)
    {
        //管理员保存
        $this->validate($request,[
            'name'=>[
                'required',
                'min:2',
                Rule::unique('admins')
            ],
            'password'=>'required|min:3|confirmed',
            'photo'=>'required|image',
            'captcha'=>'required|captcha'
        ],[
            'name.required'=>'姓名不能不填',
            'name.min'=>'姓名最少两个字符',
            'name.unique'=>'姓名已存在的',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码最少三位字符',
            'password.confirmed'=>'确认密码有误',
            'photo.required'=>'照片不能为空',
            'photo.image'=>'照片必须是一张图片',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码有误'
        ]);
        //数据验证成功
        //图片上传
         $fileName = $request->file('photo')->store('public/photo');
         $filePath = url(Storage::url($fileName));
         //保存数据
        Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'photo'=>$filePath
        ]);
        //成功提醒
        session()->flash('success','添加管理员成功');
        return redirect()->route('admins.index');
    }
    //管理员修改信息
    public function edit(Admin $admin)
    {
        return view('Admin.edit',compact('admin'));
    }
    //管理员修改保存信息
    public function update(Request $request,Admin $admin)
    {

        $this->validate($request,[
            'name'=>[
                'required',
                'min:2',
                Rule::unique('admins')->ignore($admin->id),
                ],
            'oldpassword'=>'required|min:3',
            'password'=>'confirmed|min:3|nullable',
            'photo'=>'image|nullable',

        ],[
            'name.required'=>'名字不能为空',
            'name.miin'=>'名字最少两个字符',
            'name.unique'=>'姓名不能重复',
            'oldpasswrod.required'=>'旧密码不能为空',
            'oldpassword.min'=>'旧密码最少要三位',
            'password.confirmed'=>'新密码确认有误',
            'password.min'=>'密码最少要三位',
            'photo.image'=>'照片必须是一张图片'
        ]);

    }
}
