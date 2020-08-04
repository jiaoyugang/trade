<?php
require dirname(__DIR__).'/../trade/vendor/autoload.php';


use Kongflower\Pay\Utils\Weichat\App\AppTrade;
use Kongflower\Pay\Utils\Weichat\H5\H5Trade;
use Kongflower\Pay\Utils\Weichat\Jsapi\JsapiTrade;

// use Kongflower\Pay\Utils\weichat\WxPay;

// try{
//     // MWEB
//     // JSAPI
//     // NATIVE
//     $pay = WxPay::getInstance(['appid' => 'wxb829f31ecd32bdf5','mch_id' => '10037582' ,'trade_type' => 'NATIVE','key' => '3phqOIhrvQjCAwdEqpjosP4913ZpEskN']);
//     $requestBody = [
//         'body' => '测试-充值测试',
//         'notify_url' => 'https://pay.skinrun.cn/pay_callback',
//         'out_trade_no' => '202051224541484',
//         'scene_info' => '{"h5_info": {"type":"IOS","app_name": "测试","bundle_id": "com.tencent.wzryIOS"}}',
//         'total_fee' => 1 , //分
//         'openid' => 'oTrN9t1gi91ER6k98_Wv7E1W1jeA', //JSAPI支付必传参数
//         'product_id' => '413214070356458058', //NATIVE支付必传参数
//     ];
    
//     var_dump($pay::unifiedOrder($requestBody));
//     // var_dump($pay::unifiedOrder($requestBody));
// }catch(\Exception $exc){
//     var_dump($exc->getMessage());
// }

$jsapi = new JsapiTrade([
    'appid' => 'wxb829f31ecd32bdf5',
    'mch_id' => '10037582',
    'key' => '3phqOIhrvQjCAwdEqpjosP4913ZpEskN',
]);

$resultJsapi = $jsapi->unified([
    'body' => '测试-充值测试',
    'notify_url' => 'https://pay.skinrun.cn/pay_callback',
    'out_trade_no' => '202054541484',
    'total_fee' => 1,
    'openid' => 'oTrN9t1gi91ER6k98_Wv7E1W1jeA', //JSAPI支付必传参数
]);

var_dump($resultJsapi);