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

Route::post('/admin/login','AdminController@login');
//Route::post('/admin/regi','AdminController@register');
Route::get('/admin/get_students_info', 'AdminController@get_stu_detail');
Route::post('admin/mod_stu_info', 'AdminController@mod_stu_info');
Route::post('admin/del_stu', 'AdminController@del_stu');
Route::get('admin/get_teachers_info', 'AdminController@get_teachers_info');
