<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    //通用的  完整的 curl 过程
    public static function curlPost($url,$data)
    {
    	// 初始化
    	$ch=curl_init();
    	// 设置请求参数
    	curl_setopt($ch, CURLOPT_URL, $url);
    	// 生成/确定 post 请求
    	curl_setopt($ch, CURLOPT_POST, 1);
    	// form-data  $_POST
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    	// json 把响应保存到变量中
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	// 开启会话 发送请求
    	$response=curl_exec($ch);
    	// 获取错误信息
    	$error=curl_errno($ch);
    	if ($error) {
    		var_dump($error);die;
    	}
    	// 关闭会话 释放资源
    	curl_close($ch);
    	// 处理响应
    	return json_decode($response,true);
    }

    public static function curlGet($url,$header)
    {
        // 初始化
        $ch = curl_init();
        //设置请求参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$header);        // 自定义HTTP 头
        // 开启会话 发起请求
        $response = curl_exec($ch);
        // 获取错误信息
        $error = curl_error($ch);
        if($error)
        {
            var_dump($error);
            die;
        }
        // 关闭会话
        curl_close($ch);
        //处理响应
        return json_decode($response,true);
    }
}
