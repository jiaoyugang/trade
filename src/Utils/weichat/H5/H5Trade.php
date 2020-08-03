<?php declare(strict_types = 1);
namespace Kongflower\Pay\Utils\Weichat\H5;

use Kongflower\Pay\Utils\Weichat\Weichat;

class H5Trade extends Weichat
{
    /**
     * 初始化对象
     * @param  array $requestBody
     */
    public function __construct(array $requestBody)
    {
        if(!isset($requestBody['key']) || empty($requestBody['key'])){
            throw new \Kongflower\Pay\Exception\WxPayException('keys为空');
        }

        if(!isset($requestBody['appid']) || empty($requestBody['appid'])){
            throw new \Kongflower\Pay\Exception\WxPayException('appid为空');
        }

        if(!isset($requestBody['mch_id']) || empty($requestBody['mch_id'])){
            throw new \Kongflower\Pay\Exception\WxPayException('商户mch_id为空');
        }

        $this->config['appid']  =  $requestBody['appid']; //微信公众账号ID
        $this->config['mch_id'] =  $requestBody['mch_id']; //微信商户号
        $this->config['key']    =  $requestBody['key']; //加密字符串
    }

    /** 
     * 统一下单
     * @param array $requestBody
     * @return  array
     * */
    public function unified($requestBody): array
    {
        return $this->unifiedOrder($requestBody);
    }

    /** 
     * 查询订单
     * @param  string  appid            微信开放平台审核通过的应用APPID
     * @param  string  mch_id           微信支付分配的商户号
     * @param  string  transaction_id   微信的订单号，优先使用
     * @param  string  out_trade_no     商户系统内部的订单号，当没提供transaction_id时需要传这个
     * @param  string  nonce_str        随机字符串，不长于32位。
     * @param  string  sign             签名
     * @return array
     */
    public function orquery($requestBody): array
    {
        return $this->orderquery($requestBody);
    }

    /**
     * 关闭订单
     * @param  string  out_trade_no     商户系统内部的订单号
     * @return array
     */
    public function close($requestBody): array
    {
        return $this->closeorder($requestBody);
    }
}
