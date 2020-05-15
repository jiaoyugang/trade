<?php declare(strict_types = 1);
namespace Kongflower\Pay\Support;

use Kongflower\Pay\Exception\WxPayException;

class Helper
{
      /**
     * @author kongflower <18838952961@163.com>
     * 
     * xml string to array
     * @param string $xmlString
     * @return array $data
     */
    public static function toArray(string $xmlString): array
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
     * array to xml string
     * @param   array   $data
     * @return  string  $xml
     */
    public static function toXml( array $data): string
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

    public function genderSign()
    {
        
    }
}
