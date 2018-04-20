
@extends('Default.default')
@section('title','修改管理员信息')
@section('content')
    <form method="post" action="{{route('admins.update',$admin)}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">管理员姓名</label>
            <input type="text" class="form-control" id="name" placeholder="管理员姓名" name="name"
            value="{{$admin->name}}">
        </div>
        <div class="form-group">
            <label for="oldpassword">原密码</label>
            <input type="password" class="form-control" id="oldpassword" placeholder="输入原密码" name="oldpassword">
        </div>
        <div class="form-group">
            <label for="password1">新密码</label>
            <input type="password" class="form-control" id="password1" placeholder="输入新密码" name="password">
        </div>
        <div class="form-group">
            <label for="password2">确认密码</label>
            <input type="password" class="form-control" id="password2" placeholder="确认新密码" name="password_confirmation">
        </div>
        <div class="form-group">
            <label for="photo">照片上传,不上传不修改</label>
           原照片: <img src="{{$admin->photo}}">
            <input type="file" id="photo" name="photo">
        </div>
        <div class="col-sm-3">验证码:<input id="captcha" class="form-control" name="captcha" ></div>
        <div class="col-xs-9">
            <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
        <button type="submit" class="btn btn-default">马上修改</button>
    </form>
@stop