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

Route::get('/cc', function () {
    return view('welcome');
});
	
Route::get('/phpinfo', function () {
    phpinfo();
});


// 支付测试
Route::get('/test/alipay','Test\AlipayController@alipay');
// 同步回调
Route::get('/test/return','Test\AlipayController@aliReturn');
// 异步回调
Route::post('/test/notify','Test\AlipayController@notify');

// 接口测试 get
Route::get('Api/get','Api\TestController@get');
// 接口测试 注册
Route::post('Api/reg','Api\TestController@reg');
// 接口测试 登陆
Route::post('Api/login','Api\TestController@login');
// 接口测试 登陆
Route::post('Api/UserList','Api\TestController@UserList')->middleware('List');

// curl get 请求
Route::get('pass/curl1','Test\PassController@curl1');
// curl post 请求
Route::get('pass/curl2','Test\PassController@curl2');
// curl 发送 post 文件 请求
Route::get('pass/curl3','Test\PassController@curl3');
// curl 发送字符串 json | xml
Route::get('pass/curl4','Test\PassController@curl4');

// 签名测试
Route::get('pass/sign1','Test\PassController@sign1');
// 自定义 签名测试
Route::get('pass/sign2','Test\PassController@sign2');

// 验签 注册 
Route::get('check/reg','Check\SignController@reg');
// 登陆
Route::get('check/login','Check\SignController@login');

// 获取用户信息接口
Route::get('check/showTime','Check\SignController@showTime')->middleware('users');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// 用户管理
Route::get('/user/addkey','User\IndexController@addSSHKey1');
Route::post('/user/addkey','User\IndexController@addSSHKey2');
//解密数据
Route::get('/user/decrypt/data','User\IndexController@decrypt1');
Route::post('/user/decrypt/data','User\IndexController@decrypt2');
// 在线验签 signonlie
Route::get('/test/get/signonlie','Sign\IndexController@signOnline');
Route::post('/test/post/signonlie','Sign\IndexController@signOnline1');
Route::get('/test/get/sign1','Sign\IndexController@sign1');
Route::post('/test/post/sign2','Sign\IndexController@sign2');


// 前台
Route::get('/','Index\IndexController@index');
// 注册
Route::get('/reg','Index\IndexController@reg');
// 登陆
Route::get('/login','Index\IndexController@login');

Route::get('/pass/md5test','Pass\TestController@md5test');
Route::get('/pass/md5post','Pass\TestController@md5post');