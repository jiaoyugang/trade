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
}