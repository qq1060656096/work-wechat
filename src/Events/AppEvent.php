<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 10:43
 */

namespace Zwei\WorkWechat\Events;

use Zwei\WorkWechat\Exceptions\EventHandlerFailException;
use Zwei\WorkWechat\Helpers\XmlHelper;

class AppEvent  extends EventBase
{
    /**
     * 套件事件
     * @var null|EventReceiveInterface
     */
    protected $suiteEventReceive = null;

    /**
     * 普通事件
     * @var null|EventReceiveInterface
     */
    protected $standardEventReceive = null;

    /**
     * 是否处理事件
     * @var bool
     */
    protected $isProcessEvent = false;

    /**
     * 初始化
     *
     * AppEvent constructor.
     * @param EventReceiveInterface $suiteEventReceive suite事件接收
     * @param EventReceiveInterface $standardEventReceive 普通事件接收
     * @param $isProcessEvent
     */
    public function __construct(EventReceiveInterface $suiteEventReceive, EventReceiveInterface $standardEventReceive, $isProcessEvent)
    {
        $this->suiteEventReceive = $suiteEventReceive;
        $this->standardEventReceive = $standardEventReceive;
        $this->isProcessEvent = $isProcessEvent;
    }


    /**
     * 检测是否处理事件
     * 如果不处理直接打印"success"
     * 然后退出
     */
    public function checkProcessEvent() {
        if (!$this->isProcessEvent) {
            // 回复事件成功
            $this->replyEventSuccess();
        }
    }



    /**
     * 处理回调url验证
     * 处理企业微信推送事件
     *
     * @param string $token
     * @param string $encodingAesKey
     * @param string $corpId 默认空值, 空值就从url的corpid参数获取($corpId是回调URL验证需要的)
     */
    public function processCallback($token, $encodingAesKey, $corpId = null) {
        // 处理事件
        $this->processEventCallback($token, $encodingAesKey);

        // 是验证回调url
        $this->processCallbackUrlValidate($token, $encodingAesKey);
    }
    /**
     *
     * 处理企业微信推送事件
     *
     * @param string $token
     * @param string $encodingAesKey
     * @return bool
     */
    public function processEventCallback($token, $encodingAesKey) {
        $eventRawData   = $this->getRawData();
        if (!$eventRawData) {
            return false;
        }
        // 检测是否处理事件
        $this->checkProcessEvent();

        $eventRawArr    = XmlHelper::xmlToArray($eventRawData);
        $corpId         = $eventRawArr['ToUserName'];
        $eventParams = new EventParams();
        $eventParams->msg_signature = $_GET['msg_signature'];
        $eventParams->timestamp = $_GET['timestamp'];
        $eventParams->nonce = $_GET['nonce'];

        $encryptData = $eventRawArr['Encrypt'];
        $xmlStr = $this->decryptMsg($corpId, $token, $encodingAesKey, $eventParams, $encryptData);
        $eventArr = XmlHelper::xmlToArray($xmlStr);
        switch (true) {
            case isset($eventArr['SuiteId']):// 套件事件
                // 处理 suite 事件
                $this->callEventReceive($this->standardEventReceive, $eventArr);
                break;
            default:// 普通消息事件
                // 处理普通事件
                $this->callEventReceive($this->standardEventReceive, $eventArr);
                break;
        }
    }

    /**
     * 处理回调url验证
     *
     * @param string $token
     * @param string $encodingAesKey
     * @param string $corpId 默认空值, 空值就从url的corpid参数获取
     */
    public function processCallbackUrlValidate($token, $encodingAesKey, $corpId = null) {
        $eventParams = new EventParams();
        $eventParams->msg_signature = $_GET['msg_signature'];
        $eventParams->timestamp = $_GET['timestamp'];
        $eventParams->nonce = $_GET['nonce'];
        $eventParams->echostr = $_GET['echostr'];

        //$corpId         = 'wweace8ae2c27a051f';
        // 没有设置corpId通过url中获取, 请在数据回调中加入
        if (empty($corpId) && !empty($_GET['corpid'])) {
            $corpId = $_GET['corpid'];
        }
        // 回调url验证
        $echoStr = $this->callbackUrlValidate($token, $encodingAesKey, $corpId, $eventParams);
        echo $echoStr;
    }

    /**
     * 调用处理事件
     * @param EventReceiveInterface $eventReceive
     * @param $eventArr
     * @return mixed
     */
    public function callEventReceive(EventReceiveInterface $eventReceive, $eventArr) {
        // 没有定义事件处理直接回复"success"
        if (!$eventReceive) {
            $this->replyEventSuccess();
        }

        $result = call_user_func_array(array($eventReceive, "handle"), array($eventArr));
        // 事件处理失败, 直接抛出事件处理失败异常
        if ($result === false) {
            throw new EventHandlerFailException('事件处理失败');
        }
        // 处理成功 回复"success"
        $this->replyEventSuccess();
    }

}