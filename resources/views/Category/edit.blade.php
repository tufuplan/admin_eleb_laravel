@extends('Default/default')
@section('content')
    <form action="{{route('categorys.update',$category)}}" method="post" enctype="multipart/form-data">
        分类名称:<input type="text" class="form-control" placeholder="分类的名称" name="name" value="{{$category->name}}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        原封面图:<img src="{{\Illuminate\Support\Facades\Storage::url($category->cover)}}" alt="">
        新封面图:<input type="file" name="cover">
        <button type="submit" class="btn btn-default">提交</button>
    </form>
@stop