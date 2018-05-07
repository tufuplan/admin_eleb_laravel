@extends('Default.default')
@section('title','商户菜品销量统计页');
@section('content')

    <div class="row">
        <div class="col-xs-6">开始时间:{{$start_time}}</div>
        <div class="col-xs-6">结束时间:{{$end_time}}</div>
    </div>
    <table class="table table-condensed">
        <tr>
            <th>店名</th>
            <th>菜名</th>
            <th>数量</th>
        </tr>
        @foreach($result  as $value)
        <tr>
            <td>{{$value[0]}}</td>
            <td>{{$value[1]}}</td>
            <td>{{$value[2]}}</td>
        </tr>
            @endforeach
    </table>
@stop
