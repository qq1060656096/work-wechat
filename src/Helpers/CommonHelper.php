<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: drupal
 * Date: 2018-08-11
 * Time: 09:27
 */
namespace Zwei\WorkWechat\Helpers;



class CommonHelper
{
    /**
     * 删除数组中null值
     * @param array $array
     * @return array
     */
    public static function deleteArrayNullValue(array $array) {
        foreach ($array as $key => $value) {
            switch (true) {
                case is_array($value):
                    $value = self::deleteArrayNullValue($value);
                    break;
                case $value === null:
                    unset($array[$key]);
                    break;
            }
        }
        return $array;
    }

    /**
     * url中附加参数
     * @param string $url
     * @param array $params 键值数组
     * @return string
     */
    public static function urlAppendParams($url, array $params) {
        $parseUrlArr = parse_url($url);

        isset($parseUrlArr['query']) ? parse_str($parseUrlArr['query'], $queryArr) : $queryArr = [];
        $queryArr = array_merge($queryArr, $params);
        $parseUrlArr['query'] = http_build_query($queryArr);

        $scheme   = isset($parseUrlArr['scheme']) ? $parseUrlArr['scheme'] . '://' : '';
        $host     = isset($parseUrlArr['host']) ? $parseUrlArr['host'] : '';
        $port     = isset($parseUrlArr['port']) ? ':' . $parseUrlArr['port'] : '';
        $user     = isset($parseUrlArr['user']) ? $parseUrlArr['user'] : '';
        $pass     = isset($parseUrlArr['pass']) ? ':' . $parseUrlArr['pass']  : '';
        $pass     = ($user || $pass) ? "$pass@" : '';
        $path     = isset($parseUrlArr['path']) ? $parseUrlArr['path'] : '';
        $query    = isset($parseUrlArr['query']) ? '?' . $parseUrlArr['query'] : '';
        $fragment = isset($parseUrlArr['fragment']) ? '#' . $parseUrlArr['fragment'] : '';
        $newUrl = "{$scheme}{$user}{$pass}{$host}{$port}{$path}{$query}{$fragment}";
        return $newUrl;
    }

}