<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 21:18
 */

namespace Zwei\WorkWechat\Cache;

/**
 * 应用换存key
 *
 * Class AppCacheKey
 * @package Zwei\WorkWechat\Cache
 */
class AppCacheKey
{
    /**
     * 缓存键前缀
     * @var string
     */
    protected static $cacheKeyPrefix = 'crm_qywx';

    /**
     * 获取缓存键前缀
     * @return string
     */
    public static function getCacheKeyPrefix() {
        return self::$cacheKeyPrefix;
    }

    /**
     * 获取 suite_ticket 缓存键
     * @param string $appName 应用名(唯一)
     * @return string
     */
    public static function getSuiteTicket($appName) {
        $key = [
            self::getCacheKeyPrefix(),
            $appName,
            'suite_ticket'
        ];
        return self::generateKey($key);
    }

    /**
     * 获取 suite_access_token 缓存键
     * @param string $appName 应用名(唯一)
     * @return string
     */
    public static function getSuiteAccessToken($appName) {
        $key = [
            self::getCacheKeyPrefix(),
            $appName,
            'suite_access_token'
        ];
        return self::generateKey($key);
    }

    /**
     * 获取企业access_token
     *
     * @param string $appName 应用名(唯一)
     * @return string
     */
    public static function getCorpAccessToken($appName) {
        $key = [
            self::getCacheKeyPrefix(),
            $appName,
            'corp_access_token'
        ];
        return self::generateKey($key);
    }

    /**
     * 获取 permanent_code 缓存键
     * @param string $appName 应用名(唯一)
     * @return string
     */
    public static function getPermanentCode($appName) {
        $key = [
            self::getCacheKeyPrefix(),
            $appName,
            'permanent_code'
        ];
        return self::generateKey($key);
    }

    /**
     * 生成key
     * @param array $arr
     * @return string
     */
    public static function generateKey(array $arr) {
        $key = implode('_', $arr);
        return $key;
    }
}