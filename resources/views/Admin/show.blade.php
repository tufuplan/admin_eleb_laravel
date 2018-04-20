@extends('Default/default')
@section('title','查看用户')
    @section('content')
        <table class="table">
            <tr>
                <th>用户名</th>
                <th>邮箱</th>
                <th>操作</th>
            </tr>
                <tr>

                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
        </table>
    @stop