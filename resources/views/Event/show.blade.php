@extends('Default.default')

@section('title','活动详情')
    @section('content')
           <div class="form-control" style="text-align: center">{{$event->title}}</div>
           <div class="form-control" style="text-align: center">{{$event->is_prize==1?'已经开奖':'未开奖'}}</div>
           <div class="form-control" style="text-align: center"><span>活动开始时间:{{date('Y-m-d',$event->signup_start)}}</span> </div>
           <div class="form-control" style="text-align: center"><span>活动结束时间:{{date('Y-m-d',$event->signup_end)}}</span></div>
           <div class="form-control" style="text-align: center"><span>活动开奖时间:{{$event->prize_date}}</span></div>
           <div class="form-control" style="text-align: center"><span>活动最多参与人数:{{$event->signup_num}}</span></div>
           <div id="content" style="text-align: center">{!!$event->content!!}</div>
           <div style="text-align: center" >
           </div>
@stop