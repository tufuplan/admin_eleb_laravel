@extends('Default/default')
@section('title','文章列表')
@section('content')

    <table class="table mytable">
        <tr >
            <th>店家所属分类id</th>
            <th>分类封面图</th>
            <th>分类名称</th>
            <th>操作</th>
        </tr>
        @foreach($Categorys as $category)
            <tr data-id="{{$category->id}}">
                <td>{{$category->id}}</td>
                <td><img src="{{\Illuminate\Support\Facades\Storage::url($category->cover)}}" alt="图片"></td>
                <td>{{$category->name}}</td>
                <td>
                    <a href="{{route('categorys.edit',$category)}}" class="btn btn-primary">修改</a>

                    <button class="btn btn-danger">删除</button>
                </td>

            </tr>
        @endforeach
        <tr>
            <td colspan="4" style="text-align: center">
                <a href="{{route('categorys.create')}}" class="btn btn-default">添加</a>
            </td>
        </tr>
    </table>

@stop
@section('js')
    <script>
        $(function () {
            $(".mytable .btn-danger").click(function () {
                if(confirm('确认删除么?')){
                  var tr = $(this).closest('tr');
                  var id =tr.attr('data-id');
                  $.ajax({
                      type:'DELETE',
                      url:'gcategorys/'+id,
                      data:'_token={{csrf_token()}}',
                      success : function () {
                          tr.fadeOut();
                      }
                  })
                }
            })
        })
    </script>
    @stop

