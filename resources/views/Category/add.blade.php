@extends('Default/default')
@section('content')
    <form action="{{route('categorys.store')}}" method="post" enctype="multipart/form-data">
        分类名称:<input type="text" class="form-control" placeholder="店家所属分类的名字" name="name" value="{{old('name')}}">
        {{csrf_field()}}
        分类封面图: <input type="file" name="cover">
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop
