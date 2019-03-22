<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-03-22
 * Time: 13:55
 */
namespace Zwei\WorkWechat\Suites;

use Zwei\WorkWechat\ApiBase;

interface ServiceProvidersApiDefineInterface
{
    /*
     * 服务商的token
     */
    const URL_GET_PROVIDER_TOKEN = "https://qyapi.weixin.qq.com/cgi-bin/service/get_provider_token";

    /**
     *
     * 获取服务商的token
     *
     * @param string $providerCorpId 服务商的corpid
     * @param string $providerSecret 服务商的secret，在服务商管理后台可见
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getProviderAccessToken($providerCorpId, $providerSecret);
}