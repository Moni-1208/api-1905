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

        echo "签名为：". $signature;

        //发送数据
        $url = "http://1905h5.com/test/test?data=".$data . '&signature='.$signature;
        echo $url;

        $response = file_get_contents($url);
        echo $response;
    }
}
