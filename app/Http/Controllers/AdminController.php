<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //构造方法控制权限
    public function __construct()
    {
        $this->middleware('auth'
            );
        //让每一个admin都只能修改自己的信息

    }
            //显示管理员列表
    public function index(){
        //显示管理员列表
//        if(!Auth::user()->can('admins.index')){
//            return 403;
//        }
        $Admins = Admin::all();
        return view('Admin.index',compact('Admins'));
    }
            //完成管理员添加显示添加表单
    public function create()
    {
        //完成管理员添加显示添加表单
        $role_list = Role::all();
        return view('Admin.add',compact('role_list'));
    }
            //管理员保存
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
        if($request->role==null){
            session()->flash('danger','请至少选择一个角色');
            return redirect()->back()->withInput();
        }
        //数据验证成功
        //图片上传
         $fileName = $request->file('photo')->store('public/photo');
         $filePath = url(Storage::url($fileName));
         //保存数据
        $admin = Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'photo'=>$filePath
        ]);
        foreach ($request->role as $value){
            $admin->attachRole($value);
        }
        //成功提醒
        session()->flash('success','添加管理员成功');
        return redirect()->route('admins.index');
    }
            //管理员修改信息
    public function edit(Admin $admin)
    {
//        $this->authorize('edit',$admin);
        $role_list = Role::all();

        return view('Admin.edit',compact(['admin','role_list']));
    }
            //管理员修改保存信息
    public function update(Request $request,Admin $admin)
    {

        $this->validate($request,[
            'name'=>[
                'required',
                'min:2',
                Rule::unique('admins')->ignore($admin->id),
                'nullable'
                ],
            'oldpassword'=>'required|min:3',
            'password'=>'confirmed|min:3|nullable',
            'photo'=>'image|nullable',
            'captcha'=>'required|captcha'

        ],[
            'name.required'=>'名字不能为空',
            'name.miin'=>'名字最少两个字符',
            'name.unique'=>'姓名不能重复',
            'oldpasswrod.required'=>'旧密码不能为空',
            'oldpassword.min'=>'旧密码最少要三位',
            'password.confirmed'=>'新密码确认有误',
            'password.min'=>'密码最少要三位',
            'photo.image'=>'照片必须是一张图片',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码有误'
        ]);
        if($request->role==null){
            session()->flash('danger','请至少选择一个角色');
            return redirect()->back()->withInput() ;
        }
        $user = Auth::user();
        $srcpassword = $user->getAuthPassword();
        $result = Hash::check($request->oldpassword,$srcpassword);
        if(!$result){
            session()->flash('danger','原密码输入不正确');
            return redirect()->back()->withInput();
        }
        if($request->photo!=null){
            $filepath = $request->file('photo')->store('public/photo');
            $filaName = url(Storage::url($filepath));
            $admin->update([
                'photo'=>$filaName
            ]);
        }
        if($request->password!=null){
            $admin->update([
                'password'=>bcrypt($request->password),
            ]);
        }
        if($request->name!=null){
            $admin->update(
                [
                    'name'=>$request->name,
                    ''
                ]
            );
        }
        //修改用户角色
        $admin->syncRoles($request->role);
        session()->flash('success','修改个人资料成功');
        return redirect()->route('admins.index');
    }

}
