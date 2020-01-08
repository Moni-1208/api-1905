<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

class PassController extends Controller
{
    /**
     * curl get 请求 
     */
    public function curl1()
    {
    	$url='http://1905.server.com/pass/curl1?data=name=zhangsan&email=zhangsan@qq.com';
    	// echo $url.'<br>';
    	// 初始化
    	$ch=curl_init();
    	// 设置参数
    	curl_setopt($ch, CURLOPT_URL, $url);
    	// 执行会话
    	curl_exec($ch);
    	// 关闭会话 释放资源
    	curl_close($ch);
    }

    /**
     * curl post 请求 
     */
    public function curl2()
    {
    	$url='http://1905.server.com/pass/curl2';
    	// echo $url.'<br>';
    	$data=[
    		'name'=>'zhangsan',
    		'email'=>'zhangsan@qq.com',
    		'age'=>122
    	];
    	// 初始化
    	$ch=curl_init();
    	// 设置参数
    	curl_setopt($ch, CURLOPT_URL, $url);
    	// 生成 host 请求
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	// 执行会话
    	curl_exec($ch);
    	// 关闭会话 释放资源
    	curl_close($ch);
    }

    /**
     * curl post 请求 上传文件 
     */
    public function curl3()
    {
    	$url='http://1905.server.com/pass/curl3';
    	echo $url.'<br>';
    	$data=[
    		'user_img'=>new \CURLFile('aaa.jpg') // 要上传的文件路径
    	];
    	// 初始化
    	$ch=curl_init();
    	// 设置参数
    	curl_setopt($ch, CURLOPT_URL, $url);
    	// 生成 host 请求
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	// 开启会话 发送请求
    	curl_exec($ch);
    	// 关闭会话 释放资源
    	curl_close($ch);
    }

    /**
     * curl 发送字符串 json | 字符串
     */
    public function curl4()
    {
    	$url='http://1905.server.com/pass/curl4';
    	$token=Str::random(20);
    	echo "token为:".		$token.'<br>';
    	$data=[
    		'name'=>'zhangsan',
    		'email'=>'zhangsan@qq.com',
    		'age'=>122
    	];
    	echo "发送前数据：";print_r($data);
    	echo "<br>";
    	$json_str=json_encode($data);
    	echo "待发送数据：".$json_str;
    	// 初始化
    	$ch=curl_init();
    	// 设置参数
    	curl_setopt($ch, CURLOPT_URL, $url);
    	// 生成 host 请求
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $json_str);
    	curl_setopt($ch, CURLOPT_HTTPHEADER, [
    		'Content-Type:text/plain',
    		'token:'.$token
    	]);
    	// 执行会话
    	curl_exec($ch);
    	// 关闭会话 释放资源
    	curl_close($ch);
    }
}
