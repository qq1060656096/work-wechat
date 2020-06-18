<?php
/**
 * Created by PhpStorm.
 * User: 赵思贵
 * Date: 2018/9/3
 * Time: 11:01
 */

namespace Zwei\WorkWechat\JsSdk;

/**
 * js sdk api
 *
 * Interface JsSdkApiDefineInterface
 * @package Zwei\WorkWechat\JsSdk
 */
interface JsSdkApiDefineInterface
{
    /**
     * 获取企业的 jsapi_ticket
     * 请求方式：GET（HTTPS）
     * @var string
     */
    const URL_JS_API_TICKET = 'https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=%s';
    /**
     * 获取应用的 jsapi_ticket
     * 请求方式：GET（HTTPS）
     * @var string
     */
    const URL_JS_API_TICKET_AGENT_CONFIG = "https://qyapi.weixin.qq.com/cgi-bin/ticket/get?access_token=%s&type=agent_config";

    /**
     * 获取企业的jsapi_ticket
     *
     * @param string $accessToken 企业access_token
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getJsApiTicket($accessToken);
    
    /**
     * 获取应用的jsapi_ticket
     *
     * @param string $accessToken 企业access_token
     * @return array
     * @throws WorkWechatApiErrorCodeException 企业微信接口返回错误码异常
     */
    public function getJsApiTicketAgentConfig($accessToken);
}
