@extends('Default.default')
@section('title','角色列表页')
    @section('content')
        <table class="table">
            <tr>
                <th>角色唯一名称</th>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>操作</th>
            </tr>
            @foreach($role_list as $role)
            <tr>
                <td>
                    {{$role->name}}
                </td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td><a class="btn btn-primary" href="{{route('role.edit',$role)}}">修改</a> 删除</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: center">
                    <a href="{{route('role.create')}}" class="btn btn-default">添加角色</a>
                </td>
            </tr>

        </table>
        @stop
