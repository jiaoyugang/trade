<?php declare(strict_types = 1);
namespace Kongflower\Pay\Utils\weichat;

use Kongflower\Pay\Exception\WxPayException;
use Kongflower\Pay\Support\Helper;
use Kongflower\Pay\Support\Request;

class Validate
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
			throw new WxPayException("缺少统一支付接口必填参数appid\n");
		}elseif( !isset($this->body['mch_id']) || empty($this->body['mch_id']) ){
			throw new WxPayException("缺少统一支付接口必填参数mch_id\n");
		}elseif( !isset($this->body['body']) || empty($this->body['body']) ) {
			throw new WxPayException("缺少统一支付接口必填参数body\n");
		}elseif( !isset($this->body['out_trade_no']) || empty($this->body['out_trade_no']) ){
            throw new WxPayException("缺少统一支付接口必填参数out_trade_no\n");
        }elseif( !isset($this->body['total_fee']) || empty($this->body['total_fee']) ){
            throw new WxPayException("缺少统一支付接口必填参数total_fee\n");
        }elseif( !isset($this->body['notify_url']) || empty($this->body['notify_url']) ){
            throw new WxPayException("缺少统一支付接口必填参数notify_url\n");
        }elseif( !isset($this->body['trade_type']) || empty($this->body['trade_type']) ){
            throw new WxPayException("缺少统一支付接口必填参数trade_type\n");
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
            case WxPay::PAY_H5:
                if( !isset($this->body['scene_info']) || empty($this->body['scene_info']) ){
                    throw new WxPayException("缺少统一支付接口必填参数scene_info\n");
                }
                break;
            //app支付
            case WxPay::PAY_APP:

                break;
            // Native支付
            case WxPay::PAY_CODE:
                if( !isset($this->body['product_id']) || empty($this->body['product_id']) ){
                    throw new WxPayException("缺少统一支付接口必填参数product_id\n");
                }

                break;

            // JSAPI支付（或小程序支付）
            case WxPay::PAY_MINI:
                // 微信支付用户openid
                if( !isset($this->body['openid']) || empty($this->body['openid']) ){
                    throw new WxPayException("缺少统一支付接口必填参数openid\n");
                }
                break;
            // 付款码支付,付款码支付有单独的支付接口，所以接口不需要上传，该字段在对账单中会出现
            default:
                
                break;
        }
    }

    
}