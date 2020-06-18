<?php
/**
 * Created by PhpStorm.
 * User: 赵思贵
 * Date: 2018/9/3
 * Time: 11:01
 */

namespace Zwei\WorkWechat\JsSdk;

use Zwei\WorkWechat\ApiBase;

/**
 * js sdk api
 *
 * Class JsSdkApi
 * @package Zwei\WorkWechat\JsSdk
 */
class JsSdkApi extends ApiBase implements JsSdkApiDefineInterface
{
    /**
     * @inheritdoc
     */
    public function getJsApiTicket($accessToken)
    {
        $url = sprintf(self::URL_JS_API_TICKET, $accessToken);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }
    
    /**
     * @inheritdoc
     */
    public function getJsApiTicketAgentConfig($accessToken)
    {
        $url = sprintf(self::URL_JS_API_TICKET_AGENT_CONFIG, $accessToken);
        $response = $this->client->request('get', $url, ['verify' => $this->sslVerify,]);
        return $this->parseApiResult($response);
    }
    
}
