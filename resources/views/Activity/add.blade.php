@extends('Default.default')
@section('title','平台添加活动')
    @section('content')
        <body>
        <!-- 加载编辑器的容器 -->

        <form method="post" action="{{route('activity.store')}}">
            <div class="form-group">
                <label for="title">活动标题</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="活动标题" value="{{old('name')}}">
                {{csrf_field()}}
            </div>
            <div class="form-group">
                <label for="start_time">开始时间</label>
                <input type="date" name="start_time" class="form-control" id="start_time" placeholder="活动开始时间" value="{{old('start_time')}}">
            </div>
            <div class="form-group">
                <label for="end_time">结束时间</label>
                <input type="date" name="end_time" class="form-control"
                       id="end_time" placeholder="活动开始时间" value="{{old('end_time')}}">
            </div>
        <script id="container" name="content1" type="text/plain">
        </script>
            <button class="btn btn-default">提交</button>
        </form>

        <!-- 配置文件 -->
        <script type="text/javascript" src="/utf8-php/ueditor.config.js"></script>
        <!-- 编辑器源码文件 -->
        <script type="text/javascript" src="/utf8-php/ueditor.all.js"></script>
        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.setHeight(400);
                //设置编辑器的内容
                 ue.setContent('编辑您的活动');
                // //获取html内容，返回: <p>hello</p>
                 var html = ue.getContent();
                // //获取纯文本内容，返回: hello
                // var txt = ue.getContentTxt();
            });
        </script>
        </body>
        @stop


