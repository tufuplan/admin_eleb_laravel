<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //完成分类的增删改查
//    分类列表
    public function index()
    {
        $Categorys = Category::all();
        return view('Category/index',compact('Categorys'));
    }
    //完成管理员添加分类
    public function create(){
        return view('Category/add');
    }
    //完成分类的保存
    public function store(Request $request)
    {
        $this->validate($request,[
            //验证规则
            'name'=>'required|min:2',
            'cover'=>'required|image',
        ],[
            'name.required'=>'分类名称不能为空',
            'name.min'=>'分类最少两个字符',
            'cover.required'=>'封面不能为空',
            'cover.image'=>'封面必须是一张图片'
        ]);
        //验证成功保存
        //文件上传
        $fileName  =  $request->file('cover')->store('public/cover');
        Category::create([
            'name'=>$request->name,
            'cover'=>$fileName
        ]);
        //添加成功提示
        session()->flash('success','添加分类成功');
        //跳转到分类首页
        return redirect()->route('categorys.index');
    }
    //完成分类的修改
    public function edit(Category $category){

        return view('Category.edit',compact('category'));
    }
    //完成修改的保存
    public function update(Category $category,Request $request)
    {
        if($request->cover==null){
            //说明用户只修改分类的名称
            $this->validate($request,[
                //验证规则
                'name'=>'required|min:2',
            ],[
                'name.required'=>'分类名称不能为空',
                'name.min'=>'分类最少两个字符',
            ]);
            //保存更新
            $category->update([
                'name'=>$request->name
            ]);
            //成功提示跳转
            session()->flash('success','修改分类名称成功');
            //跳转到分类首页
            return redirect()->route('categorys.index');
        }
        else{
            //修改名字和封面图片
            $this->validate($request,[
                //验证规则
                'name'=>'required|min:2',
                'cover'=>'required|image',
            ],[
                'name.required'=>'分类名称不能为空',
                'name.min'=>'分类最少两个字符',
                'cover.required'=>'封面不能为空',
                'cover.image'=>'封面必须是一张图片'
            ]);
            $fileName  =  $request->file('cover')->store('public/cover');
            $category->update([
                'name'=>$request->name,
                'cover'=>$fileName
            ]);
            //成功提示跳转
            session()->flash('success','修改分类图片或名称成功');
            //跳转到分类首页
            return redirect()->route('categorys.index');

        }


    }
    //删除分类
    public function destroy()
    {
        //若分类下有商家是不能删除的
    }

}
