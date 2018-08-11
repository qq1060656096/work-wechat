<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 11:45
 */

namespace Zwei\WorkWechat\Events;

/**
 * 接收事件
 *
 *
 * Interface EventReceiveInterface
 * @package Zwei\WorkWechat\Events
 */
interface EventReceiveInterface
{
    /**
     * 处理接收的事件
     * 抛出异常或者false代表接收处理失败
     * @param array $eventData 事件
     * @return mixed
     */
    public function handle(array $eventData);
}