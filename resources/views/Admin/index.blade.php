@extends('Default/default')
@section('title','文章列表')
@section('content')
    <table class="table">
        <tr>
            <th>管理员id</th>
            <th>管理员姓名</th>
            <th>管理员头像</th>
            <th>操作</th>
        </tr>
        @foreach($Admins as $admin)
        <tr>
            <td>{{$admin->id}}</td>
            <td>{{$admin->name}}</td>
            <td><img src="{{$admin->photo}}" width="50px"></td>
            <td><a href="{{route('admins.edit',$admin)}}">修改 </a> <a href="">删除</a></td>
        </tr>
            @endforeach
        <tr>
            <td colspan="4" style="text-align: center">
                <a href="{{route('admins.create')}}">添加</a>
            </td>
        </tr>
    </table>
    @stop
