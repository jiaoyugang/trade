<?php
namespace Kongflower\Pay;

use Kongflower\Pay\Exception\WxPayException;

class Pay
{

    /**
     * 支付配置参数初始化
     *
     * @var array
     */
    protected $config;
    
    /**
     * 初始化支付配置信息
     */
    public function __construct($config)
    {   
        $this->config = $config;
    }

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
        var_dump($method, $arguments[0]);
    }
}