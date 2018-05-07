@extends('Default.default')
@section('title','添加活动下的商品')
    @section('content')
        <form method="post" action="{{route('prize.store')}}">
            <div class="form-group">
                <label for="name">奖品名称</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="奖品名称" value="{{old('name')}}">
            </div>
            <input type="hidden" name="event_id" value="{{$event_id}}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="detail">奖品描述</label>
                <input type="text" class="form-control" name="detail" id="detail" placeholder="奖品名称" value="{{old('detail')}}">
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        @stop
