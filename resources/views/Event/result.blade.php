@extends('Default.default')
@section('title','查看抽奖结果')
    @section('content')
        <table class="table">
            <tr>
                <th>获奖人的姓名</th>
                <th>奖品的名字</th>
            </tr>
            @foreach($Results as $result)
            <tr>
                <td>{{$result->name}}</td>
                <td>{{$result->account}}</td>
            </tr>
                @endforeach
        </table>
        @stop
