<?php

namespace App\Http\Controllers;

use App\Business;
use App\SphinxClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //处理搜索
    public function Result(Request $request)
    {
        $keyword = $request->name;
        // --------------------------------------------------------------------------
// File name   : test_coreseek.php
// Description : coreseek中文全文检索系统测试程序
// Requirement : PHP5 (http://www.php.net)
//
// Copyright(C), HonestQiao, 2011, All Rights Reserved.
//
// Author: HonestQiao (honestqiao@gmail.com)
//
// 最新使用文档，请查看：http://www.coreseek.cn/products/products-install/
//
// --------------------------------------------------------------------------

        $cl = new SphinxClient();
        $cl->SetServer ( '127.0.0.1', 9312);
//$cl->SetServer ( '10.6.0.6', 9312);
//$cl->SetServer ( '10.6.0.22', 9312);
//$cl->SetServer ( '10.8.8.2', 9312);
        $cl->SetConnectTimeout ( 10 );
        $cl->SetArrayResult ( true );
// $cl->SetMatchMode ( SPH_MATCH_ANY);
        $cl->SetMatchMode ( SPH_MATCH_EXTENDED2);
        $cl->SetLimits(0, 1000);
        $info = $keyword;
        $res = $cl->Query($info, 'shop');//shopstore_search
//print_r($cl);
        if($res['total']==0){
            session()->flash('danger','没有搜索结果');
            return redirect()->back()->withInput();
        }

        $result= collect($res['matches'])->pluck('id');
       $Shops = Business::query()->whereIn('id',$result)
            ->get();
//        $Shops = ('businesses')
//            ->join('businesses_info','businesses.id','=','businesses_info.id')
//            ->whereIn('businesses.id',$result)
//            ->select()
//            ->get();
        return view('Search.search',compact('Shops'));


    }
}
