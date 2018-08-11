<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 10:43
 */

namespace Zwei\WorkWechat\Events;


use Zwei\WorkWechat\Helpers\CommonHelper;
use Zwei\WorkWechat\Helpers\XmlHelper;

class AppEvent  extends EventBase
{
    /**
     * 是否处理事件
     * @var bool
     */
    protected $processEvent = false;

    /**
     * 获取应用名
     *
     * @return string
     */
    public function getAppName() {
        $name = isset($_GET['app-name']) ? $_GET['app-name'] : '';
        return $name;
    }

    /**
     * 生成回调url
     * @param string $url 原始url
     * @param string $appName 应用名
     * @return string
     */
    public function generateCallbackUrl($url, $appName) {
        $params = [
            'app-name' => $appName,
            'corpid' => '$CORPID$',
        ];
        return CommonHelper::urlAppendParams($url, $params);
    }

    /**
     * 检测是否处理事件
     * 如果不处理直接打印"success"
     * 然后退出
     */
    public function checkProcessEvent() {
        if (!$this->processEvent) {
            echo $this->getProcessEventSuccessResult();
            exit;
        }
    }

    /**
     * 接收回调url验证
     * 接收企业微信推送事件
     */
    public function receveCallback() {
        $appName        = $this->getAppName();
        $appInfo        = [];
        $token          = $appInfo['token'];
        $encodingAesKey = $appInfo['encodingaeskey'];
        // 处理事件
        $this->processEventCallback($token, $encodingAesKey);

        // 是验证回调url
        $this->callbackUrlValidate($token, $encodingAesKey);
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
                break;
            default:// 普通消息事件
                break;
        }
    }

    /**
     * 处理回调url验证
     *
     * @param string $token
     * @param string $encodingAesKey
     */
    public function processCallbackUrlValidate($token, $encodingAesKey) {
        $eventParams = new EventParams();
        $eventParams->msg_signature = $_GET['msg_signature'];
        $eventParams->timestamp = $_GET['timestamp'];
        $eventParams->nonce = $_GET['nonce'];
        $eventParams->echostr = $_GET['echostr'];

        $corpId         = '';
        //$corpId         = 'wweace8ae2c27a051f';
        // 没有设置corpId通过url中获取, 请在数据回调中加入
        if (empty($corpId) && !empty($_GET['corpid'])) {
            $corpId = $_GET['corpid'];
        }
        // 回调url验证
        $echoStr = $this->callbackUrlValidate($token, $encodingAesKey, $corpId, $eventParams);
        echo $echoStr;
    }

}