<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">后台首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {{\App\Menu::nav()}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li class="active"><a href=""><span class="sr-only">(current)</span></a></li>--}}
                {{--<li><a href="{{route('shops.index')}}">商家列表</a></li>--}}
                {{--<li><a href="{{route('admins.index')}}">管理员列表</a></li>--}}
                {{--<li><a href="{{route('activity.create')}}">平台添加活动</a></li>--}}
                {{--<li><a href="{{route('activity.index')}}">添加活动的列表</a></li>--}}
                {{--<li><a href="/categorys">商家所属分类列表</a></li>--}}
                {{--<li class="dropdown">--}}
                    {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">下拉<span class="caret"></span></a>--}}

                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="/orderCount">统计商户订单页</a></li>--}}
                        {{--<li><a href="/dishCount">统计商户菜品页</a></li>--}}
                        {{--<li><a href="{{route('role.index')}}">角色列表</a></li>--}}
                        {{--<li><a href="{{route('permission.index')}}">权限列表</a></li>--}}
                        {{--<li><a href=""></a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#">Separated link</a></li>--}}
                        {{--<li role="separator" class="divider"></li>--}}
                        {{--<li><a href="#"></a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">菜单管理<span class="caret"></span></a>

                    <ul class="dropdown-menu">
                        <li><a href="{{route('menu.index')}}">菜单列表</a></li>
                        <li><a href="{{route('menu.create')}}">菜单添加</a></li>
                    </ul>
                </li>
            {{--</ul>--}}
            <form class="navbar-form navbar-left" method="get" action="@yield('action')">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" name="keyword">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if(!\Illuminate\Support\Facades\Auth::user())
                <li><a href="/login">登录</a></li>
                @endif
                @if(\Illuminate\Support\Facades\Auth::user())
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">注销选项<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <form action="/logout" method="post">
                        <li><button class="btn btn-danger">注销</button></li>
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                        </form>
                    </ul>
                </li>
                    @endif


            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
