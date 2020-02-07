<?php

namespace App\Http\Controllers\Pass;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //
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
}
