<?php
namespace Kongflower\Pay\Utils\Weichat;

use Kongflower\Pay\Contract\WxInterface;

class WxApi implements WxInterface
{

    protected $url = 'https://api.mch.weixin.qq.com/';
    
    /** 
     * 统一下单
     * 
     * */
    public function unifiedOrder($requestBody)
    {
        
    }

    /**
     * 查询订单
     */
    public function orderquery()
    {

    }

    /**
     * 关闭订单
     */
    public function closeorder()
    {

    }

    /**
     * 退款
     */
    public function refund()
    {

    }

    /**
     * 查询退款
     */
    public function refundquery()
    {

    }

    /**
     * 支付结果回调通知
     */
    public function notify()
    {

    }

    /**
     * 企业付款到个人
     */
    public function transfers()
    {

    }
}