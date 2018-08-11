<?php
namespace Zwei\WorkWechat\Suites;



/**
 * 企业微信Suite
 *
 * Class Suite
 * @package Zwei\WorkWechat
 */
class Suite1
{
    /**
     * @var Client
     */
    protected $serviceCorpAPI = null;

    /**
     * Suite constructor.
     * @param string $suiteId
     * @param string $suiteSecret
     * @param string $suiteTicket
     */
    public function __construct($suiteId, $suiteSecret, $suiteTicket)
    {
        $serviceCorpAPI = new ServiceCorpAPI(
            $suiteId,
            $suiteSecret,
            $suiteTicket
        );
        $this->serviceCorpAPI = $serviceCorpAPI;
    }

    /**
     *
     * 获取第三方应用凭证
     *
     *
     * @return array [suite_access_token, expires_in]
     */
    public function getSuiteAccessToken() {

        $suiteAccessToken = $this->serviceCorpAPI->getSuiteAccessToken();
        $expiresIn = 7200;
        return [$suiteAccessToken, $expiresIn];
    }

    /**
     * 获取预授权码
     *
     * @param string $suiteAccessToken 第三方应用凭证
     * @return string
     */
    public function getPreAuthCode($suiteAccessToken) {
        $preAuthCode = $this->serviceCorpAPI->setSuiteAccessToken($suiteAccessToken)->GetPreAuthCode();
        return $preAuthCode;
    }

    /**
     * 获取企业永久授权码
     *
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $authCode 临时授权码，会在授权成功时附加在redirect_uri中跳转回第三方服务商网站，或通过回调推送给服务商
     * @return string
     */
    public function getPermanentCode($suiteAccessToken, $authCode) {
        $this->serviceCorpAPI->setSuiteAccessToken($suiteAccessToken);
        $permanentCode = $this->serviceCorpAPI->GetPermanentCode($authCode);
        return $permanentCode;
    }
}