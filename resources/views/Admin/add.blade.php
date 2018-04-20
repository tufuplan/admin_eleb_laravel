@extends('Default.default')
@section('title','添加管理员')
@section('content')
    <form method="post" action="{{route('admins.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">管理员姓名</label>
            <input type="text" class="form-control" id="name" placeholder="管理员姓名" name="name"
            value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" class="form-control" id="password" placeholder="输入密码" name="password">
        </div>
        <div class="form-group">
            <label for="password1">确认密码</label>
            <input type="password" class="form-control" id="password1" placeholder="确认密码" name="password_confirmation">
        </div>
        <div class="form-group">
            <label for="photo">照片上传</label>
            <input type="file" id="photo" name="photo">
        </div>
        <div class="col-sm-3">验证码:<input id="captcha" class="form-control" name="captcha" ></div>
        <div class="col-xs-9">
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-default">成为管理员</button>
    </form>
@stop