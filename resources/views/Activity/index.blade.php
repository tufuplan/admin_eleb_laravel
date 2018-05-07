@extends('Default.default')
@section('title','活动列表页')
    @section('content')
        <table class="table" id="mytable">
            <tr>
                <th>活动标题</th>
                <th>活动状态</th>
                <th>活动开始时间</th>
                <th>活动结束时间</th>
                <th>操作</th>
            </tr>
            @foreach($Activities as $activity)
            <tr data-id="{{$activity->id}}">
                <td><a href="{{route('activity.show',$activity)}}">{{$activity->name}}</a></td>
                <td>{{$activity->status==1?'火热进行中':'未进行'}}</td>
                <td>{{date('Y-m-d',$activity->start_time)}}</td>
                <td>{{date('Y-m-d',$activity->end_time)}}</td>
                <td>
                    <a href="{{route('activity.edit',$activity)}}" class="btn btn-primary">编辑</a>
                    <button class="btn btn-danger">删除该活动</button>
                </td>
            </tr>
                @endforeach
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
                    url:'/activity/'+id,
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
