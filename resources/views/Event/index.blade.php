@extends('Default.default')
@section('title','活动列表页')
    @section('content')
        <table class="table" id="mytable">
            <tr>
                <th>活动标题</th>
                <th>活动状态</th>
                <th>活动开始时间</th>
                <th>活动结束时间</th>
                <th>活动开奖时间</th>
                <th>最多参加人数</th>
                <th>操作</th>
            </tr>
            @foreach($events as $event)
            <tr data-id="{{$event->id}}">
                <td><a href="{{route('event.show',$event)}}">{{$event->title}}</a></td>
                <td>{{$event->is_prize==1?'已开奖':'未开奖'}}</td>
                <td>{{date('Y-m-d',$event->signup_start)}}</td>
                <td>{{date('Y-m-d',$event->signup_end)}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>
                    <a href="/jiang?id={{$event->id}}" class="btn btn-primary">现在开奖</a>
                    <a href="{{route('prize.index',$event)}}" class="btn btn-default">查看该活动奖品列表</a>
                    <a href="/result?id={{$event->id}}" class="btn btn-link">查看抽奖结果</a>
                    <a href="{{route('event.edit',$event)}}" class="btn btn-primary">编辑</a>
                    <button class="btn btn-danger">删除该活动</button>
                </td>
            </tr>
                @endforeach
            <tr  >
                <td colspan="7" style="text-align: center" ><a href="{{route('event.create')}}" class="btn btn-primary">添加活动</a></td>
            </tr>
        </table>
        @stop
@section('js')
    <script>
        $(function () {
            $("#mytable .btn-danger").click(function () {
                var tr = this.closest('tr');
                var id = $(tr).attr('data-id');
                $.ajax({
                    type:'DELETE',
                    url:'/event/'+id,
                    data:"_token={{csrf_token()}}",
                    success:function (response) {
                            if(response.result=='success'){
                                $(tr).fadeOut();
                            }
                            else {
                                alert('活动正在进行中若要删除清先下线')
                            }
                    }
                })
            })
        })
    </script>
    @stop
