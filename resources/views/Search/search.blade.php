@extends('Default.default')
@section('title','商户搜索详情')
@section('content')
    <table class="table">
        <tr>
            <th>id</th>
            <th>账号</th>
            <th>审核状态</th>
        </tr>
        @foreach($Shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->account}}</td>
                <td>{{$shop->status==0?'未审核':'审核通过'}}</td>
                <td><a href="{{route('shops.show',$shop)}}" class="btn btn-default">查看详情</a></td>
            </tr>
        @endforeach
    </table>
    @stop