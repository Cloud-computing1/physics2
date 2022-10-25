<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login','studentController@login');//登录
Route::post('register','studentController@register');//注册
Route::post('email_regi','studentController@email_regi');//发送邮件
Route::post('email_forget','studentController@email_forget');//忘记密码发送邮件
Route::post('forget','studentController@forget');//忘记密码
Route::post('submit_detail','studentController@submit_detail');//填写学生详细信息
Route::post("img","expController@img");//将单摆测重力加速度的图片上传到OSS，转化成为URL
Route::post("t","expController@t");//单摆测重力加速度
Route::post("exp_4","expController@exp_4");//欧姆表的安装与设计
Route::post("exp_3","expController@exp_3");//自组式直流电桥测电阻
Route::post("img3","expController@img3");//将欧姆表的安装与设计的图片上传到OSS，转化成为URL
Route::post("img4_1","expController@img4_1");//将自组式直流电桥测电阻的图片1上传到OSS，转化成为URL
Route::post("img4_2","expController@img4_2");//将自组式直流电桥测电阻的图片2上传到OSS，转化成为URL

