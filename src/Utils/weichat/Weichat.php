<?php declare(strict_types = 1);
namespace Kongflower\Pay\Utils\Weichat;

use Kongflower\Pay\Contract\Condation;
use Kongflower\Pay\Contract\GatewayApplicationInterface;
use Kongflower\Pay\Exception\WxPayException;
use Kongflower\Pay\Support\Helper;
use Kongflower\Pay\Support\Request;

abstract class Weichat implements Condation,GatewayApplicationInterface
{

    /**
     * To pay.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string $gateway
     * @param array  $params
     *
     * @return Collection|Response
     */
    public function pay($gateway, $params)
    {
        
    }

    /**
     * Query an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function find($order, string $type)
    {
        
    }

    /**
     * Refund an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @return Collection
     */
    public function refund(array $order)
    {
        
    }

    /**
     * Cancel an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function cancel($order)
    {
        
    }

    /**
     * Close an order.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array $order
     *
     * @return Collection
     */
    public function close($order)
    {
        
    }

    /**
     * Verify a request.
     *
     * @author gang <18838952961@163.com>
     *
     * @param string|array|null $content
     *
     * @return Collection
     */
    public function verify($content, bool $refund)
    {
        
    }

    /**
     * Echo success to server.
     *
     * @author gang <18838952961@163.com>
     *
     * @return Response
     */
    public function success()
    {
        
    }


    /**
     * 支付配置参数
     */
    protected $config = [];

    /** 
     * 统一下单
     * @param  array  $requestBody
     * @return array
     * */
    public function unifiedOrder(array $requestBody): array
    {
        //所有支付方式共同必传参数
        $params = [
            'body'      => $requestBody['body'] ?? '',
            'nonce_str' => Helper::nonceStr() ?? uniqid(),    //32位以内随机字符
            'notify_url'    => $requestBody['notify_url'] ?? '',  //微信回调地址
            'out_trade_no'  => $requestBody['out_trade_no'] ?? '', //商户订单号
            'spbill_create_ip'  => $requestBody['spbill_create_ip'] ?? Request::getRealIp(), 
            'total_fee'     => $requestBody['total_fee'] ?? '',  //金额，分为单位
            // 'trade_type'    => $requestBody['trade_type'] ?? '', //App支付交易类型
        ];
        
        //可选参数
        $other = [
            'device_info' => $requestBody['device_info'] ?? '', //终端设备号(门店号或收银设备ID)，默认请传"WEB"
            'sign_type' => $requestBody['sign_type'] ?? '',  //签名类型，目前支持HMAC-SHA256和MD5，默认为MD5
            'detail' => $requestBody['detail'] ?? '', //商品详细描述，对于使用单品优惠的商户，该字段必须按照规范上传
            'attach' => $requestBody['attach'] ?? '', //附加数据，在查询API和支付通知中原样返回，该字段主要用于商户携带订单的自定义数据
            'fee_type' => $requestBody['fee_type'] ?? '', //货币类型
            'time_start' => $requestBody['time_start'] ?? '',
            'time_expire' => $requestBody['time_expire'] ?? '',
            'goods_tag' => $requestBody['goods_tag'] ?? '',
            'limit_pay' => $requestBody['limit_pay'] ?? '', //no_credit--指定不能使用信用卡支付
            'receipt' => $requestBody['receipt'] ?? '', //Y，传入Y时，支付成功消息和支付详情页将出现开票入口。需要在微信支付商户平台或微信公众平台开通电子发票功能，传此字段才可生效
            'scene_info' => $requestBody['scene_info'] ?? '', //该字段用于上报支付的场景信息,针对H5支付有以下三种场景,请根据对应场景上报,H5支付不建议在APP端使用，针对场景1，2请接入APP支付，不然可能会出现兼容性问题
            'product_id' => $requestBody['product_id'] ?? '', //trade_type=NATIVE，此参数必传。此id为二维码中包含的商品ID，商户自行定义
            'openid' => $requestBody['openid'] ?? '', //trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。openid如何获取，可参考【获取openid】。企业号请使用【企业号OAuth2.0接口】获取企业号内成员userid，再调用【企业号userid转openid接口】进行转换
        ];

        $params = array_merge($this->config ,$params,$other);
        // var_dump($params);exit;
        return $this->send($params,'pay/unifiedorder');
    }

    /**
     * 查询订单
     * @param  array  $requestBody
     * @return array
     */
    public function orderquery(array $requestBody): array
    {
        if(!array_key_exists('transaction_id' ,$requestBody) && !array_key_exists('out_trade_no' ,$requestBody)){
            throw new WxPayException('请传入微信的订单号或商户系统内部的订单号');
        }elseif(empty($requestBody['out_trade_no']) && empty($requestBody['transaction_id'])){
            throw new WxPayException('请传入微信的订单号或商户系统内部的订单号');
        }elseif(empty($requestBody['out_trade_no']) && !empty($requestBody['transaction_id'])){
            $params['transaction_id'] = $requestBody['transaction_id'];
        }elseif(empty($requestBody['transaction_id']) && !empty($requestBody['out_trade_no'])){
            $params['out_trade_no'] = $requestBody['out_trade_no'];
        }
        $params['nonce_str'] = Helper::nonceStr();    //32位以内随机字符
        $params = array_merge($this->config ,$params);
        return $this->send($params,'pay/unifiedorder');
    }

    /**
     * 关闭订单
     * 
     */
    public  function closeorder(array $requestBody): array
    {
        if(!array_key_exists('out_trade_no' ,$requestBody)){
            throw new WxPayException('商户系统内部的订单号');
        }
        if(empty($requestBody['transaction_id']) && !empty($requestBody['out_trade_no'])){
            $params['out_trade_no'] = $requestBody['out_trade_no'];
        }
        $params['nonce_str'] = Helper::nonceStr();    //32位以内随机字符
        $params = array_merge($this->config ,$params);
        return $this->send($params,'pay/closeorder');
    }

    /**
     * 发送请求
     * @param array  $data
     * @param string $endpaint
     */
    protected function send($data,$endpaint)
    {
        $wxData = Helper::filterValue($data);
        // 组装签名
        unset($wxData['key']);
        $wxData['sign'] = Helper::makeSign($wxData,$this->config['key']);
        
        //数据转为xml格式
        $pay_param = Helper::toXml($wxData);
        
        // 发送请求
        $referer = $requestBody['referer'] ?? '';
        $result = Request::post(self::URL.$endpaint ,$pay_param ,['referer' => $referer]);
        $result = Helper::toArray($result);
        return $result;
    }
}