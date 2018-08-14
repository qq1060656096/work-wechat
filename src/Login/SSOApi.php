<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-14
 * Time: 09:00
 */

namespace Zwei\WorkWechat\Login;


use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;

class SSOApi extends ApiBase implements SSOApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function generateLoginUrl($appId, $redirectUri, $redirectUri, $userType, $state = '')
    {
        $url = sprintf(self::URL_SSO_LOGIN_URL, $appId, $redirectUri, $state, $userType);
        return $url;
    }

    /**
     * @inheritdoc
     */
    public function getUserInfo($providerAccessToken, $authCode)
    {
        $data = [
            'auth_code' => $authCode,
        ];
        $url = sprintf(self::URL_USER_INFO, $providerAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

}