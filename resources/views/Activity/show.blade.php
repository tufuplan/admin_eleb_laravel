@extends('Default.default')

@section('title','活动详情')
    @section('content')
           <div class="form-control" style="text-align: center">{{$activity->name}}</div>
           <div class="form-control" style="text-align: center"><span>活动开始时间:{{date('Y-m-d',$activity->start_time)}}</span> </div>
           <div class="form-control" style="text-align: center"><span>活动结束时间:{{date('Y-m-d',$activity->end_time)}}</span></div>
           <div id="content" style="text-align: center">{!!$activity->content!!}</div>
           <div style="text-align: center" >
           <a href="{{route('activity.edit',$activity)}}" class="btn btn-danger">更改进行状态</a>
           </div>
@stop