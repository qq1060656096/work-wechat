<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-14
 * Time: 08:51
 */

namespace Zwei\WorkWechat\Login;

use Zwei\WorkWechat\Exceptions\WorkWechatApiErrorCodeException;

/**
 * 单点登录
 *
 * Interface SSOApiDefineInterface
 * @package Zwei\WorkWechat\Login
 */
interface SSOApiDefineInterface
{
    /**
     * 单点登录url
     * 请求方式：GET
     */
    const URL_SSO_LOGIN_URL = 'https://open.work.weixin.qq.com/wwopen/sso/3rd_qrConnect?appid=%s&redirect_uri=%s&state=%s&usertype=%s';

    /**
     * 获取登录用户信息
     *
     * 请求方式：POST
     */
    const URL_USER_INFO = 'https://qyapi.weixin.qq.com/cgi-bin/service/get_login_info?access_token=%s';

    /**
     *
     * 生成单点登录url
     * @param string $appId 服务商的CorpID
     * @param string $redirectUri 跳转地址
     * @param string $userType 支持登录的类型。admin代表管理员登录（使用微信扫码）,member代表成员登录（使用企业微信扫码）
     * @param string $state 可填a-zA-Z0-9的参数值（不超过128个字节），用于第三方自行校验session，防止跨域攻击
     * @return string
     *
     */
    public function generateLoginUrl($appId, $redirectUri, $redirectUri, $userType, $state = '');

    /**
     * 获取登录用户信息
     * 根据 oauth2 回调 code 获取当前登录用户信息
     *
     * @param string $providerAccessToken 授权登录服务商的网站时，使用应用提供商的provider_access_token
     * @param string $authCode 通过成员授权获取到的 auth_code, 通过get方式获取
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getUserInfo($providerAccessToken, $authCode);
}