<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>平台添加抽奖活动</title>
    <link href="/css/bootstrap.css" rel="stylesheet">
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <script src="/js/jquery-3.2.1.js"></script>
    <script src="/js/bootstrap.js"></script>
</head>

<body>
<!-- 加载编辑器的容器 -->
<form method="post" action="{{route('event.index')}}">
    <div class="form-group">
        <label for="title">活动标题</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="活动标题" value="{{old('title')}}">
    </div>
    {{csrf_field()}}
    <div class="form-group">
        <label for="signup_start">开始时间</label>
        <input type="date" class="form-control" id="signup_start" name="signup_start" value="{{old('signup_start')}}">
    </div>
    <div class="form-group">
        <label for="signup_end">结束时间</label>
        <input type="date" class="form-control" id="signup_end" name="signup_end"
               value="{{old('signup_end')}}">
    </div>
    <div class="form-group">
        <label for="prize_date">活动预计开奖日期</label>
        <input type="date" class="form-control" id="prize_date" name="prize_date"
               value="{{old('prize_date')}}">
    </div>
    <div class="form-group">
        <label for="signup_num">最大报名人数</label>
        <input type="text"  class="form-control" id="signup_num" name="signup_num"
               value="{{old('signup_num')}}">
    </div>
    <script id="container" name="detail" type="text/plain">

    </script>
    <button type="submit" class="btn btn-default">添加</button>
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
        ue.setContent('编辑您的抽奖活动');
        // //获取html内容，返回: <p>hello</p>
        var html = ue.getContent();
        // //获取纯文本内容，返回: hello
        // var txt = ue.getContentTxt();
    });
</script>

</body>

</html>


