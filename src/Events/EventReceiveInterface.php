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
 * 事件接收接口
 *
 * Interface EventReceiveInterface
 * @package Zwei\WorkWechat\Events
 */
interface EventReceiveInterface
{
    /**
     * 接收事件
     * @param array $eventData 事件
     * @return mixed
     */
    public function receive(array $eventData, $appName);
}