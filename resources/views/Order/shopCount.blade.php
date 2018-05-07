@extends('Default.default')
@section('title','商户菜品销量统计页');
@section('content')
    <form class="form-inline" method="post" action="/dishCount">
        <div class="form-group">
            <label for="start_time">起始时间</label>
            {{csrf_field()}}
            <input type="date" class="form-control" id="start_time" name="start_time" value="{{old('start_time')}}">
        </div>
        <div class="form-group">
            <label for="end_time">结束时间</label>
            <input type="date" class="form-control" id="end_time" name="end_time"
            value="{{old('end_time')}}">
        </div>
        <button type="submit" class="btn btn-default">马上查询</button>
    </form>
    <table class="table table-condensed">
        <tr>
            <td colspan="2">
                今日统计:
            </td>
        </tr>
        <tr>
            <th>店名</th>
            <th>菜名</th>
            <th>数量</th>
        </tr>
        @foreach($shop_name_today  as $value)
        <tr>
            <td>{{$value[0]}}</td>
            <td>{{$value[1]}}</td>
            <td>{{$value[2]}}</td>
        </tr>
            @endforeach
    </table>
    <table class="table table-condensed">
        <tr>
            <td colspan="2">
                本月统计:
            </td>
        </tr>
        <tr>
            <th>店面</th>
            <th>菜名</th>
            <th>数量</th>
        </tr>
        @foreach($shop_name_month   as $value)
            <tr>
                <td>{{$value[0]}}</td>
                <td>{{$value[1]}}</td>
                <td>{{$value[2]}}</td>
            </tr>
        @endforeach

    </table>
    <table class="table table-condensed">
        <tr>
            <td colspan="2">
                入驻以来统计
            </td>
        </tr>
        <tr>
            <th>店面</th>
            <th>菜名</th>
            <th>数量量</th>
        </tr>
        @foreach($shop_name   as $value)
            <tr>
                <td>{{$value[0]}}</td>
                <td>{{$value[1]}}</td>
                <td>{{$value[2]}}</td>
            </tr>
        @endforeach

    </table>
@stop
