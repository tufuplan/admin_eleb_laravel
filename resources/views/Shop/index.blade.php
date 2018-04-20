@extends('Default.default')
@section('title','商家列表展示')
    @section('content')
        <table class="table mytable">
            <tr>
                <th>id</th>
                <th>商家账号</th>
                <th>商家logo</th>
                <th>商家所属分类</th>
                <th>商家审核状态</th>
                <th>操作</th>
            </tr>
            @foreach($Shops as $shop)
            <tr date-id="{{$shop->id}}">
                <td>{{$shop->id}}</td>
                <td>{{$shop->account}}</td>
                <td>{{$shop->logo}}</td>
                <td>{{$shop->category->name}}</td>
                <td>{{$shop->status==1?'审核已通过':'未通过'}}</td>
                <td>
                    <button class="btn btn-primary">更改商家审核状态</button>
                    <button class="btn btn-danger">删除该商家</button>
                </td>
            </tr>
                @endforeach
        </table>
        {{$Shops->links()}}
        @stop
@section('js')
    <script>
        $(function () {
            //修改商家的状态
            $('.mytable .btn-primary').click(function () {
                    var tr = this.closest('tr');
                    var id = $(tr).attr('date-id');
                    var that = this;
                    $.ajax({
                        type:'PUT',
                        url:'shops/'+id,
                        data:'_token={{csrf_token()}}',
                        success:function (msg) {
                            var status= $(tr).find('td:nth-last-child(2)').text();
                            if(status=='未通过'){
                                status = '已通过审核'
                            }
                            else {
                                status='未通过'
                            }
                            $(tr).find('td:nth-last-child(2)').text(status);

                        }
                    })
            })
            //删除商家
            $(".mytable .btn-danger").click(function () {
                if(confirm('确定删除吗?删除后不可恢复')){
                    var tr = this.closest('tr');
                    var id = $(tr).attr('date-id');
                    $.ajax({
                            type:'DELETE',
                            url:'shops/'+id,
                            data:'_token={{csrf_token()}}',
                            success:function (msg) {
                                $(tr).fadeOut();
                            }

                        }

                    )
                }
            })

        })

    </script>
    @stop