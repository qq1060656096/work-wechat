<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 08:02
 */

namespace Zwei\WorkWechat\Suites;

use GuzzleHttp\Client;
use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;
use Zwei\WorkWechat\Login\Oauth2LoginUrlParams;

/**
 * 企业微信服务商api 抽象
 *
 * Class SuiteApiAbstract
 * @package Zwei\WorkWechat\Suites
 */
abstract class SuiteApiAbstract implements SuiteApiDefineInterface
{
    /**
     * @var Client
     */
    protected $client = null;

    /**
     * 构造方法
     * SuiteAbstract constructor.
     */
    public function __construct() {
        $this->init();
    }

    /**
     * 初始化
     */
    public function init() {
        $this->client = new Client();
    }

    /**
     * 解析企业微信api返回结果
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return array 成功返回数组, 失败会抛出异常
     * @throws WorkWechatApiErrorCodeException
     */
    public function parseApiResult($response) {
        $content    = $response->getBody()->getContents();
        $arr        = json_decode($content, true);
        if ($arr['errcode'] != 0) {
            throw new WorkWechatApiErrorCodeException($arr['errmsg'], $arr['errcode']);
        }
        return $arr;
    }

    /**
     * @inheritdoc
     */
    public function getSuiteAccessToken($suiteId, $suiteSecret, $suiteTicket)
    {
        // TODO: Implement getSuiteAccessToken() method.
    }

    /**
     * @inheritdoc
     */
    public function getPreAuthCode($suiteAccessToken)
    {
        // TODO: Implement getPreAuthCode() method.
    }

    /**
     * @inheritdoc
     */
    public function setPreAuthCodeConfig($suiteAccessToken, $preAuthCode, array $appIds, $authType = 0)
    {
        // TODO: Implement setPreAuthCodeConfig() method.
    }

    /**
     * @inheritdoc
     */
    public function getPermanentCode($suiteAccessToken, $authCode)
    {
        // TODO: Implement getPermanentCode() method.
    }

    /**
     * @inheritdoc
     */
    public function getCorpToken($suiteAccessToken, $corpid, $permanentCode)
    {
        // TODO: Implement getCorpToken() method.
    }

    /**
     * @inheritdoc
     */
    public function getUserInfo($accessToken, $code)
    {
        // TODO: Implement getUserInfo() method.
    }

    /**
     * @inheritdoc
     */
    public function getUserDetail($accessToken, $userTicket)
    {
        // TODO: Implement getUserDetail() method.
    }

    /**
     * @inheritdoc
     */
    public function generateOauth2LoginUrl($suiteId, $redirectUri, Oauth2LoginUrlParams $oauth2LoginUrlParam = null)
    {
        // TODO: Implement generateOauth2LoginUrl() method.
    }

}