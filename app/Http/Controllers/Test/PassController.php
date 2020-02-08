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
    	echo "token为:".	$token.'<br>';
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

    /**
     * 
     私钥签名测试
     */
    public function sign1()
    {
        $params=[
            'user_name'=>'zhangsan',
            'email'=>'zhangsan@qq.com',
            'amount'=>8888,
            'sata'=>time()
        ];
        echo "排序前：";print_r($params);echo "<br>";

        // 将参数字典序排序
        ksort($params);
        // echo "排序后：";print_r($params);echo "<br>";

        // 拼接 待签名 字符串
        $str ="";
        foreach($params as $k=>$v)
        {
            $str .= $k .= '='.$v.'&';
        }
        $str=rtrim($str,'&');
        echo $str.'<hr>';
        
        // 使用私钥进行签名
        $priv_key=file_get_contents(storage_path('keys/priv.key'));
        openssl_sign($str, $signature, $priv_key,OPENSSL_ALGO_SHA256);
        var_dump($signature);
        echo "<hr>";
        // base64编码签名
        $sign=base64_encode($signature);
        echo "base64_签名：".$sign;
        echo "<hr>";

        // 发送数据
        $url='http://1905.server.com/pass/sign1?'.$str.'&sign='.urlencode($sign); // urlencode是一个函数，可将字符串以URL编码，用于编码处理
        echo $url;

        $pos=file_get_contents($url);
        echo $pos;
    }

    /**
     * 自定义签名
     */
    public function sign2()
    {
        $token_key='abcdefg';
        $data=[
            'user_name'=>'zhangsan',
            'email'=>'zhangsan@qq.com',
            'amount'=>8888,
            'sata'=>time()
        ];
        // 字典集排序
        ksort($data);
        // 拼接字符串
        $str="";
        foreach ($data as $k => $v) {
            $str .= $k .= '='. $v . '&';
        }
        $str=rtrim($str,'&');
        echo "待签名字符串：".$str;echo '<br>';
        // 计算签名
        $token=md5($str.$token_key);
        $sign=$str.'&sign='.$token;
        echo "要发送的验签：".$sign;echo "<br>";
        $url = 'http://1905.server.com/pass/sign2?'.$sign;
        echo $url;
        $pos=file_get_contents($url);
        echo $pos;
    }
}
