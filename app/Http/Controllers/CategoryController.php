<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    //
    public function index()
    {
        //分类列表的显示
        $Categorys = Category::all();
        return view('Category.index',compact('Categorys'));
    }
    //完成商家分类的添加
    public function create()
    {
      return view('Category.add');
    }
    //完成商家分类的添加数据保存
    public function store(Request $request)
    {
        //数据验证
        $this->validate($request,[
            'name'=>[
                'required',
                'min:2',
                Rule::unique('categories'),
            ],
            'cover'=>'required|image',

        ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'分类名字不能为空',
            'name.min'=>'分类名字最少两个字符',
            'cover.required'=>'封面图不能为空',
            'cover.image'=>'封面图必须是一张图片',
        ]);
        //数据验证完成
        //接收图片上传
        $fileName = $request->file('cover')->store('public/cover');
        $fileName2 = url(Storage::url($fileName));
        //保存数据
        Category::create([
            'name'=>$request->name,
            'cover'=>$fileName2
        ]);
        //成功提示
        session()->flash('success','添加分类成功,进入分类列表页');
        return  redirect()->route('categorys.index');
    }
    //完成修改分类
    public function edit(Category $category)
    {
        return view('Category.edit',compact('category'));
    }
    //完成修改分类保存
    public function update(Category $category,Request $request)
    {
        //数据验证
        //数据验证
        $this->validate($request,[
            'name'=>[
                'required',
                'min:2',
                Rule::unique('categories')->ignore($category->id),
            ],
            'cover'=>'image',

        ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'分类名字不能为空',
            'name.min'=>'分类名字最少两个字符',
            'cover.image'=>'封面图必须是一张图片',
        ]);
        if($request->cover){
                $fileName = $request->file('cover')->store('public/cover');
                $filepath = url(Storage::url($fileName));
                $category->update([
                    'name'=>$request->name,
                    'cover'=>$filepath
                ]);

        }
        else{
            $category->update([
                'name'=>$request->name
            ]);
        }
        session()->flash('success','修改信息成功');
        return redirect()->route('categorys.index');

    }
    //完成分类的修改
    public function destroy(Category $category)
    {
        $category->delete();
    }
}
