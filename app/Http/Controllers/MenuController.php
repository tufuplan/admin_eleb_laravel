<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
       $menus =  Menu::all();
        return view('Menu.index',compact('menus'));
    }
    //菜单的添加

    public function create()
    {
        $menus = Menu::all()->where('parent_id','<=',1);
        return  view('Menu.add',compact('menus'));
    }
    //菜单添加的保存
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:menus',
            'menu'=>'required',
            'url'=>'required',
        ],[
            'name.unique'=>'菜单名字不能重复',
            'name.required'=>'菜单名称不能为空',
            'menu.required'=>'菜单名称不能为空',
            'url.required'=>'菜单路由地址不能为空'
        ]);
        //数据验证成功
        Menu::create([
            'name'=>$request->name,
            'parent_id'=>$request->menu,
            'url'=>$request->url
        ]);
        //菜单添加成功
        session()->flash('success','菜单添加成功');
        //跳转菜单列表页
        return redirect()->route('menu.index');

    }
}
