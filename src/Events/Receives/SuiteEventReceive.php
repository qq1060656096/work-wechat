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

            // 授权成功通知 处理
            case isset($eventData['InfoType']) && trim($eventData['InfoType']) === 'create_auth':
                /*(
                    [SuiteId] => wwb724435140790a38
                    [AuthCode] => tibgBLgD14D9vqU0jmcguVVRSNcSe6Rw9CtLOcOyeUnyy8VvSZEduO1dZOXMYdJjNY0gKZKCjeJUXu8PoHOiBpzWoA_okSxIEpOZY9s0ldY
                    [InfoType] => create_auth
                    [TimeStamp] => 1534045046
                )*/
                // 先记录下AuthCode, 然后换取永久授权码
                $authCode = $eventData['AuthCode'];

                $eventData['return'] = 'doing_create_auth';
                return $eventData;
                break;

            // 变更授权通知 处理
            case isset($eventData['InfoType']) && trim($eventData['InfoType']) === 'change_auth':
                /*(
                    [SuiteId] => wwb724435140790a38
                    [InfoType] => cancel_auth
                    [TimeStamp] => 1534044942
                    [AuthCorpId] => wweace8ae2c27a051f
                )*/
                $authCode = $eventData['AuthCode'];
                // 这里应该记录授权已经取消

                $eventData['return'] = 'doing_change_auth';
                return $eventData;
                break;

            // 取消授权通知 处理
            case isset($eventData['InfoType']) && trim($eventData['InfoType']) === 'cancel_auth':
                /*(
                    [SuiteId] => wwb724435140790a38
                    [InfoType] => cancel_auth
                    [TimeStamp] => 1534044942
                    [AuthCorpId] => wweace8ae2c27a051f
                )*/
                $corpId = $eventData['AuthCorpId'];
                // 这里应该记录授权已经取消

                $eventData['return'] = 'doing_cancel_auth';
                return $eventData;
                break;
            default:
                print_r($eventData);
                break;
        }
        return true;
    }
}