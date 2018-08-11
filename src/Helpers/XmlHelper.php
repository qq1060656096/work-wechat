<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: drupal
 * Date: 2018-08-11
 * Time: 09:27
 */
namespace Zwei\WorkWechat\Helpers;

/**
 * xml操作
 *
 * Class XmlHelper
 * @package Zwei\WorkWechat
 */
class XmlHelper
{
    /**
     * xml转数组
     *
     * @param string $xml
     * @return mixed
     */
    public static function xmlToArray($xml) {
        //禁止引用外部xml实体, 防止xml攻击
        libxml_disable_entity_loader(true);
        $obj    = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $array  = json_decode(json_encode($obj),true);
        return $array;
    }

    /**
     * 数组转xml
     *
     * @param array $array
     * @return string
     */
    public static function arrayToXml(array $array)
    {
        $xml = "<xml>";
        foreach ($array as $key => $val)
        {
            if (is_numeric($val)){
                $xml.= sprintf('<%s>%s</%s>', $key, $val, $key);
            }else{
                $xml.= sprintf('<%s><![CDATA[%s]]></%s>', $key, $val, $key);
            }
        }
        $xml.="</xml>";
        return $xml;
    }
}