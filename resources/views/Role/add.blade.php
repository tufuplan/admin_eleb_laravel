@extends('Default.default')
@section('title','平台添加角色')
    @section('content')
        <!-- 加载编辑器的容器 -->
        <form method="post" action="{{route('role.store')}}">
            <div class="form-group">
                <label for="title">角色唯一名称</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="角色名称" value="{{old('name')}}">
                {{csrf_field()}}
            </div>
            <div class="form-group">
                <label for="display_name">角色名字</label>
                <input type="text" name="display_name" class="form-control" id="display_name" placeholder="角色名字"  value="{{old('display_name')}}">
            </div>
            <div class="form-group">
                <label for="detail">角色描述</label>
                <input type="text" name="detail" class="form-control"
                       id="detail" placeholder="角色描述" value="{{old('detail')}}">
            </div>
            <h1>角色所拥有的权限</h1>
            @foreach($permissions as $permission)
            <label class="checkbox-inline">
                <input type="checkbox" id="{{$permission->name}}" value="{{$permission->id}}" name="permission[]"> {{$permission->display_name}}
            </label>
            @endforeach
            <br>
            <button class="btn btn-default">提交</button>
        </form>
        @stop


