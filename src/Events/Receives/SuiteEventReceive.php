<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 20:50
 */

namespace Zwei\WorkWechat\Events\Receives;


use Zwei\WorkWechat\Events\EventReceiveInterface;

/**
 * 处理suite事件
 * Class StandardEventReceive
 * @package App\WechatEvents
 */
class SuiteEventReceive implements EventReceiveInterface
{
    public function handle(array $eventData)
    {

        return true;
    }
}