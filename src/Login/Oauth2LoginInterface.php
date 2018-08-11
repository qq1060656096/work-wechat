<?php
/**
 * Created byPhpStorm.
 *
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 08:35
 */
namespace Zwei\WorkWechat\Login;

/**
 * Interface LoginInterface
 * @package Zwei\WorkWechat\Login
 */
interface Oauth2LoginInterface
{
    /**
     * 网页授权登录第三方连接
     * 请求方式：GET
     */
    const URL_OAUTH2_LOGIN_URL = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';

    /**
     * 第三方根据code获取企业成员信息
     * 请求方式：GET
     */
    const URL_USER_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token=%s&code=%s';


    /**
     * 使用user_ticket获取成员详情
     * 请求方式：POST
     */
    const URL_USER_DETAIL = 'https://qyapi.weixin.qq.com/cgi-bin/user/getuserdetail?access_token=%s';

    /**
     * 获取企业成员信息
     *
     * @param string $accessToken
     * @param string $code
     * @return array
     */
    public function getUserInfo($accessToken, $code);

    /**
     * 获取成员详情
     *
     * @param string $accessToken
     * @param string $userTicket
     * @see LoginInterface::getUserInfo()
     * @return array
     */
    public function getUserDetail($accessToken, $userTicket);

    /**
     *
     * 生成oauth2 登录url
     * @param string $appId 企业的 CorpID|suite_id
     * @param string $redirectUri 跳转地址
     * @param Oauth2LoginUrlParams $oauth2LoginUrlParam
     * @return mixed
     */
    public function generateOauth2LoginUrl($appId, $redirectUri, Oauth2LoginUrlParams $oauth2LoginUrlParam = null);
}