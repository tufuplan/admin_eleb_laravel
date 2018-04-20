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
//管理员登录与注销
Route::get('/login','SessionController@login');
Route::post('/login','SessionController@store');
Route::delete('/logout','SessionController@logout');




