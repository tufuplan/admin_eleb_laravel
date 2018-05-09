<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index()
    {
        //查询所有商户的所有订单量
        $rows = DB::table('orders')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select(DB::raw('count(*) as order_count, businesses.account'))
            ->groupBy('businesses.account')
            ->get();
        $shop_name = [];
        $shop_order = [];
        foreach ($rows as $row){
            $shop_name[] = $row->account;
            $shop_order[] = $row->order_count;
        }
        $array_all = array_combine($shop_name,$shop_order);
        //商户今日所有订单量
        $today = date("Y-m-d",time())." 0:0:0";
        $current = date('Y-m-d H:i:s');
        $rows = DB::table('orders')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select(DB::raw('count(*) as order_count, businesses.account'))
            ->where('orders.created_at','>',$today)
            ->where('orders.created_at','<',$current)
            ->groupBy('businesses.account')
            ->get();
        $shop_name_today = [];
        $shop_order_today = [];
        foreach ($rows as $row){
            $shop_name_today[] = $row->account;
            $shop_order_today[] = $row->order_count;
        }
        $array_today = array_combine($shop_name_today,$shop_order_today);
        //商户当月订单量
        $current_month= date("Y-m-01",time())." 0:0:0";
        $time = date("Y-m-d H:i:s",time());
        $rows = DB::table('orders')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select(DB::raw('count(*) as order_count, businesses.account'))
            ->where('orders.created_at','>',$current_month)
            ->where('orders.created_at','<',$time)
            ->groupBy('businesses.account')
            ->get();
        $shop_name_month = [];
        $shop_order_month = [];
         foreach ($rows as $row){
             $shop_name_month[] = $row->account;
             $shop_order_month[] =$row->order_count;
         }
         $array_month = array_combine($shop_name_month,$shop_order_month);
        if($array_month==[]){
            $array_month = ['商家订单量','暂时没有订单'];
        }
        //
        return view('Order.index',compact(['array_today','array_all','array_month']));
    }
    //选指定时间对商户订单进行计数
    public function timeCount(Request $request)
    {
        $this->validate($request,[
            'start_time'=>'required|date|before:today',
            'end_time'=>'required|date|after:start_time|before:today'
        ],[
            'start_time.required'=>'开始时间不能为空',
            'start_time.date'=>'开始时间必须是一个时间',
            'start_time.before'=>'开始时间必须是今天以前',
            'end_time.required'=>'结束时间不能为空',
            'end_time.date'=>'结束时间必须是一个时间',
            'end_time.after'=>'结束时间必须在开始时间以后',
            'end_time.before'=>'结束时间必须在今天以前'
        ]);
        //数据验证完成,进行查询
        $start_time = $request->start_time." 0:0:0";
        $end_time = $request->end_time." 23:59:59";
        $rows = DB::table('orders')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select(DB::raw('count(*) as order_count, businesses.account'))
            ->where('orders.created_at','>',$start_time)
            ->where('orders.created_at','<',$end_time)
            ->groupBy('businesses.account')
            ->get();
        $shop_name =[];
        $shop_order =[];
        foreach ($rows as $row){
            $shop_name[] =$row->account;
            $shop_order[] = $row->order_count;
        }
        $array = array_combine($shop_name,$shop_order);
        if($array==[]){
            $array = ['false'=>'没有订单'];
        }
        return view('Order.orderCount',compact(['array','start_time','end_time']));

    }
    //平台菜品量统计
    public function dishCount()
    {
        //查出所有数据显示在页面中
        //商户所有菜卖了多少
        $rows = DB::table('order_dishes')
            ->join('orders','order_dishes.order_id','=','orders.id')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select('businesses.account','order_dishes.good_name',DB::raw('sum(order_dishes.amount) as amount'))
            ->groupBy('order_dishes.good_name','businesses.account')
            ->orderBy('amount','desc')
            ->get();


        $shop_name = [];
        foreach ($rows as $row){
             $shop_name[] = [$row->account,$row->good_name,$row->amount];
        }

        //所有商家今日卖了多少
        $today = date("Y-m-d",time())." 0:0:0";
        $current = date('Y-m-d H:i:s');
        $rows = DB::table('order_dishes')
            ->join('orders','order_dishes.order_id','=','orders.id')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select('businesses.account','order_dishes.good_name',DB::raw('sum(order_dishes.amount) as amount'))
            ->where('orders.created_at','>',$today)
            ->where('orders.created_at','<',$current)
            ->groupBy('order_dishes.good_name','businesses.account')
            ->orderBy('amount','desc')
            ->get();
        $shop_name_today = [];
        foreach ($rows as $row){

            $shop_name_today[] = [$row->account,$row->good_name,$row->amount];
        }
        if($shop_name_today ==[]){
            $array_today = ['today','今日还没有订单'];
        }
        //所有商家当月卖了多少
        $current_month= date("Y-m-01",time())." 0:0:0";
        $time = date("Y-m-d H:i:s",time());
        $rows = DB::table('order_dishes')
            ->join('orders','order_dishes.order_id','=','orders.id')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->where('orders.created_at','>',$current_month)
            ->where('orders.created_at','<',$time)
            ->select('businesses.account','order_dishes.good_name',DB::raw('sum(order_dishes.amount) as amount'))
            ->groupBy('order_dishes.good_name','businesses.account')
            ->orderBy('amount','desc')
            ->get();
        $shop_name_month = [];
        foreach ($rows as $row){
            $shop_name_month[] = [$row->account,$row->good_name,$row->amount];
        }
        if($shop_name_month==[]){
            $shop_name__month = ['month'=>'本月还没有订单'];
        }
    return view('Order.shopCount',compact(['shop_name','shop_name_month','shop_name_today']));
    }
    //按时间统计
    public function goodCount(Request $request)
    {
        $this->validate($request,[
            'start_time'=>'required|date|before:today',
            'end_time'=>'required|date|after:start_time|before:today'
        ],[
            'start_time.required'=>'开始时间不能为空',
            'start_time.date'=>'开始时间必须是一个时间',
            'start_time.before'=>'开始时间必须是今天以前',
            'end_time.required'=>'结束时间不能为空',
            'end_time.date'=>'结束时间必须是一个时间',
            'end_time.after'=>'结束时间必须在开始时间以后',
            'end_time.before'=>'结束时间必须在今天以前'
        ]);
        $start_time = $request->start_time." 0:0:0";
        $end_time = $request->end_time." 23:59:59";
        $rows = DB::table('order_dishes')
            ->join('orders','order_dishes.order_id','=','orders.id')
            ->join('businesses','orders.shop_id','=','businesses.id')
            ->select('businesses.account','order_dishes.good_name',DB::raw('sum(order_dishes.amount) as amount'))
            ->where('orders.created_at','>',$start_time)
            ->where('orders.created_at','<',$end_time)
            ->groupBy('order_dishes.good_name','businesses.account')
            ->orderBy('amount','desc')
            ->get();
        $result = [];
        foreach ($rows as $row){
            $result[] = [$row->account,$row->good_name,$row->amount];
        }
        return view('Order.timeCount',compact(['result','start_time','end_time']));
    }

}
