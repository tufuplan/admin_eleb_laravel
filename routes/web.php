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
Route::resource('categorys','Admin\CategoryController');
//商家登录与注册
//Route::resoure('users','Admin\UserController');
//管理员登录与注销
Route::resource('admins','Admin\AdminController');
Route::resource('addadmins','Admin\AddAdminController');
//商家的增删改查
Route::resource('shops','BusinessController');



