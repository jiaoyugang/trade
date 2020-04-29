<?php declare(strict_types = 1);
namespace Kongflower\Pay\Contract;

use Kongflower\Pay\Exception\WxPayException;
use Kongflower\Pay\Utils\WxPayConfig;

/**
 * 请求参数验证
 */
class WxValidate
{
    protected $body = array();

    /**
     * 
     * 
     */
    public function __construct($valiData)
    {
        $this->body = $valiData;
    }

    /**
     * 验证支付参数参数
     * 
     */
    public function validate_param($body)
    {
        //所有支付接口必传参数
        if( !isset($this->body['appid']) || empty($this->body['appid']) ) {
			throw new WxPayException("缺少统一支付接口必填参数appid！");
		}elseif( !isset($this->body['mch_id']) || empty($this->body['mch_id']) ){
			throw new WxPayException("缺少统一支付接口必填参数mch_id！");
		}elseif( !isset($this->body['nonce_str']) || empty($this->body['nonce_str']) ) {
			throw new WxPayException("缺少统一支付接口必填参数nonce_str！");
		}elseif( !isset($this->body['body']) || empty($this->body['body']) ) {
			throw new WxPayException("缺少统一支付接口必填参数body！");
		}elseif( !isset($this->body['out_trade_no']) || empty($this->body['out_trade_no']) ){
            throw new WxPayException("缺少统一支付接口必填参数out_trade_no！");
        }elseif( !isset($this->body['total_fee']) || empty($this->body['total_fee']) ){
            throw new WxPayException("缺少统一支付接口必填参数total_fee！");
        }elseif( !isset($this->body['spbill_create_ip']) || empty($this->body['spbill_create_ip']) ){
            throw new WxPayException("缺少统一支付接口必填参数spbill_create_ip！");
        }elseif( !isset($this->body['notify_url']) || empty($this->body['notify_url']) ){
            throw new WxPayException("缺少统一支付接口必填参数notify_url！");
        }elseif( !isset($this->body['trade_type']) || empty($this->body['trade_type']) ){
            throw new WxPayException("缺少统一支付接口必填参数trade_type！");
        }
        //H5支付
        //WAP网站应用
        if($this->body['trade_type'] == WxPayConfig::PAY_H5){
            if( !isset($this->body['scene_info']) || empty($this->body['scene_info']) ){
                throw new WxPayException("缺少统一支付接口必填参数trade_type！");
            }
        }
        // JSAPI支付:
        // PC网页或公众号内支付请传"WEB"
        if($this->body['trade_type'] == WxPayConfig::PAY_MINI){
            if( !isset($this->body['device_info']) || empty($this->body['device_info']) ){
                throw new WxPayException("缺少统一支付接口必填参数device_info！");
            }
        }

    }

    /**
     * 检测支付类型，判断场景信息参数是否为空（H5支付为必传参数）
     */
    public function checkTradeType($trade_type)
    {
        $type = '';
        if(WxPayConfig::PAY_H5 == $trade_type){
             
        }elseif(WxPayConfig::PAY_CODE == $trade_type){
            
        }elseif(WxPayConfig::PAY_MINI == $trade_type){
            
        }elseif(WxPayConfig::PAY_MINI == $trade_type){
            
        }
    }

    
}