@extends('Default/default')
@section('title','用户');
@section('content')
    <table class="table" id="btn">
        <tr>
            <th>头像</th>
            <th>用户名</th>
            <th>操作</th>
        </tr>
        @foreach($Admins as $Admin)
        <tr data-id="{{$Admin->id}}">

            <td>{{$Admin->cover}}</td>
            <td>{{$Admin->name}}</td>
            <td><a class="btn btn-primary" href="{{route('addadmins.edit',$Admin)}}">修改</a>
                <button class="btn btn-danger">删除</button>
            </td>
        </tr>
      @endforeach
        <tr>
            <td colspan="3" style="text-align: center"><a href="{{route('addadmins.create')}}">添加</a></td>
        </tr>
    </table>
    {{$Admins->links()}}
    @stop
@section('js')
    <script>
        $("#btn .btn-danger").click(function () {
            if(confirm('确认删除吗?删除后数据不可恢复')){
                //在这里删除数据
                var tr = this.closest('tr');
                var id  = $(tr).attr('data-id');
             $.ajax({
                 type:"DELETE",
                 url : 'users/'+id,
                 data:'_token={{csrf_token()}}',
                 success:function (msg) {
                    $(tr).fadeOut();
                 }
                 }
             )

            }
        })

    </script>
    @stop