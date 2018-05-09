<?php

namespace App\Http\Controllers;

use App\Event;
use App\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrizeController extends Controller
{
    //当前活动的奖品列表
    public function index(Request $request)
    {
       $event_id = substr($request->getRequestUri(),-1,1);
       //根据活动的id找到当前的奖品
        $event = DB::table('events')->where('id',$event_id)->first();
        $prizes= Prize::query()->where('events_id',$event_id)->get();
        return view('Prize.index',compact(['event','prizes']));
    }
    //添加对应活动下的奖品
    public function create(Request $request)
    {
        $event_id = substr($request->getRequestUri(),-1,1);
      return view('Prize.add',compact('event_id'));
    }
    //保存对应活动下的奖品
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'detail'=>'required',
            'event_id'=>'required'

        ],[
            'name.required'=>'奖品名称不能为空',
            'detail.required'=>'奖品描述不能为空',
            'event_id.required'=>'活动id别乱动',
        ]);
        //判断是否能够添加奖品
        //没开奖的活动才能添加奖品,活动已经开始不能再添加奖品
        $result = DB::table('events')->where('is_prize',0)
            ->where('id',$request->event_id)
            ->first();
        if($result==null){
            session()->flash('danger','该活动已经开奖不要再添加奖品');
            return redirect()->route('event.index');
        }
        //判断该活动是否已经开始
        if(!$result->signup_start>time()){
            //活动已经开始
            session()->flash('danger','该活动已经开始不要再添加奖品');
            return redirect()->route('event.index');
        }
        //保存添加
        Prize::create([
            'name'=>$request->name,
            'description'=>$request->detail,
            'events_id'=>$request->event_id,
            'member_id'=>0
        ]);
        //成功提示
        session()->flash('success','添加奖品成功');
        return redirect()->route('event.index');
    }
    //修改某个活动下的奖品
    public function edit(Prize $prize)
    {
        return view('Prize.edit',compact('prize'));
    }
    //保存修改
    public function update(Request $request,Prize $prize)
    {
        $this->validate($request,[
            'name'=>'required',
            'detail'=>'required',

        ],[
            'name.required'=>'奖品名称不能为空',
            'detail.required'=>'奖品描述不能为空',
        ]);
        //判断是否能够修改奖品
        //没开奖的活动才能添加奖品,活动已经开始不能再添加奖品
        $result = DB::table('events')->where('is_prize',0)
            ->where('id',$prize->events_id)
            ->first();
        if($result==null){
            session()->flash('danger','该活动已经开奖不要再添加奖品');
            return redirect()->route('event.index');
        }
        //判断该活动是否已经开始
        if(!$result->signup_start>time()){
            //活动已经开始
            session()->flash('danger','该活动已经开始不要再添加奖品');
            return redirect()->route('event.index');
        }
        //修改
        $prize->update([
            'name'=>$request->name,
            'description'=>$request->detail
        ]);
        session()->flash('success','修改奖品成功');
        return redirect()->route('event.index');

    }
    //删除一个奖品
    public function destroy(Prize $prize)
    {
        //判断是否能够修改奖品
        //没开奖的活动才能添加奖品,活动已经开始不能再添加奖品
        $result = DB::table('events')->where('is_prize',0)
            ->where('id',$prize->events_id)
            ->first();
        if($result==null){
            return [
                'result'=>false,
                'message'=>'该活动已经开奖不要再删除奖品,直接删除活动'
            ];
        }
        //判断该活动是否已经开始
        if(!$result->signup_start>time()){
            //活动已经开始
            return [
                'result'=>false,
                'message'=>'该活动已经开始不要再删除奖品'
            ];
        }
        $prize->delete();
        return [
            'result'=>"success"
        ];
    }

}
