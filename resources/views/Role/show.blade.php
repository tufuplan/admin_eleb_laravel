@extends('Default.default')
@section('title','角色列表页')
    @section('content')
        <table class="table">
            <tr>
                <th>角色唯一名称</th>
                <th>角色名称</th>
                <th>角色描述</th>
            </tr>
            <tr>
                <td>
                    {{$role->name}}
                </td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
            </tr>
        </table>
        <h1>角色所拥有的权限</h1>
        <div class="container">
        <div class="row">
            <table class="table">
                <tr>
                    <th>权限的名称</th>
                </tr>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{$permission->display_name}}</td>
                </tr>
                @endforeach
            </table>
        </div>
        </div>

        @stop
