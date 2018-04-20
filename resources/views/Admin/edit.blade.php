@extends('Default/default')
@section('content')
    <form action="{{route('addadmins.update',$Admin)}}" method="post" enctype="multipart/form-data">
        管理员姓名:<input type="text" class="form-control" placeholder="管理员姓名" name="name" value="{{$Admin->name}}">
        {{csrf_field()}}
        管理员原头像: <img src="{{\Illuminate\Support\Facades\Storage::url($Admin->logo)}}" alt="图片"><br>
        新头像:<input type="file" name="cover">
        <div class="form-group">
            <label for="exampleInputPassword2">修该密码</label> <span>不填写则不修改</span>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword2">确认密码</label>
            <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword2" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop
