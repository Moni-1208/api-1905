<?php

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\CommonModel;

class SignController extends Controller
{
	// curl 发送 poss 请求  注册
    public function reg()
    {
    	$data=[
    		's_name'=>'zhangsan',
    		's_tel'=>'12345678999',
    		's_email'=>'zhangsan@qq.com',
    		's_pwd'=>'123456',
    		'pwds'=>'123456'
    	];
    	// 请求passport 注册接口
    	$url='http://1905.passport.com/sign/reg';
    	$response=CommonModel::curlPost($url,$data); 
        print_r($response);
    }


    // curl 发送 poss 请求  登陆
    public function login()
    {
        $data=[
            's_name'=>'xiaobai',
            's_pwd'=>'123456',
        ];
        // 请求passport 注册接口
        $url='http://1905.passport.com/sign/login';
        $response=CommonModel::curlPost($url,$data); 
        print_r($response);
    }

    // 获取数据接口
    public function showTime()
    {
        $token = '6ad7c721e4ed9db6979a';
        $uid = 6;
        //请求passport 获取数据接口
        $url = 'http://1905.passport.com/sign/showTime';
        $header = [
            'token:'.$token,
            'uid:'.$uid
        ];
        $response = CommonModel::curlGet($url,$header);
    }
}
