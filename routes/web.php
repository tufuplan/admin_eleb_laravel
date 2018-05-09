<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//商家分类的增删改查
Route::resource('categorys','CategoryController');
//管理员的增删改查
Route::resource('admins','AdminController');
//    ->middleware('role:admin');
//管理员登录与注销
Route::get('/login','SessionController@login')->name('login');
Route::post('/login','SessionController@store');
Route::delete('/logout','SessionController@logout');
Route::resource('shops','ShopController');
Route::resource('activity','ActivityController');
Route::get('/orderCount','OrderController@index')->name('orderCount');
Route::post('/orderCount','OrderController@timeCount');
Route::get('/dishCount','OrderController@dishCount')->name('dishCount');
//按时间搜索商户菜品销量
Route::post('/dishCount','OrderController@goodCount');
//角色资源
Route::resource('role','RoleController');
//权限资源
Route::resource('permission','PermissionController');
//管理员选择角色
Route::get('/chooseRole','AdminController@chooseRole')->name('chooseRole');
//
Route::resource('menu','MenuController');
//抽奖活动的增删改查
Route::resource('event','EventController');
//奖品的增删改查
Route::resource('prize','PrizeController');
//抽奖活动的开奖
Route::get('/jiang','EventController@jiang');
//用户查看抽奖的结果
Route::get('/result','EventController@result');









