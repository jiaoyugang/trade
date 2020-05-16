<?php
namespace Kongflower\Pay\Utils\Weichat;

use Kongflower\Pay\Contract\WxInterface;
use Kongflower\Pay\Contract\WxValidate;
use Kongflower\Pay\Support\Helper;
use Kongflower\Pay\Support\Request;
use Kongflower\Pay\Utils\WxPayConfig;

class WxApi implements WxInterface
{

    protected $url = 'https://api.mch.weixin.qq.com/';
    
    protected $requestObj;

    /**
     * 初始化参数
     */
    public function __construct($requestBody)
    {
        $this->requestObj = new WxValidate($requestBody);
    }

    /** 
     * 统一下单
     * 
     * */
    public function unifiedOrder()
    {
        try{
            $requestBody = $this->requestObj->validate_param();
            // 组装签名
            $requestBody['sign'] = Helper::makeSign($requestBody,$requestBody['key']);
            //数据转为xml格式
            $pay_param = Helper::toXml($requestBody);
            // 发送请求
            $result = Request::post($this->url.WxPayConfig::PAY_UNIFIED_ORDER , $pay_param);
            //返回请求结果
            return Helper::toArray($result);
        }catch(\Exception $exc){
            var_dump($exc->getMessage());
            exit;
        }
        
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