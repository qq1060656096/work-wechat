<?php
namespace Zwei\WorkWechat;


class SuiteHelper
{
    protected static $cacheKeyPrefix = 'crm_qywx';

    /**
     * 获取缓存键前缀
     * @return string
     */
    public function getCacheKeyPrefix() {
        return self::$cacheKeyPrefix;
    }

    public static function arrayToKey(array $array) {
        return implode('_', $array);
    }

    /**
     * 获取 suite_access_token 缓存键
     * @param string $appName
     * @return array|string
     */
    public static function getSuiteAccessTokenCacheKey($appName) {
        $key = [
            self::getCacheKeyPrefix(),
            $appName,
            'suite_access_token'
        ];
        $key = implode('_', $key);
        return $key;
    }

    /**
     * 获取 suite_ticket 缓存键
     * @param string $appName
     * @return array|string
     */
    public function getSuiteTicketCacheKey($appName) {
        $key = [
            self::getCacheKeyPrefix(),
            $appName,
            'suite_ticket'
        ];
        $key = implode('_', $key);
        return $key;
    }

}