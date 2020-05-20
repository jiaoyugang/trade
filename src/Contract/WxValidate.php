<?php declare(strict_types = 1);
namespace Kongflower\Pay\Contract;

use Kongflower\Pay\Exception\WxPayException;
use Kongflower\Pay\Support\Helper;
use Kongflower\Pay\Support\Request;
use Kongflower\Pay\Utils\WxPayConfig;

/**
 * 请求参数验证
 */
class WxValidate
{
    protected $body = array();

    /**
     * 初始化
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
    public function validate_param()
    {
        //所有支付接口必传参数
        if( !isset($this->body['appid']) || empty($this->body['appid']) ) {
			throw new WxPayException("缺少统一支付接口必填参数appid！");
		}elseif( !isset($this->body['mch_id']) || empty($this->body['mch_id']) ){
			throw new WxPayException("缺少统一支付接口必填参数mch_id！");
		}elseif( !isset($this->body['body']) || empty($this->body['body']) ) {
			throw new WxPayException("缺少统一支付接口必填参数body！");
		}elseif( !isset($this->body['out_trade_no']) || empty($this->body['out_trade_no']) ){
            throw new WxPayException("缺少统一支付接口必填参数out_trade_no！");
        }elseif( !isset($this->body['total_fee']) || empty($this->body['total_fee']) ){
            throw new WxPayException("缺少统一支付接口必填参数total_fee！");
        }elseif( !isset($this->body['notify_url']) || empty($this->body['notify_url']) ){
            throw new WxPayException("缺少统一支付接口必填参数notify_url！");
        }elseif( !isset($this->body['trade_type']) || empty($this->body['trade_type']) ){
            throw new WxPayException("缺少统一支付接口必填参数trade_type！");
        }
        $this->body['nonce_str'] = Helper::nonceStr();
        $this->body['spbill_create_ip'] = Request::getRealIp();
        $this->checkTradeType($this->body['trade_type']);
        return $this->body;
    }

    /**
     * 检测支付类型
     */
    public function checkTradeType($trade_type)
    {
        switch($trade_type){
            //H5支付
            case WxPayConfig::PAY_H5:
                if( !isset($this->body['scene_info']) || empty($this->body['scene_info']) ){
                    throw new WxPayException("缺少统一支付接口必填参数trade_type！");
                }
                break;
            //app支付
            case WxPayConfig::PAY_APP:

                break;
            // Native支付
            case WxPayConfig::PAY_CODE:

                break;
            // JSAPI支付（或小程序支付）
            case WxPayConfig::PAY_MINI:
                if( !isset($this->body['device_info']) || empty($this->body['device_info']) ){
                    throw new WxPayException("缺少统一支付接口必填参数device_info！");
                }
                break;
            // 付款码支付,付款码支付有单独的支付接口，所以接口不需要上传，该字段在对账单中会出现
            default:
                
                break;
        }
    }

    
}