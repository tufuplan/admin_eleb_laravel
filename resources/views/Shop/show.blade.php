@extends('Default.default')
@section('title','商家详情页')
    @section('content')
        <table class="table">
            <tr>
                <th>id</th>
                <th>评分</th>
                <th>品牌</th>
                <th>是否准时</th>
                <th>是否蜂鸟</th>
                <th>是否保</th>
                <th>是否票</th>
                <th>是否准标记</th>
                <th>起送金额</th>
                <th>配送金额</th>
                <th>公告</th>
                <th>优惠信息</th>

            </tr>
            <tr>
                <td>{{$Shop->id}}</td>
                <td>{{$Shop->shop_rating}}</td>
                <td>{{$Shop->brand}}</td>
                <td>{{$Shop->on_time}}</td>
                <td>{{$Shop->fengniao}}</td>
                <td>{{$Shop->bao}}</td>
                <td>{{$Shop->piao}}</td>
                <td>{{$Shop->zhun}}</td>
                <td>{{$Shop->start_send}}</td>
                <td>{{$Shop->send_cost}}</td>
                <td>{{$Shop->notice}}</td>
                <td>{{$Shop->discount}}</td>
            </tr>
            <tr style="text-align: center">
                <td colspan="11"><a href="/shops/{{$Shop->id}}/edit" class="btn btn-primary" >通过审核</a>
                </td>
            </tr>
        </table>
        @stop
