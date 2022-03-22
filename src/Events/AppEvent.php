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
     * @param bool $isProcessEvent 是否处理事件,默认不处理
     */
    public function __construct(EventReceiveInterface $suiteEventReceive, EventReceiveInterface $standardEventReceive, $isProcessEvent = false)
    {
        $this->suiteEventReceive = $suiteEventReceive;
        $this->standardEventReceive = $standardEventReceive;
        $this->isProcessEvent = $isProcessEvent;
    }


    /**
     * 处理回调url验证
     * 处理企业微信推送事件
     *
     * @param string $token
     * @param string $encodingAesKey
     * @param string $corpId 默认空值, 空值就从url的corpid参数获取($corpId是回调URL验证需要的)
     * @return AppEventResult AppEventResult事件结果
     * @throws EventHandlerFailException 事件处理失败抛出异常
     * @throws CallbackUrlException 解密失败抛出异常, 请看企业微信异常码
     */
    public function processCallback($token, $encodingAesKey, $corpId = null) {
        // 处理事件
        $appEventResult = $this->processEventCallback($token, $encodingAesKey);
        // 是事件处理,就直接返回
        if ($appEventResult instanceof AppEventResult) {
            return $appEventResult;
        }
        // 是验证回调url
        $appEventResult =$this->processCallbackUrlValidate($token, $encodingAesKey);
        return $appEventResult;
    }

    /**
     * 处理企业微信推送事件
     *
     * @param $token
     * @param $encodingAesKey
     * @return null|AppEventResult null不是事件, AppEventResult事件结果
     * @throws EventHandlerFailException 事件处理失败抛出异常
     */
    public function processEventCallback($token, $encodingAesKey) {
        $eventRawData   = $this->getRawData();
        if (!$eventRawData) {
            return null;
        }
        // 检测是否处理事件
        if (!$this->isProcessEvent) {
            // 直接返回成功
            return new AppEventResult(AppEventResult::TYPE_EVENT, $this->getProcessEventSuccessResult(), null);
        }

        $eventRawArr    = XmlHelper::xmlToArray($eventRawData);

        $corpId = null;
        if (isset($eventRawArr['ToUserName'])) {
            $corpId         = $eventRawArr['ToUserName'];
        }
        $eventParams    = new EventParams();
        $eventParams->msg_signature = isset($_GET['msg_signature']) ? $_GET['msg_signature'] : '';
        $eventParams->timestamp = $_GET['timestamp'];
        $eventParams->nonce = $_GET['nonce'];

        if(isset($eventRawArr['Encrypt'])){
            $xmlStr     = $this->decryptMsg($corpId, $token, $encodingAesKey, $eventParams, $eventRawData);
            $eventArr   = XmlHelper::xmlToArray($xmlStr);
        } else {
            $eventArr = $eventRawArr;
        }

        switch (true) {
            case isset($eventArr['SuiteId']):// 套件事件
                // 处理 suite 事件
                $appEventResult = $this->callEventReceive($this->suiteEventReceive, $eventArr);
                break;
            default:// 普通消息事件
                // 处理普通事件
                $appEventResult = $this->callEventReceive($this->standardEventReceive, $eventArr);
                break;
        }
        return $appEventResult;
    }

    /**
     * 处理回调url验证
     *
     * @param string $token
     * @param string $encodingAesKey
     * @param string $corpId 默认空值, 空值就从url的corpid参数获取
     * @return AppEventResult AppEventResult事件结果
     * @throws CallbackUrlException 解密失败抛出异常, 请看企业微信异常码
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
        return new AppEventResult(AppEventResult::TYPE_VALIDATE_URL, $echoStr, $echoStr);
    }


    /**
     * 调用处理事件
     * @param EventReceiveInterface $eventReceive
     * @param array $eventArr 事件
     * @return AppEventResult 返回应用处理结果
     * @throws EventHandlerFailException 事件处理失败抛出异常
     */
    public function callEventReceive(EventReceiveInterface $eventReceive, $eventArr) {
        // 没有定义事件处理直接回复"success"
        if (!$eventReceive) {
            return new AppEventResult(AppEventResult::TYPE_EVENT, $this->getProcessEventSuccessResult(), null);
        }

        $result = call_user_func_array(array($eventReceive, "handle"), array($eventArr));
        // 事件处理失败, 直接抛出事件处理失败异常
        if ($result === false) {
            throw new EventHandlerFailException('事件处理失败');
        }
        // 处理成功 回复"success"
        return new AppEventResult(AppEventResult::TYPE_EVENT, $this->getProcessEventSuccessResult(), $result);
    }

}
