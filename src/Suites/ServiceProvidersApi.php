<?php
/**
 * Created by PhpStorm.
 * User: zhaoweijie
 * Date: 2019-03-22
 * Time: 13:55
 */
namespace Zwei\WorkWechat\Suites;

use Zwei\WorkWechat\ApiBase;

/**
 * 服务商
 * Class ServiceProvidersApi
 * @package Zwei\WorkWechat\Suites
 */
class ServiceProvidersApi extends ApiBase implements ServiceProvidersApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function getProviderAccessToken($providerCorpId, $providerSecret)
    {
        $data = [
            'corpid' => $providerCorpId,
            'provider_secret' => $providerSecret,
        ];
        $url = sprintf(self::URL_GET_PROVIDER_TOKEN);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

}