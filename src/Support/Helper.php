<?php declare(strict_types = 1);
namespace Kongflower\Pay\Support;

use Kongflower\Pay\Exception\WxPayException;

final class Helper
{
      /**
     * @author kongflower <18838952961@163.com>
     * 
     * Xml string to array
     * @param string $xmlString
     * @return array $data
     */
    public static function toArray(string $xmlString) : array
    {
        if (!$xmlString) {
            throw new WxPayException('Convert To Array Error! Invalid Xml!');
        }

        if (!$xmlString) {
            throw new WxPayException('Convert To Array Error! Invalid Xml!');
        }

        libxml_disable_entity_loader(true);

        return json_decode(json_encode(simplexml_load_string($xmlString, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);
    }

    /**
     * @author kongflower <18838952961@163.com>
     * 
     * Array to xml string
     * @param   array   $data
     * @return  string  $xml
     */
    public static function toXml( array $data) : string
    {
        if (!is_array($data) || count($data) <= 0) {
            throw new WxPayException('Convert To Xml Error! Invalid Array!');
        }

        $xml = '<xml>';
        foreach ($data as $key => $val) {
            $xml .= is_numeric($val) ? '<'.$key.'>'.$val.'</'.$key.'>' : '<'.$key.'><![CDATA['.$val.']]></'.$key.'>';
        }
        $xml .= '</xml>';

        return $xml;
    }


    /**
     * @author kongflower <18838952961@163.com>
     * 
     * 随机字符串
     * @param   int     $length
     * @return  string  $str
     */
    public static function nonceStr(int $length = 16) : string
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= mb_substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }


    /**
     * @author kongflower <18838952961@163.com>
     * 签名
     * @param   array   array
     * @param   string  key  key设置路径：微信商户平台(pay.weixin.qq.com)-->账户设置-->API安全-->密钥设置
     * @return  string  signValue
     */
    public static function makeSign(array $params,string $key) : string
    {
        //(1) 过滤控制（参数的值为空不参与签名）
        $params = self::filterValue($params);
        //(2) 对参数按照key=value的格式，并按照参数名ASCII字典序排序如下
        ksort($params);
        $stringA = '';
        foreach ($params as $k => $v) {
            $stringA = $stringA . $k . '=' . $v . '&';
        }
        //(3) 拼接API密钥,key为商户平台设置的密钥key
        $stringSignTemp = $stringA . 'key=' . $key;
        $signValue = mb_strtoupper(md5($stringSignTemp));
        return $signValue;
    }

    /**
     * 过滤控制（参数的值为空不参与签名）
     */
    protected static function filterValue(array $params) : array
    {
        foreach ($params as $k => $v) {
            if (!$v) {
                unset($params[$k]);
            }
        }
        return $params;
    }

    

}
