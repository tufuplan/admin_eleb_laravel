@extends('Default.default')
@section('title','菜单列表页')
    @section('content')
        <table class="table">
            <tr><th>菜单的id</th>
                <th>菜单的名称</th>
                <th>菜单的路由</th>
                <th>菜单的父id</th>
            </tr>
            @foreach($menus as $menu)
            <tr>
                <td>
                {{$menu->id}}
                </td>
                <td>
                    {{$menu->name}}
                </td>
                <td>
                    {{$menu->url}}
                </td>
                <td>
                    {{$menu->parent_id}}
                </td>
            </tr>
            @endforeach
        </table>
        @stop
