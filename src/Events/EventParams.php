<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 11:09
 */

namespace Zwei\WorkWechat\Events;

use Zwei\WorkWechat\Base;

/**
 * Class EventParams
 * @package Zwei\WorkWechat\Events
 *
 * @property string $msg_signature 消息签名
 * @property string $timestamp 时间戳
 * @property string $nonce 随机数
 * @property string $echostr 加密的字符串
 */
class EventParams extends Base
{
    /**
     * 获取所有属性
     *
     * @return array
     */
    public function getAttributes() {
        return [
            'msg_signature' => '消息签名',
            'timestamp' => '时间戳',
            'nonce' => '随机数',
            'echostr' => '加密的字符串',
        ];
    }
}