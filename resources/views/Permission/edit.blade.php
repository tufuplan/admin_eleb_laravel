@extends('Default.default')
@section('title','修改权限')
    @section('content')
        <!-- 加载编辑器的容器 -->
        <form method="post" action="{{route('permission.update',$permission)}}">
            <div class="form-group">
                <label for="title">权限唯一名称</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="角色名称" value="{{$permission->name}}">
                {{csrf_field()}}
                {{method_field("PUT")}}
            </div>
            <div class="form-group">
                <label for="display_name">权限名字</label>
                <input type="text" name="display_name" class="form-control" id="display_name" placeholder="角色名字"  value="{{$permission->display_name}}">
            </div>
            <div class="form-group">
                <label for="detail">权限描述</label>
                <input type="text" name="detail" class="form-control"
                       id="detail" placeholder="角色描述" value="{{$permission->description}}">
            </div>
            <button class="btn btn-default">修改</button>
        </form>
        @stop


