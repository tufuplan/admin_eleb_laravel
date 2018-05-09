<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    //
    public function index()
    {
            $role_list = Role::all();
        return view('Role.index',compact('role_list'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('Role.add',compact('permissions'));
    }
    //完成角色的储存
    public function store(Request $request)
    {
            $this->validate($request,[
                'name'=>'required|unique:roles',
                'display_name'=>'required',
                'detail'=>'required'
            ],[
                'name.required'=>'名字不能为空',
                'name.unique'=>'名字是唯一的',
                'display_name.required'=>'人类可读名称不能为空',
                'detail.required'=>'描述不能为空'
            ]);
         if($request->permission==null){
             session()->flash('danger','请至少选择一个权限');
             return redirect()->back()->withInput();
         }
//            数据验证完成存入数据库
        $role = new Role();
        $role->name = $request->name;
        $role->display_name =$request->display_name; // optional
        $role->description  = $request->detail; // optional
        $role->save();
//            成功提示
//            给角色添加权限
        foreach ($request->permission as $value){
            $role->attachPermission($value);
        }
        session()->flash('success','添加角色成功');
        return  redirect()->route('role.index');
    }
    //完成角色的修改
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('Role.edit',compact(['role','permissions']));
    }
    //完成修改的保存
    public function update(Request $request,Role $role)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('roles')->ignore($role->id)
            ],
            'display_name'=>'required',
            'detail'=>'required'
        ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'名字已存在',
            'display_name.required'=>'人类可读名称不能为空',
            'detail.required'=>'描述不能为空'
        ]);
        if($request->permission==null){
            session()->flash('danger','请至少选择一个权限');
            return redirect()->back()->withInput();
        }
        //验证成功开始给角色修改权限
        //角色修改
        $role->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'descriptin'=>$request->detail
        ]);
        //权限修改
            $role->syncPermissions($request->permission);

        //成功提示
        session()->flash('success','修改角色成功');
        return redirect()->route('role.show',$role);

    }
    //完成单个角色的显示
    public function show(Role $role)
    {
       $permissions = $role->permissions;

        return view('Role.show',compact(['permissions','role']));
    }
}
