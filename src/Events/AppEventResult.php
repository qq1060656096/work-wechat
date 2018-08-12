<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-12
 * Time: 07:47
 */

namespace Zwei\WorkWechat\Events;

use Zwei\EventWork\Exception\ParamException;

/**
 * 应用事件处理结果
 *
 * Class AppEventResult
 * @package Zwei\WorkWechat\Events
 */
class AppEventResult
{
    /**
     * 企业微信推送的事件
     */
    const TYPE_EVENT = 'event';

    /**
     * 企业微信回调url验证
     */
    const TYPE_VALIDATE_URL = 'validate_url';
    /**
     * 类型
     * @var string
     */
    protected $type = null;

    /**
     * 成功后回复的字符串, 事件是success, 回调Url验证是解密后的字符串
     * @var string
     */
    protected $echoString = null;

    /**
     * 事件处理结果
     * @var mixed
     */
    protected $eventHandleResult = null;

    /**
     * 构造方法初始化
     *
     * AppEventResult constructor.
     * @param string $type 类型,请看本来 TYPE_开始的常量
     * @param string $echoString 打印字符串
     * @param mixed $eventHandleResult 事件处理结果
     */
    public function __construct($type, $echoString, $eventHandleResult)
    {
        $this->setType($type);
        $this->setEchoString($echoString);
        $this->setEventHandleResult($eventHandleResult);
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return AppEventResult
     */
    private function setType($type)
    {
        $typeList = [
            self::TYPE_EVENT,
            self::TYPE_VALIDATE_URL
        ];
        if (!in_array($type, $typeList)) {
            throw new ParamException('设置应用事件结果type参数非法');
        }
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getEchoString()
    {
        return $this->echoString;
    }

    /**
     * @param string $echoString
     */
    private function setEchoString($echoString)
    {
        $this->echoString = $echoString;
    }

    /**
     * @return mixed
     */
    public function getEventHandleResult()
    {
        return $this->eventHandleResult;
    }

    /**
     * @param mixed $eventHandleResult
     */
    private function setEventHandleResult($eventHandleResult)
    {
        $this->eventHandleResult = $eventHandleResult;
    }

}