<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 07:41
 */

namespace Zwei\WorkWechat\Suites;

use Zwei\WorkWechat\ApiBase;
use Zwei\WorkWechat\Login\Oauth2LoginUrlParams;

/**
 * 企业微信服务商api
 *
 * Class SuiteApi
 * @package Zwei\WorkWechat\Suites
 */
class SuiteApi extends ApiBase implements SuiteApiDefineInterface
{

    /**
     * @inheritdoc
     */
    public function getSuiteAccessToken($suiteId, $suiteSecret, $suiteTicket)
    {
        $data = [
            'suite_id'      => $suiteId,
            'suite_secret'  => $suiteSecret,
            'suite_ticket'  => $suiteTicket,
        ];
        $url = self::URL_SUITE_ACCESS_TOKEN;
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getPreAuthCode($suiteAccessToken)
    {
        $url = sprintf(self::URL_PRE_AUTH_CODE, $suiteAccessToken);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function setPreAuthCodeConfig($suiteAccessToken, $preAuthCode, array $appIds, $authType = 0)
    {
        $data = [
            'pre_auth_code' => $preAuthCode,
            'session_info'  => [
                'appid'         => $appIds,
                'auth_type'     => $authType,
            ],
        ];
        $url = sprintf(self::URL_SET_PRE_AUTH_CODE, $suiteAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getPermanentCode($suiteAccessToken, $authCode)
    {
        $data = [
            'auth_code' => $authCode,
        ];
        $url = sprintf(self::URL_PRE_AUTH_CODE, $suiteAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getAuthInfo($suiteAccessToken, $corpId, $permanentCode) {
        $data = [
            'auth_corpid' => $corpId,
            'permanent_code' => $permanentCode,
        ];
        $url = sprintf(self::URL_AUTH_INFO, $suiteAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getCorpToken($suiteAccessToken, $corpId, $permanentCode)
    {
        $data = [
            'auth_corpid' => $corpId,
            'permanent_code' => $permanentCode,
        ];
        $url = sprintf(self::URL_CORP_TOKEN, $suiteAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getAdminList($suiteAccessToken, $corpId, $agentId)
    {

        $data = [
            'auth_corpid' => $corpId,
            'agentid' => $agentId,
        ];
        $url = sprintf(self::URL_ADMIN_LIST, $suiteAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getUserInfo($suiteAccessToken, $code)
    {
        $url = sprintf(self::URL_USER_INFO, $suiteAccessToken, $code);
        $response = $this->client->request('GET', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function getUserDetail($suiteAccessToken, $userTicket)
    {
        $data = [
            'user_ticket' => $userTicket,
        ];
        $url = sprintf(self::URL_ADMIN_LIST, $suiteAccessToken);
        $response = $this->client->request('POST', $url, [
            'verify' => $this->sslVerify,
            'json' => $data,
        ]);
        return $this->parseApiResult($response);
    }

    /**
     * @inheritdoc
     */
    public function generateOauth2LoginUrl($suiteId, $redirectUri, Oauth2LoginUrlParams $oauth2LoginUrlParam = null)
    {
        $scope = empty($oauth2LoginUrlParam) || empty($oauth2LoginUrlParam->scope) ? '' :  $oauth2LoginUrlParam->scope;
        $state = empty($oauth2LoginUrlParam) || empty($oauth2LoginUrlParam->state) ? '' :  $oauth2LoginUrlParam->state;
        $url = sprintf(self::URL_OAUTH2_LOGIN_URL, $suiteId, $redirectUri, $scope, $state);
        return $url;
    }

    /**
     * @inheritdoc
     */
    public function generateAppInstallUrl($suiteId, $preAuthCode, $redirectUri, $state = '') {
        $url = sprintf(self::URL_APP_INSTALL, $suiteId, $preAuthCode, $redirectUri, $state);
        return $url;
    }
}