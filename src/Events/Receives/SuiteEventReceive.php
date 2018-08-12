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
//        var_dump(__METHOD__);
//        print_r($eventData);
        switch (true) {
            // suite_ticket 处理
            case isset($eventData['InfoType']) && trim($eventData['InfoType']) === 'suite_ticket':
                // $eventData['SuiteTicket'];
                /*(
                    [SuiteId] => wwb724435140790a38
                    [InfoType] => suite_ticket
                    [TimeStamp] => 1533862253
                    [SuiteTicket] => eWrw5y_oCqrz3dhDPP4oxrcB1lgy3t-DXsXi3Wn35E_n20zXXZvENMVrx0QNcUm-
                )*/
                $eventData['return'] = 'doing_suite_ticket';
                return $eventData;
                break;
        }
        return true;
    }
}