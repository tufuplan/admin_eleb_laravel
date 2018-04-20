<?php

namespace App\Http\Controllers;

use App\Model\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BusinessController extends Controller
{
    //显示商家列表简单表的信息
    public function index()
    {
        $Shops = Business::paginate(3);
        return view('Shop.index',compact('Shops'));
    }
    //修改商家的状态
    public function update(Request $request,Business $shop)
    {
      //修改商家的状态修改简单表,通过ajax
        if($shop->status==1){
            $shop->update([
                'status'=>0
            ]);
        }else{
            $shop->update([
                'status'=>1
            ]);
        }
    }
    //删除商家要连着两张表一起删除
    public function destroy(Business $shop){
        $id = $shop->id;
        //再删除详情表中的shop
        DB::table('businesses_info')->where('id','=',$id)->delete();
        $shop->delete();
    }

}
