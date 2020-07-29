<?php declare(strict_types = 1);
namespace Kongflower\Pay\Utils\Weichat\App;

use Kongflower\Pay\Contract\Condation;
use Kongflower\Pay\Contract\Wechat;
use Kongflower\Pay\Support\Helper;
use Kongflower\Pay\Support\Request;

class AppTrade implements Wechat,Condation
{
    const URL = "https://api.mch.weixin.qq.com/";
    /** 
     * 统一下单
     * @param array $requestBody
     * @return  array
     * */
    public function unifiedOrder($requestBody): array
    {
        //比传参数
        $params = [
            'appid'     => $requestBody['appid'] ?? '',    //微信公众账号ID
            'body'      => $requestBody['body'] ?? '',
            'mch_id'    => $requestBody['mch_id'] ?? '',  //微信商户号
            'nonce_str' => Helper::nonceStr(),    //32位以内随机字符
            'notify_url'    => $requestBody['notify_url'] ?? '',  //微信回调地址
            'out_trade_no'  => $requestBody['out_order_no'] ?? '', //商户订单号
            'spbill_create_ip'  => $requestBody['spbill_create_ip'] ?? Request::getRealIp(), 
            'total_fee'     => $requestBody['total_amount'],  //金额，分为单位
            'trade_type'    => self::PAY_TYPE_APP, //App支付交易类型
        ];
        
        //可选参数
        $other = [
            'device_info' => $requestBody['device_info'], //终端设备号(门店号或收银设备ID)，默认请传"WEB"
            'detail' => $requestBody['detail'] ?? '', //商品详细描述，对于使用单品优惠的商户，该字段必须按照规范上传
            'attach' => $requestBody['attach'] ?? '', //附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
            'fee_type' => $requestBody['attach'] ?? 'CNY', //货币类型
            'time_start' => $requestBody['time_start'] ?? '',
            'time_expire' => $requestBody['time_expire'] ?? '',
            'goods_tag' => $requestBody['goods_tag'] ?? '',
            'limit_pay' => $requestBody['limit_pay'] ?? '', //no_credit--指定不能使用信用卡支付
            'limit_pay' => $requestBody['limit_pay'] ?? '', //Y，传入Y时，支付成功消息和支付详情页将出现开票入口。需要在微信支付商户平台或微信公众平台开通电子发票功能，传此字段才可生效
        ];

        $params = array_merge($params,$other);
        // 组装签名
        $params['sign'] = Helper::makeSign($params,$requestBody['key']);

        //数据转为xml格式
        $pay_param = Helper::toXml($params);

        // 发送请求
        $referer = $requestBody['referer'] ?? '';
        $result = Request::post(self::URL.'pay/unifiedorder' ,$pay_param ,['referer' => $referer]);
        $result = Helper::toArray($result);
        return $params;
    }

    /** 
     * 查询订单
     * 
     */
    public function orderquery()
    {

    }

    /**
     * 关闭订单
     * 
     */
    public function closeorder()
    {

    }

    /**
     * 查询退款
     * 
     */
    public function refundquery()
    {

    }

    /**
     * 支付结果通知
     * 该链接是通过【统一下单API】中提交的参数notify_url设置，如果链接无法访问，商户将无法接收到微信通知。
     * 
     */
    public function notify($requestBody)
    {

    }
}