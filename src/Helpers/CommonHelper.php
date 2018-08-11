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

}