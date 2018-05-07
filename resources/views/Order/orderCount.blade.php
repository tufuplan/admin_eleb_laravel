@extends('Default.default')
@section('title','按时间统计订菜品销量');
@section('content')
    <div class="row">
    <div class="col-xs-6">开始时间:{{$start_time}}</div>
    <div class="col-xs-6">结束时间:{{$end_time}}</div>
    </div>
    <table class="table table-condensed">
        <tr>
            <th>商户名称</th>
            <th>订单总数量</th>
        </tr>
        @foreach($array as $key=>$value)
        <tr>
            <td>{{$key}}</td>
            <td>{{$value}}</td>
        </tr>
            @endforeach
    </table>
    @stop
