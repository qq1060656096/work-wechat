<?php
/**
 * Created by PhpStorm.
 * Email: 1060656096@qq.com
 * User: zwei
 * Date: 2018-08-11
 * Time: 10:43
 */

namespace Zwei\WorkWechat\Events;


use Zwei\WorkWechat\Exceptions\CallbackUrlException;
use Zwei\WorkWechat\Exceptions\EventDecryptException;
use Zwei\WorkWechat\Helpers\CommonHelper;
use Zwei\WorkWechat\Helpers\XmlHelper;

class EventBase
{

    /**
     * 获取事件原始数据
     * @return bool|string
     */
    public function getRawData() {
        $data = file_get_contents("php://input");
        return $data;
    }

    /**
     * 解密
     *
     * @param string $corpId 企业微信的CorpID， 当为第三方套件回调事件时,CorpID的内容为suite_id
     * @param string $token
     * @param string $encodingAesKey
     * @param EventParams $eventParams 事件解密参数
     * @param string $encryptData 要解密的字符串
     * @return string 成功返回解密后的xml, 失败抛出异常
     * @throws EventDecryptException 解密异常
     */
    public function decryptMsg($corpId, $token, $encodingAesKey, EventParams $eventParams, $encryptData) {
        // 存放解密后的数据
        $decryptData = '';
        $obj = new \WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        $errCode = $obj->DecryptMsg($eventParams->msg_signature, $eventParams->timestamp, $eventParams->nonce, $encryptData, $decryptData);
        if ($errCode == 0) {
            return $decryptData;
        }
        throw new EventDecryptException('', $errCode);
    }

    /**
     * 加密
     *
     * @param string $corpId 企业微信的CorpID， 当为第三方套件回调事件时,CorpID的内容为suite_id
     * @param string $token
     * @param string $encodingAesKey
     * @param EventParams $eventParams 事件加密参数
     * @param string $strXmlData 要解密的xml字符串
     * @return string 成功返回解密后的xml, 失败抛出异常
     * @throws EventDecryptException 解密异常
     */
    public function encryptMsg($corpId, $token, $encodingAesKey, EventParams $eventParams, $strXmlData) {
        // 存放加密后的数据
        $encryptData = '';
        $obj = new \WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        $errCode = $obj->EncryptMsg($eventParams->msg_signature, $eventParams->timestamp, $eventParams->nonce, $strXmlData, $encryptData);
        if ($errCode == 0) {
            return $encryptData;
        }
        throw new EventDecryptException('', $errCode);
    }


    /**
     *
     * 回调url验证
     *
     * @param string $token
     * @param string $encodingAesKey
     * @param string $corpId 授权企业的corpid
     * @param EventParams $eventParams 验证参数
     * @return string
     */
    public function callbackUrlValidate($token, $encodingAesKey, $corpId, EventParams $eventParams) {

        $wxcpt              = new \WXBizMsgCrypt($token, $encodingAesKey, $corpId);
        // 需要返回的明文
        $sEchoStr = "";
        $errCode = $wxcpt->VerifyURL($eventParams->msg_signature, $eventParams->timestamp, $eventParams->nonce, $eventParams->echostr, $sEchoStr);
        if ($errCode == 0) {
            return $sEchoStr;
        } else {
            throw new CallbackUrlException("验证数据回调URL错误", $errCode);
        }
    }

    /**
     * 获取事件处理成功结果
     *
     * @return string
     */
    public function getProcessEventSuccessResult() {
        return 'success';
    }

    /**
     * 回复事件成功
     * 输出"success"
     * 退出脚本
     */
    public function replyEventSuccess() {
        echo $this->getProcessEventSuccessResult();
        exit;
    }
}