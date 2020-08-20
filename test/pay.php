<?php

use Kongflower\Pay\Pay;

require_once dirname(__DIR__).'/vendor/autoload.php';

// /**
//  * 支付公共参数初始化
//  */
// $pay = new Pay([
//     'appid' => 'wxb829f31ecd32bdf5',
//     'mch_id' => '10037582',
//     'key' => '3phqOIhrvQjCAwdEqpjosP4913ZpEskN',
// ]);

// $app = [
//         'body' => '测试-充值测试',
//         'notify_url' => 'https://pay.skinrun.cn/pay_callback',
//         'out_trade_no' => '202054541484',
//         'total_fee' => 1,
//         'openid' => 'oTrN9t1gi91ER6k98_Wv7E1W1jeA', //JSAPI支付必传参数
//     ];
// $pay::Weichat([
//     'body' => '测试-充值测试',
//     'notify_url' => 'https://pay.skinrun.cn/pay_callback',
//     'out_trade_no' => '202054541484',
//     'total_fee' => 1,
//     'openid' => 'oTrN9t1gi91ER6k98_Wv7E1W1jeA', //JSAPI支付必传参数
//     ],['ceshi']);

$config = [
            'appid' => 'wxb829f31ecd32bdf5',
            'mch_id' => '10037582',
            'key' => '3phqOIhrvQjCAwdEqpjosP4913ZpEskN',
         ];
$pay  = Pay::Weichat($config)->pay('app',['title' => 'APP支付']);

$order = [
            'body' => '测试-充值测试',
            'notify_url' => 'https://pay.skinrun.cn/pay_callback',
            'out_trade_no' => '202054541484',
            'total_fee' => 1,
            'openid' => 'oTrN9t1gi91ER6k98_Wv7E1W1jeA', //JSAPI支付必传参数
        ];
