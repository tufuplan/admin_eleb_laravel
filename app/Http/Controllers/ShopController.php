<?php

namespace App\Http\Controllers;

use App\Business;
use App\Businesses_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //显示商家列表首页
            $Shops = Business::all();
            return view('Shop.index',compact('Shops'));
    }
    //显示商家详情
    public function show(Business $shop)
    {
        $id = $shop->id;
        $Shops = DB::table('businesses_info')->where('id','=',$id)->get();
        foreach ($Shops as $Shop){
            return view('Shop.show',compact('Shop'));
        }
    }
    //更改审核状态
    public function edit($id)
    {
    DB::table('businesses')->where('id','=',$id)->update([
        'status'=>1
    ]);
    //成功提示
        session()->flash('success','更改审核状态成功');
        //跳转
        return redirect()->route('shops.index');
    }

}
