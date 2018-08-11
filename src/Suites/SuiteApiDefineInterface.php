<?php
/**
 * Created byPhpStorm.
 *
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 08:35
 */

namespace Zwei\WorkWechat\Suites;

use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;
use Zwei\WorkWechat\Login\Oauth2LoginUrlParam;

/**
 * 企业微信服务商api
 *
 * @link https://work.weixin.qq.com/api/doc#10975
 *
 * Interface SuiteApiDefineInterface
 * @package Zwei\WorkWechat\Suites
 */
interface SuiteApiDefineInterface
{
    /**
     * 获取企业access_token
     * 请求方式：POST
     * @var string
     */
    const URL_SUITE_ACCESS_TOKEN = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_suite_token';

    /**
     * 获取预授权码
     * 请求方式：GET
     * @var string
     */
    const URL_PRE_AUTH_CODE = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_pre_auth_code?suite_access_token=%s';

    /**
     * 设置授权配置
     * 请求方式：POST
     * @var string
     */
    const URL_SET_PRE_AUTH_CODE = 'https://qyapi.weixin.qq.com/cgi-bin/service/set_session_info?suite_access_token=%s';

    /**
     * 获取企业永久授权码
     * 请求方式：POST
     * @var string
     */
    const URL_PERMANENT_CODE = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_permanent_code?suite_access_token=%s';

    /**
     * 获取企业授权信息
     * 请求方式：POST
     * @var string
     */
    const URL_AUTH_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_auth_info?suite_access_token=%s';

    /**
     * 获取企业 access_token
     *
     * 请求方式：POST
     * @var string
     */
    const URL_CORP_TOKEN = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_corp_token?suite_access_token=%s';

    /**
     * 获取应用的管理员列表
     *
     * 请求方式：POST
     * @var string
     */
    const URL_ADMIN_LIST = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_admin_list?suite_access_token=%s';


    /**
     * 网页授权登录第三方连接
     * 请求方式：GET
     */
    const URL_OAUTH2_LOGIN_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';

    /**
     * 第三方根据code获取企业成员信息
     * 请求方式：GET
     */
    const URL_USER_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/service/getuserinfo3rd?access_token=%s&code=%s';


    /**
     * 使用user_ticket获取成员详情
     * 请求方式：POST
     */
    const URL_USER_DETAIL = 'https://qyapi.weixin.qq.com/cgi-bin/service/getuserdetail3rd?access_token=%s';

    /**
     *
     * 获取第三方应用凭证
     *
     * @param string $suiteId
     * @param string $suiteSecret
     * @param string $suiteTicket
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getSuiteAccessToken($suiteId, $suiteSecret, $suiteTicket);

    /**
     * 获取预授权码
     *
     * @param string $suiteAccessToken 第三方应用凭证
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getPreAuthCode($suiteAccessToken);


    /**
     * 设置授权配置
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $preAuthCode 预授权码
     * @param array $appIds 允许进行授权的应用id
     * @param int $authType 授权类型
     * @return bool 成功true, 失败异常
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function setPreAuthCodeConfig($suiteAccessToken, $preAuthCode, array $appIds, $authType = 0);

    /**
     * 获取企业永久授权码
     *
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $authCode 临时授权码，会在授权成功时附加在redirect_uri中跳转回第三方服务商网站，或通过回调推送给服务商
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getPermanentCode($suiteAccessToken, $authCode);

    /**
     * 获取企业授权信息
     *
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $corpId 授权方corpid
     * @param string $permanentCode 永久授权码
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getAuthInfo($suiteAccessToken, $corpId, $permanentCode);

    /**
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $corpId 授权方corpid
     * @param string $permanentCode 永久授权码
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getCorpToken($suiteAccessToken, $corpId, $permanentCode);

    /**
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $corpId 授权方corpid
     * @param string $agentId 授权方安装的应用agentid
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getAdminList($suiteAccessToken, $corpId, $agentId);


    /**
     * 获取企业成员信息
     *
     * @param string $suiteAccessToken
     * @param string $code 通过成员授权获取到的code
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getUserInfo($suiteAccessToken, $code);

    /**
     * 获取成员详情
     *
     * @param string $suiteAccessToken 第三方应用凭证
     * @param string $userTicket 成员票据
     * @see SuiteApiDefineInterface::getUserInfo()
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getUserDetail($suiteAccessToken, $userTicket);

    /**
     *
     * 生成oauth2 登录url
     * @param string $suiteId
     * @param string $redirectUri 跳转地址
     * @param Oauth2LoginUrlParam $oauth2LoginUrlParam
     * @return string
     *
     */
    public function generateOauth2LoginUrl($suiteId, $redirectUri, Oauth2LoginUrlParam $oauth2LoginUrlParam = null);
}