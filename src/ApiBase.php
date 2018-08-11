<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 21:55
 */

namespace Zwei\WorkWechat;

use GuzzleHttp\Client;

/**
 * Api基类
 *
 * Class ApiBase
 * @package Zwei\WorkWechat
 */
class ApiBase
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
}