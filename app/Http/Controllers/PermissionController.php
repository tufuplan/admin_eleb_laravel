<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $Permissions = Permission::all();
        return view('Permission.index',compact('Permissions'));
    }
    public function create()
    {
        return view('Permission.add');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|alpha_dash|unique:roles',
            'display_name'=>'required',
            'detail'=>'min:3|required'
        ],[
            'name.required'=>'名字不能为空',
            'name.alpha_dash'=>'唯一名字中不要有中文',
            'name.unique'=>'名字是唯一的',
            'detail.min'=>'描述最少三位字符',
            'display_name.required'=>'人类刻度名称不能为空',
            'detail.required'=>'描述不能为空'
        ]);
        //数据验证完成存入数据库
        $role = new Permission();
        $role->name = $request->name;
        $role->display_name =$request->display_name; // optional
        $role->description  = $request->detail; // optional
        $role->save();
        //成功提示
        session()->flash('success','添加权限成功');
        return  redirect()->route('permission.index');

    }
    //对权限进行修改
    public function edit(Permission $permission)
    {
        return view('Permission.edit',compact('permission'));
    }
    //对权限修改保存
    public function update(Request $request,Permission $permission)
    {
        //数据验证
        $this->validate($request,[
            'name'=>'required',
            Rule::unique('permissions')->ignore($permission->id),
            'display_name'=>'required',
            'detail'=>'required'
        ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'名字是唯一的',
            'display_name.required'=>'人类可读名字不能为空',
            'detail.required'=>'描述不能为空'
        ]);
        //数据验证完成修改权限
        $permission->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
            'description'=>$request->detail
        ]);
        //修改完成
        session()->flash('success','修改权限成功');
        return redirect()->route('permission.index');
    }
    //删除某个权限
    public function destroy(Permission $permission)
    {
        $id = $permission->id;
        $result = DB::table('permission_role')
            ->where('permission_id',$id)->first();
        if($result!=null){
            session()->flash('danger','不能删除,该权限属于某个角色');
            return redirect()->back();
        }
        $permission->delete();
        return redirect()->route('permission.index');
    }
}
