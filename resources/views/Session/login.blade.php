@extends('Default.default')
@section('title','管理员登录')
    @section('content')
        <form method="post" action="/login">
            <div class="form-group">
                <label for="name">用户姓名</label>
                <input type="text" class="form-control" id="name" placeholder="输入姓名" name="name"
                value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" id="password" placeholder="密码" name="password">
            </div>
            {{csrf_field()}}
            <div class="row">
                <div class="col-sm-3">
                    <label for="captcha">验证码:</label>
                    <input id="captcha" class="form-control" name="captcha" >
                </div>
                <div class="col-sm-9">
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                </div>
            </div>


            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember">记住我
                </label>
            </div>
            <button type="submit" class="btn btn-default">登录</button>
        </form>
        @stop
