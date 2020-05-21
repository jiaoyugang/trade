<?php declare(strict_types = 1);
namespace Kongflower\Pay\Contract;

/**
 * 
 * 微信支付接口类
 * 
 */
interface WxInterface
{
    /** 
     * 统一下单 
     * 
     * */
    public static function unifiedOrder($requestBody);

    /** 
     * 查询订单
     * 
     */
    public static function orderquery();

    /**
     * 关闭订单
     * 
     */
    public static function closeorder();

    /**
     * 申请退款
     * 
     */
    public static function refund();

    /**
     * 查询退款
     * 
     */
    public static function refundquery();

    /**
     * 支付结果通知
     * 该链接是通过【统一下单API】中提交的参数notify_url设置，如果链接无法访问，商户将无法接收到微信通知。
     * 
     */
    public static function notify($requestBody);

    /**
     * 企业付款到个人
     * 
     */
    public static function transfers();

}