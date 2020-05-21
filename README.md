# mini_paylib
抖音、支付宝，微信支  
## 微信支付

+ MWEB支付

```php
array(10) {
    ["return_code"]=>
    string(7) "SUCCESS"
    ["return_msg"]=>
    string(2) "OK"
    ["appid"]=>
    string(18) "wxb829xxxx32ssf5"
    ["mch_id"]=>
    string(8) "1854452"
    ["nonce_str"]=>
    string(16) "6Wfk9qz1CZygrbUn"
    ["sign"]=>
    string(32) "8FF0813B2494EDA276C17A10E7E185E8"
    ["result_code"]=>
    string(7) "SUCCESS"
    ["prepay_id"]=>
    string(36) "wx21170623963880696eefb5c91259572500"
    ["trade_type"]=>
    string(4) "MWEB"
    ["mweb_url"]=>
    string(118) "https://wx.tenpay.com/cgi-bin/mmpayweb-bin/checkmweb?prepay_id=wx21170623963880696eefb5c91259572500&package=2877554408"
}

```

+ JSAPI支付

```php
array(9) {
  ["return_code"]=>
  string(7) "SUCCESS"
  ["return_msg"]=>
  string(2) "OK"
  ["appid"]=>
  string(18) "wxb829f31ecd32bdf5"
  ["mch_id"]=>
  string(8) "10037582"
  ["nonce_str"]=>
  string(16) "eh5MkYBCkYy6kXlv"
  ["sign"]=>
  string(32) "0061F2F696E9E2DBC3BBCB270755369E"
  ["result_code"]=>
  string(7) "SUCCESS"
  ["prepay_id"]=>
  string(36) "wx21174147282801c83d84b10e1499748400"
  ["trade_type"]=>
  string(5) "JSAPI"
}
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
