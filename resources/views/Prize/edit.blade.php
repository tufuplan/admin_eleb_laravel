@extends('Default.default')
@section('title','添加活动下的商品')
    @section('content')
        <form method="post" action="{{route('prize.update',$prize)}}">
            <div class="form-group">
                <label for="name">奖品名称</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="奖品名称" value="{{$prize->name}}">
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="form-group">
                <label for="detail">奖品描述</label>
                <input type="text" class="form-control" name="detail" id="detail" placeholder="奖品名称" value="{{$prize->description}}">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        @stop
