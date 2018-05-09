<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
{
    //创建添加活动表单
    public function create()
    {


        return view('Activity.add');
    }
    //接收编辑活动
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|min:2|unique:activities',
            'start_time'=>'required|date|after:today',
            'end_time'=>'required|date|after:tomorrow',
            'content1'=>'required',
        ],[
            'name.required'=>'活动名称不能为空',
            'name.min'=>'活动最少两个字符',
            'name.unique'=>'活动不能重名',
            'start-time.required'=>'活动开始时间不能为空',
            'start_time.date'=>'必须是一个日期',
            'start_time.after'=>'开始日期至少是明天',
            'end_time.required'=>'结束时间不能为空',
            'end_time.date'=>'结束时间是个日期',
            'end_time.after'=>'结束时间至少是后天',
            'content1'=>'活动内容不能为空'
        ]);
        //保存数据
//        strtotime($request->start_time);
        Activity::create([
            'name'=>$request->name,
            'start_time'=>strtotime($request->start_time),
            'end_time'=>strtotime($request->end_time),
            'content'=>$request->content1,
            'status'=>0,
        ]);
        //成功提示
        session()->flash('success','添加活动成功,进入活动列表');
        return redirect()->route('activity.index');
    }
    //显示活动列表页
    public function index()
    {
        $Activities = Activity::all();
        return view('Activity.index',compact('Activities'));
    }
    //显示活动详情
    public function show(Activity $activity)
    {
        return view('Activity.show',compact('activity'));
    }
    //修改活动的状态
    public function edit(Activity $activity)
  {
//   dump( url()->previous());
//    dump(strrchr(url()->previous(),'activity'));
//    exit;
        if(strrchr(url()->previous(),'activity')=='activity'){
            return view('Activity.edit',compact('activity'));
        }
        else{
            if($activity->end_time<strtotime(date('Y-m-d',time()))){
                //活动已过期
                session()->flash('danger','该活动已过期,请删除或者修改该活动');
                return  redirect()->back()->withInput();
            }
            $activity->update([
                'status'=>$activity->status==1?'0':'1'
            ]);
            session()->flash('success','成功修改状态');
            return redirect()->route('activity.index');
        }

    }
    //保存修改
    public function update(Request $request,Activity $activity)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('activities')->ignore($activity->id),
                'min:2'
                ],
            'start_time'=>'required|date|nullable|after:today',
            'end_time'=>'required|date|nullable|after:tomorrow',
            'content1'=>'required',
        ],[
            'name.required'=>'活动名称不能为空',
            'name.min'=>'活动最少两个字符',
            'name.unique'=>'活动不能重名',
            'start-time.required'=>'活动开始时间不能为空',
            'start_time.date'=>'必须是一个日期',
            'start_time.after'=>'开始日期至少是明天',
            'end_time.required'=>'结束时间不能为空',
            'end_time.date'=>'结束时间是个日期',
            'end_time.after'=>'结束时间至少是后天',
            'content1'=>'活动内容不能为空'
        ]);
        $activity->update([

            'name'=>$request->name,
            'start_time'=>strtotime($request->start_time),
            'end_time'=>strtotime($request->end_time),
            'content'=>$request->content1,
            'status'=>1,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('activity.index');
    }
    //删除一个活动
    public function destroy(Activity $activity)
    {
        if($activity->status==1){
            return ['result'=>'fail'];
        }
        else{
            $activity->delete();
            return ['result'=>'success'];
        }
    }
}
