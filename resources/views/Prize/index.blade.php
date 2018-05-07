@extends('Default.default')
@section('title','活动列表页')
    @section('content')
        <h1>{{$event->title}}</h1>
        <table class="table" id="mytable">
            <tr>
                <th>奖品名称</th>
                <th>奖品描述</th>
                <th>操作</th>
            </tr>
            @foreach($prizes  as $prize)
            <tr data-id="{{$prize->id}}">
                <td>{{$prize->name}}</td>
                <td>{{$prize->description}}</td>
                <td>
                    <a href="{{route('prize.edit',$prize)}}" class="btn btn-primary">修改</a>
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
            @endforeach
            <tr  >
                <td colspan="7" style="text-align: center" ><a href="{{route('prize.create',$event->id)}}" class="btn btn-primary">添加奖品</a></td>
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
                    url:'/prize/'+id,
                    data:"_token={{csrf_token()}}",
                    success:function (response) {
                            if(response.result=='success'){
                                $(tr).fadeOut();
                            }
                            else {
                                alert(response.message)
                            }
                    }
                })
            })
        })
    </script>
    @stop
