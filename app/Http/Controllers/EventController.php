<?php

namespace App\Http\Controllers;

use App\Event;
use App\Member;
use App\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    //添加抽奖活动
    public function create()
    {
        return view('Event.add');
    }
    //保存抽奖活动
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'signup_start'=>'required|date|after:today',
            'signup_end'=>'required|date|after:signup_start',
            'prize_date'=>'required|date|after:signup_start',
            'signup_num'=>'integer|required',
            'detail'=>'required'
        ],[
            'title.required'=>'标题不能为空',
            'signup_start.required'=>'开始时间不能为空',
            'signup_start.date'=>'开始时间是个时间',
            'signup_start.after'=>'开始时间不得小于今天',
            'signup_end.after'=>'结束时间不得小于开始时间',
            'signup_end.required'=>'结束时间不得为空',
            'signup_end.date'=>'结束时间是个时间',
            'prize_date.date.required'=>'活动开奖日期不得为空',
            'prize_date.date.date'=>'活动开奖日期是个时间',
            'prize_date.date.after'=>'活动开奖日期必选在开始时间之后',
            'signup_num.integer'=>'活动参与人数是个整数',
            'signup_num.required'=>'活动参与人数不能为空',
            'detail.required'=>'活动内容不能为空'
        ]);
        //数据验证完成添加到数据库中
        Event::create([
            'title'=>$request->title,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'content'=>$request->detail,
            'is_prize'=>0
        ]);
        //保存成功成功提示
        session()->flash('success','添加抽奖活动成功,请在抽奖活动列表中查看');
        return redirect()->route('event.index');
    }
    //抽奖活动列表页面
    public function index()
    {
        //查出 所有活动显示在列表中让管理员点击查看查看完后开展
        $events = Event::all();
        return view('Event.index',compact('events'));
    }
    //查看活动详情
    public function show(Event $event)
    {
        return view('Event.show',compact('event'));
    }
    //修改活动
    public function edit(Event $event)
    {
        return view('Event.edit',compact('event'));
    }
    //保存修改
    public function update(Request $request,Event $event)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'signup_start'=>'required|date|after:today',
            'signup_end'=>'required|date|after:signup_start',
            'prize_date'=>'required|date|after:signup_start',
            'signup_num'=>'integer|required',
            'detail'=>'required'
        ],[
            'title.required'=>'标题不能为空',
            'signup_start.required'=>'开始时间不能为空',
            'signup_start.date'=>'开始时间是个时间',
            'signup_start.after'=>'开始时间不得小于今天',
            'signup_end.after'=>'结束时间不得小于开始时间',
            'signup_end.required'=>'结束时间不得为空',
            'signup_end.date'=>'结束时间是个时间',
            'prize_date.date.required'=>'活动开奖日期不得为空',
            'prize_date.date.date'=>'活动开奖日期是个时间',
            'prize_date.date.after'=>'活动开奖日期必选在开始时间之后',
            'signup_num.integer'=>'活动参与人数是个整数',
            'signup_num.required'=>'活动参与人数不能为空',
            'detail.required'=>'活动内容不能为空'
        ]);
        $event->update([
            'title'=>$request->title,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'content'=>$request->detail,
        ]);
        session()->flash('success','修改活动成功');
        return redirect()->route('event.show',$event);
    }
    //删除活动,如果活动已开展则不能删除
    public function destroy(Event $event)
    {
        if(time()>$event->signup_start){
            return ['result'=>'fail'];
        }
        else {
            $event->delete();
            return ['result' => 'success'];
        }
    }
    //活动进行开奖
    public function jiang(Request $request)
    {
        $event_id = $request->id;
        //判断该活动是否能开奖
        //1.有奖品  2.有人员  3.超过开始时间
//        $result = DB::table('prizes')->where('events_id',$event_id)
//            ->get();
        //判断活动下是否有奖品
        //已经开奖不再开奖
        $result = Prize::query()->where('events_id',$event_id)
        ->first();
        if($result==null){
            session()->flash('danger','该活动还没有奖品不能开奖');
            return redirect()->back();
        }
        //是否有人员
        $result = Member::query()->where('events_id',$event_id)->first();
        if($result==null){
            session()->flash('danger','该活动还没有人参加不能开奖');
            return redirect()->back();
        }
        //未超过开奖时间不能开奖
        $Event = Event::query()->where('id',$event_id)
            ->first();
      $now = strtotime(date("Y-m-d",time()));
      $prize_date = strtotime($Event->prize_date);
      if(!($now>$prize_date)){
          session()->flash('danger','还没有到开奖时间');
          return redirect()->back();
      }
      //已经开奖不在开奖
        if($Event->is_prize==1){
            session()->flash('danger','该抽奖活动已经开奖');
            return redirect()->back();
        }
      //可以开奖,获取参加的人
        $Members = Member::query()->where('events_id',$event_id)
            ->pluck('member_id')->shuffle();
      //获取奖品
        $Prizes = Prize::query()->where('events_id',$event_id)
            ->pluck('id')->shuffle();
        //随机取出奖品给人

        $result = [];
       foreach ($Prizes as $prize){
           $member = $Members->pop();
           if($member==null) break;
           $result[$prize] = $member;
       }
       //抽奖完成
        DB::transaction(function ()use($result,$event_id) {
            foreach ($result as $key=>$value){
                DB::table('prizes')->where('id',$key)
                    ->update(['member_id'=>$value]);
            }
            DB::table('events')->where('id',$event_id)
                ->update(['is_prize'=>1]);
        });
        return redirect()->route('event.index');




                                                                                                          }
    //查看抽奖结果
    public function result(Request $request)
    {
        //查看该活动是否已经抽奖
        $event_id = $request->id;
        $Event = Event::query()->where('id',$request->id)->first();
        if($Event->is_prize==0){
            session()->flash('danger','该活动尚未开奖');
            return redirect()->back();
        }
        //查出该活动的结果
        $Results = DB::table('prizes')->join('events','events.id','=','prizes.events_id')
            ->join('businesses','prizes.member_id','=','businesses.id')
            ->where('events.id',$event_id)
            ->select('prizes.name','businesses.account')
            ->get();
        return view('Event.result',compact('Results'));

    }

}
