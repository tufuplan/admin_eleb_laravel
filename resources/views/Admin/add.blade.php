@extends('Default/default')
@section('content')
    <form action="{{route('addadmins.store')}}" method="post" enctype="multipart/form-data">
        管理员姓名:<input type="text" class="form-control" placeholder="管理员姓名" name="name" value="{{old('name')}}">
        {{csrf_field()}}
        管理员头像: <input type="file" name="cover">
        <div class="form-group">
            <label for="exampleInputPassword2">密码</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">确认密码</label>
            <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword2" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop
