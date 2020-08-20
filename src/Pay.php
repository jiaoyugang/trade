<?php
namespace Kongflower\Pay;

use Kongflower\Pay\Exception\WxPayException;

class Pay
{
    /**
     * @param [type] 支付对象
     * @param [type] 参数
     * @return void
     */
    public static function __callStatic($method, $arguments)
    {
        $gateway = __NAMESPACE__.'\\Utils\\Weichat\\'.ucfirst($method);
        if(!class_exists($gateway)){
            throw new WxPayException('仅支持微信(Weichat)或支付宝支付(Alipay)');
        }
        return (new $gateway());
        // var_dump($gateway, $arguments[0]);
    }
}