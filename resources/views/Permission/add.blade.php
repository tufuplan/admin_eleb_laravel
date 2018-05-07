@extends('Default.default')
@section('title','平台添加权限')
    @section('content')
        <!-- 加载编辑器的容器 -->
        <form method="post" action="{{route('permission.store')}}">
            <div class="form-group">
                <label for="title">权限唯一名称</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="权限名称" value="{{old('name')}}">
                {{csrf_field()}}
            </div>
            <div class="form-group">
                <label for="display_name">权限名字</label>
                <input type="text" name="display_name" class="form-control" id="display_name" placeholder="权限名字"  value="{{old('display_name')}}">
            </div>
            <div class="form-group">
                <label for="detail">权限描述</label>
                <input type="text" name="detail" class="form-control"
                       id="detail" placeholder="权限描述" value="{{old('detail')}}">
            </div>

            <button class="btn btn-default">提交</button>
        </form>
        @stop


