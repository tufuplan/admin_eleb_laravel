@extends('Default/default')
@section('title','用户');
@section('content')
    <form action="{{route('admins.store')}}" method="post">
        <div class="form-group">
            <label for="name"></label>
            <input type="text" name="name" class="form-control" id="name" placeholder="用户名" value="{{old('name')}}">
        </div>
            {{csrf_field()}}
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="col-xs-3">

        </div>
        <div class="container">
            验证码:<input id="captcha" class="form-control" name="captcha">
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember"> Check me out
            </label>
        </div>
        <button type="submit" class="btn btn-default">提交</button>

    </form>
@stop
