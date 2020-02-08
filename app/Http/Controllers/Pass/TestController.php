<?php

namespace App\Http\Controllers\Pass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    // 签名 加密 get 
    public function md5test()
    {
    	$data = "Hello world";
        $key = "1905";

        //计算签名
        $signature = md5($data . $key);
        // $signature = 'asdfsdf';

        echo "待发送的数据为：". $data;
        echo "</br>";

        echo "签名为：". $signature;
        echo "</br>";

        //发送数据
        $url = "http://1905.h5.com/test/tests?data=".$data . '&signature='.$signature;
        echo "url为：".$url;

        $response = file_get_contents($url);
        echo $response;
    }

    // 签名 加密 post
    public function md5post()
    {
        $data=[
            'name'=>'zhangsan',
            'sex' =>'nan',
            'age' =>18
        ];

        print_r($data);echo "<br>";

        $datas=json_encode($data);

        echo "原文:".$datas;echo "<br>";
        $method='AES-256-CBC';
        $key='1905';
        $iv='qwertyuiop123456';

        // 加密
        $enc_data=openssl_encrypt($datas, $method, $key,OPENSSL_RAW_DATA,$iv);
        echo "加密后为:".$enc_data;echo "<hr>";

        // // 解密
        // $dec_data=openssl_decrypt($enc_data, $method, $key,OPENSSL_RAW_DATA,$iv);
        // echo "解密：".$dec_data;

        // 发送加密数据
        $url='http://1905.h5.com/test/md5post?data=' . urlencode(base64_encode($enc_data));
        // echo $url;die;
        $response=file_get_contents($url);
        echo $response;
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
        $url='http://1905.h5.com/pass/sign1?'.$str.'&sign='.urlencode($sign); // urlencode是一个函数，可将字符串以URL编码，用于编码处理
        echo $url;

        $pos=file_get_contents($url);
        echo $pos;
    }


}
