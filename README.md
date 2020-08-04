[TOC]

## 微信支付

##### APP支付
```php
#APP支付
$app = new AppTrade([
    'appid' => 'wxb829xxxxxxxxf5',
    'mch_id' => '10xxxxx',
    'key' => '3phqOIxxxxxxx913ZpEskN',
]);

//统一下单
$result = $app->unified([
    'body' => '测试-充值测试',
    'notify_url' => 'https://pay.xxxxx.cn/pay_callback',
    'out_trade_no' => '20205122452',
    'total_fee' => 1,
]);
var_dump($result);

#查询订单状态：建议优先使用transaction_id，当然也可以使用out_trade_no（商户内部自定义的商品ID）
$result_query = $app->orquery([
    'transaction_id' => 'dy_13403007360239616',
]);
var_dump($result_query);

```
##### H5支付

商户在微信客户端外的移动端网页展示商品或服务，用户在前述页面确认使用微信支付时，商户发起本服务呼起微信客户端进行支付。 主要用于触屏版的手机浏览器请求微信支付的场景。可以方便的从外部浏览器唤起微信支付。

```php

// #H5支付
$h5 = new H5Trade([
    'appid' => 'wxb829xxxxxxxxf5',
    'mch_id' => '10xxxxx',
    'key' => '3phqOIxxxxxxx913ZpEskN',
]);

//统一下单
$result_h5 = $h5->unified([
        'body' => '测试-充值测试',
        'notify_url' => 'https://pay.xxxxx.cn/pay_callback',
        'out_trade_no' => '202051225779',
        'scene_info' => '{"h5_info": {"type":"IOS","app_name": "测试","bundle_id": "com.tencent.wzryIOS"}}',
        'total_fee' => 1 , //分
]);

var_dump($result_h5);

#查询订单状态：建议优先使用transaction_id，当然也可以使用out_trade_no（商户内部自定义的商品ID）
$result_query = $h5->orquery([
    'transaction_id' => 'dy_13403007360239616',
]);
var_dump($result_query);

```

##### JSAPI支付

```php
$jsapi = new JsapiTrade([
    'appid' => 'wxb829xxxxxxxxf5',
    'mch_id' => '10xxxxx',
    'key' => '3phqOIxxxxxxx913ZpEskN',
]);

$resultJsapi = $jsapi->unified([
    'body' => '测试-充值测试',
    'notify_url' => 'https://pay.skinrun.cn/pay_callback',
    'out_trade_no' => '202054541484',
    'total_fee' => 1,
    'openid' => 'oTrN9t1gi91ER6k98_Wv7E1W1jeA', //JSAPI支付必传参数
]);

var_dump($resultJsapi);
```

+ NATIVE

> 模式一


> 模式二
商户后台系统将code_url值生成二维码图片，用户使用微信客户端扫码后发起支付。code_url有效期为2小时，过期后扫码不能再发起支付
```php
array(10) {
  ["return_code"]=>
  string(7) "SUCCESS"
  ["return_msg"]=>
  string(2) "OK"
  ["appid"]=>
  string(18) "wxb829f31ecd32bdf5"
  ["mch_id"]=>
  string(8) "10037582"
  ["nonce_str"]=>
  string(16) "0TlM3wQrg32GAx0a"
  ["sign"]=>
  string(32) "4DB1D0F8FD4F343BB4E198C0F1835741"
  ["result_code"]=>
  string(7) "SUCCESS"
  ["prepay_id"]=>
  string(36) "wx21180541954546288e9eff191044490400"
  ["trade_type"]=>
  string(6) "NATIVE"
  ["code_url"]=>
  string(35) "weixin://wxpay/bizpayurl?pr=a97pITx"
}


```
