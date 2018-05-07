@extends('Default.default')
@section('title','平台添加角色')
    @section('content')
        <!-- 加载编辑器的容器 -->
        <div class="container">
        <form method="post" action="{{route('menu.store')}}">
            <div class="form-group">
                <label for="name">菜单名称</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="菜单名称" value="{{old('name')}}">
                {{csrf_field()}}
            </div>
            <div class="form-group">
                <label for="display_name">上级菜单</label>
                <select name="menu" class="form-control">
                    @foreach($menus as $menu)
                        <option value="{{$menu->id}}">{{$menu->name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="url">菜单路由</label>
                <input type="text" class="form-control" name="url" id="url" placeholder="输入所需菜单的路由" value="{{old('url')}}">
            </div>
             <button class="btn btn-default">提交</button>
        </form>
        </div>
        @stop


