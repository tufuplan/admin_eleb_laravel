@extends('Default.default')
@section('title','权限列表页')
    @section('content')
        <table class="table">
            <tr>
                <th>角色唯一名称</th>
                <th>角色名称</th>
                <th>角色描述</th>
                <th>操作</th>
            </tr>
            @foreach($Permissions as $permission)
            <tr>
                <td>
                {{$permission->name}}
                </td>
                <td>
                    {{$permission->display_name}}
                </td>
                <td>
                    {{$permission->description}}
                </td>
                <td><a class="btn btn-primary" href="{{route('permission.edit',$permission)}}">修改</a>
                    <form action="{{route('permission.destroy',$permission)}}" method="post">
                    {{method_field("DELETE")}}
                        {{csrf_field()}}
                        <button class="btn btn-danger">删除</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: center">
                    <a href="{{route('permission.create')}}" class="btn btn-default">添加权限</a>
                </td>
            </tr>

        </table>
        @stop
